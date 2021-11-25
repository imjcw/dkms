<?php

namespace Dkms;

use AlibabaCloud\Tea\Exception\TeaError;

/**
 * Config
 */
class Config
{
    protected $protocol = "https";
    protected $accessKeyId;
    protected $accessKeySecret;
    protected $clientKeyPassword;
    protected $endpoint;
    protected $cainfo;

    protected $userAgent="";
    protected $readTimeout;
    protected $connectTimeout;
    protected $httpProxy;
    protected $httpsProxy;
    protected $noProxy;
    protected $maxIdleConns;

    /**
     * getProtocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * setProtocol
     *
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = (string)$protocol;
    }

    /**
     * getAccessKeyId
     *
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * setAccessKeyId
     *
     * @param string $accessKeyId
     */
    public function setAccessKeyId($accessKeyId)
    {
        $this->accessKeyId = (string)$accessKeyId;
    }

    /**
     * getAccessKeySecret
     *
     * @return string
     */
    public function getAccessKeySecret()
    {
        return $this->accessKeySecret;
    }

    /**
     * setAccessKeySecret
     *
     * @param string $accessKeySecret
     */
    public function setAccessKeySecret($accessKeySecret)
    {
        $this->accessKeySecret = (string)$accessKeySecret;
    }

    /**
     * setClientKeyContent
     *
     * @param string $clientKeyContent
     */
    public function setClientKeyContent($clientKeyContent)
    {
        $clientKeyContent = @json_decode($clientKeyContent, true) ?: [];
        if (!$clientKeyContent) {
            throw new TeaError([
                'code'    => 'ParameterInvalid',
                'message' => "'config.clientKeyContent' must be json string",
            ]);
        }
        if (isset($clientKeyContent["KeyId"])) {
            $this->accessKeyId = $clientKeyContent["KeyId"];
        }
        if (isset($clientKeyContent["PrivateKeyData"])) {
            $this->accessKeySecret = $clientKeyContent["PrivateKeyData"];
        }
    }

    /**
     * getPassword
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->clientKeyPassword;
    }

    /**
     * setPassword
     *
     * @param string $clientKeyPassword
     */
    public function setPassword($clientKeyPassword)
    {
        $this->clientKeyPassword = (string)$clientKeyPassword;
    }

    /**
     * getEndpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * setEndpoint
     *
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = (string)$endpoint;
    }

    /**
     * getCainfo
     *
     * @return string
     */
    public function getCainfo()
    {
        return $this->cainfo;
    }

    /**
     * setCainfo
     *
     * @param string $cainfo
     */
    public function setCainfo($cainfo)
    {
        $this->cainfo = (string)$cainfo;
    }

    /**
     * getUserAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * setUserAgent
     *
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string)$userAgent;
    }

    /**
     * getReadTimeout
     *
     * @return integer
     */
    public function getReadTimeout()
    {
        return $this->readTimeout;
    }

    /**
     * setReadTimeout
     *
     * @param integer $readTimeout
     */
    public function setReadTimeout($readTimeout)
    {
        $this->readTimeout = (int)$readTimeout;
    }

    /**
     * getConnectTimeout
     *
     * @return integer
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * setConnectTimeout
     *
     * @param integer $connectTimeout
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->connectTimeout = (int)$connectTimeout;
    }

    /**
     * getHttpProxy
     *
     * @return string
     */
    public function getHttpProxy()
    {
        return $this->httpProxy;
    }

    /**
     * setHttpProxy
     *
     * @param string $httpProxy
     * @return void
     */
    public function setHttpProxy($httpProxy)
    {
        $this->httpProxy = $httpProxy;
    }

    /**
     * getHttpsProxy
     *
     * @return string
     */
    public function getHttpsProxy()
    {
        return $this->httpsProxy;
    }

    /**
     * setHttpsProxy
     *
     * @param string $httpsProxy
     */
    public function setHttpsProxy($httpsProxy)
    {
        $this->httpsProxy = $httpsProxy;
    }

    /**
     * getNoProxy
     *
     * @return string
     */
    public function getNoProxy()
    {
        return $this->noProxy;
    }

    /**
     * setNoProxy
     *
     * @param string $noProxy
     */
    public function setNoProxy($noProxy)
    {
        $this->noProxy = $noProxy;
    }

    /**
     * getMaxIdleConns
     *
     * @return string
     */
    public function getMaxIdleConns()
    {
        return $this->maxIdleConns;
    }

    /**
     * setMaxIdleConns
     *
     * @param string $maxIdleConns
     */
    public function setMaxIdleConns($maxIdleConns)
    {
        $this->maxIdleConns = $maxIdleConns;
    }
}