<?php

namespace Dkms\Test;

use Dkms\Config;
use Dkms\Dkms;

trait Provider
{
    protected function initialize()
    {
        $config = new Config();
        $config->setProtocol("https");
        $config->setEndpoint("");
        $config->setPassword("");
        $config->setClientKeyContent("{\"KeyId\": \"\",\"PrivateKeyData\": \"\"}");
        $config->setCainfo("/var/www/html/tmp/PrivateKmsCA_kst-***.pem");
        return new Dkms($config);
    }
}
