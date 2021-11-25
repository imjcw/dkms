<?php

namespace Dkms;

use Adbar\Dot;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\Tea\Tea;
use AlibabaCloud\Tea\Request;
use AlibabaCloud\Tea\Response;
use Dkms\Models\Error;
use Dkms\Utils as DkmsUtils;
use Exception;
use Google\Protobuf\Internal\Message;

/**
 * 客户端
 */
abstract class Client
{
    /**
     * 配置
     *
     * @var Config
     */
    protected $config;

    /**
     * ...
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        if (Utils::isUnset($config)) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config' can not be unset",
            ]);
        }
        if (Utils::empty_($config->getEndpoint())) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config.endpoint' can not be empty",
            ]);
        }
        if (Utils::empty_($config->getAccessKeyId())) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config.accessKeyId' can not be empty",
            ]);
        }
        if (Utils::empty_($config->getAccessKeySecret())) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config.accessKeySecret' can not be empty",
            ]);
        }
        $this->config = $config;
    }

    /**
     * doRPCRequest
     *
     * @param string $action
     * @param string $version
     * @param string $protocol
     * @param string $method
     * @param string $signatureMethod
     * @param Message $request
     * @param RuntimeOptions $runtime
     * @throws TeaError
     * @throws TeaUnableRetryError
     * @return string
     */
    protected function doRPCRequest($action, $version, $protocol, $method, $signatureMethod, Message $request, RuntimeOptions $runtime)
    {
        $runtime->validate();
        $_runtimeRetry = [
            'retryable'   => $runtime->autoretry,
            'maxAttempts' => Utils::defaultNumber($runtime->maxAttempts, 3),
        ];
        $_runtimeBackoff = [
            'policy' => Utils::defaultString($runtime->backoffPolicy, 'no'),
            'period' => Utils::defaultNumber($runtime->backoffPeriod, 1),
        ];
        $_runtime = $this->genRuntime($runtime);
        $_lastRequest   = null;
        $_lastException = null;
        $_now           = time();
        $_retryTimes    = 0;
        $_contentSHA256 = strtoupper(bin2hex(hash('sha256', $request->serializeToString(), true)));
        $pkPem = DkmsUtils::getPrivateKeyPemFromPk($this->config->getAccessKeySecret(), $this->config->getPassword());
        while (Tea::allowRetry($_runtimeRetry, $_retryTimes, $_now)) {
            if ($_retryTimes > 0) {
                $_backoffTime = Tea::getBackoffTime($_runtimeBackoff, $_retryTimes);
                if ($_backoffTime > 0) {
                    Tea::sleep($_backoffTime);
                }
            }
            $_retryTimes = $_retryTimes + 1;

            try {
                $_request           = new Request();
                $_request->protocol = Utils::defaultString($this->config->getProtocol(), $protocol);
                $_request->method   = $method;
                $_request->pathname = '/';
                $_request->headers  = [
                    "accept"                => "application/x-protobuf",
                    "host"                  => $this->config->getEndpoint(),
                    "date"                  => Utils::getDateUTCString(),
                    "user-agent"            => Utils::getUserAgent($this->config->getUserAgent()),
                    "x-kms-apiversion"      => $version,
                    "x-kms-apiname"         => $action,
                    "x-kms-signaturemethod" => $signatureMethod,
                    "x-kms-acccesskeyid"    => $this->config->getAccessKeyId(),

                    "content-type"   => "application/x-protobuf",
                    "content-length" => $request->byteSize(),
                    "content-sha256" => $_contentSHA256,
                ];
                $_request->body = $request->serializeToString();
                $_request->headers["authorization"] = "Bearer " . DkmsUtils::sign(
                    DkmsUtils::getStr2Sign($_request),
                    $pkPem
                );
                $_lastRequest = $_request;
                $res = Tea::client($_runtime)->send($_request->getPsrRequest(), $_runtime);
                $_response = new Response($res);
                if (Utils::is4xx($_response->statusCode) || Utils::is5xx($_response->statusCode)) {
                    $_res = Utils::readAsString($_response->body);
                    $err = new Error();
                    $err->mergeFromString($_res);

                    throw new TeaError([
                        'code'    => $err->getErrorCode(),
                        'message' => 'code: ' . (string) ($_response->statusCode) . ', ' . $err->getErrorMessage() . ' request id: ' . $err->getRequestId() . '',
                        'data'    => $err,
                    ]);
                }
                return Utils::readAsString($_response->body);
            } catch (Exception $e) {
                if (!($e instanceof TeaError)) {
                    $e = new TeaError([], $e->getMessage(), $e->getCode(), $e);
                }
                if (Tea::isRetryable($e)) {
                    $_lastException = $e;

                    continue;
                }

                throw $e;
            }
        }

        throw new TeaUnableRetryError($_lastRequest, $_lastException);
    }

    /**
     * 生成runtime配置
     *
     * @param RuntimeOptions $runtime
     * @return array
     */
    protected function genRuntime(RuntimeOptions $runtime)
    {
        $config = [
            'readTimeout'    => Utils::defaultNumber($runtime->readTimeout,    $this->config->getReadTimeout()),
            'connectTimeout' => Utils::defaultNumber($runtime->connectTimeout, $this->config->getConnectTimeout()),
            'httpProxy'      => Utils::defaultString($runtime->httpProxy, $this->config->getHttpProxy()),
            'httpsProxy'     => Utils::defaultString($runtime->httpsProxy, $this->config->getHttpsProxy()),
            'noProxy'        => Utils::defaultString($runtime->noProxy, $this->config->getNoProxy()),
            'ignoreSSL'      => $runtime->ignoreSSL ?: !$this->config->getCainfo(),
        ];
        $options = new Dot(['http_errors' => false]);
        if ($config['httpProxy']) {
            $options->set('proxy.http', $config['httpProxy']);
        }
        if ($config['httpsProxy']) {
            $options->set('proxy.https', $config['httpsProxy']);
        }
        if ($config['noProxy']) {
            $options->set('proxy.no', $config['noProxy']);
        }
        // readTimeout&connectTimeout unit is millisecond
        $read_timeout = $config['readTimeout'] ? (int) $config['readTimeout'] : 0;
        $con_timeout  = $config['connectTimeout'] ? (int) $config['connectTimeout'] : 0;
        // timeout unit is second
        $options->set('timeout', ($read_timeout + $con_timeout) / 1000);

        $options->set('verify', $config["ignoreSSL"] ? false : $this->config->getCainfo());
        return $options->all();
    }
}
