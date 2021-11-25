<?php

namespace Dkms;

use Exception;
use InvalidArgumentException;
use AlibabaCloud\Tea\Request;

/**
 * Utils
 */
class Utils
{
    /**
     * 获取私钥证书
     *
     * @param string $privateKeyData
     * @param string $password
     * @return string
     */
    public static function getPrivateKeyPemFromPk($privateKeyData, $password)
    {
        openssl_pkcs12_read(base64_decode($privateKeyData), $cert, $password);
        return $cert["pkey"];
    }

    /**
     * 签名
     *
     * @param string $string
     * @param string $privateKey
     * @return string
     */
    public static function sign($string, $privateKey)
    {
        $binarySignature = '';
        try {
            openssl_sign(
                $string,
                $binarySignature,
                $privateKey,
                \OPENSSL_ALGO_SHA256
            );
        } catch (Exception $exception) {
            throw new InvalidArgumentException(
                $exception->getMessage()
            );
        }

        return base64_encode($binarySignature);
    }

    /**
     * 获取签名字符串
     *
     * @param Request $request
     * @return string
     */
    public static function getStr2Sign(Request $request)
    {
        return $request->method . "\n"
            . (isset($request->headers["content-sha256"]) ? $request->headers["content-sha256"] : "") . "\n"
            . (isset($request->headers["content-type"]) ? $request->headers["content-type"] : "") . "\n"
            . (isset($request->headers["date"]) ? $request->headers["date"] : "") . "\n"
            . self::getCanonicalizedHeaders($request->headers)
            . self::getCanonicalizedResource($request->pathname, $request->query);
    }

    /**
     * 处理header
     *
     * @param array $headers
     * @return string
     */
    protected static function getCanonicalizedHeaders(array $headers)
    {
        $prefix = "x-kms-";
        ksort($headers);
        $result = "";
        foreach ($headers as $key => $val) {
            if (strpos($key, $prefix) !== 0) {
                continue;
            }
            $result .= $key . ":" . trim($headers[$key]) . "\n";
        }
        return $result;
    }

    /**
     * 处理资源
     *
     * @param string $pathname
     * @param array $queries
     * @return string
     */
    public static function getCanonicalizedResource($pathname, $queries)
    {
        if (!$pathname) {
            return "/";
        }
        if (!$queries) {
            return $pathname;
        }
        ksort($queries);
        $queryStrList = [];
        foreach ($queries as $key => $val) {
            $queryStr = $key;
            if ($val) {
                $queryStr .= "=" . $val;
            }
            $queryStrList[] = $queryStr;
        }
        return $pathname . "?" . implode("&", $queryStrList);
    }
}
