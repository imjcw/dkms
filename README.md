## 项目简介

阿里云 DKMS sdk.

## TIPS

`Models` 结构定义在 `protubuf/protos/api.proto` 中。

生成 `Models` 的命令：

```bash
protoc --php_out=./protobuf protobuf/protos/api.proto
```

## 安装

```bash
composer require "talk-lucky/dkms"
```

## 使用

```php
<?php

use Dkms\Config;
use Dkms\Dkms;
use Dkms\Models\EncryptRequest;
use Dkms\Models\DecryptRequest;

$config = [];
$configCls = new Config();
$configCls->setProtocol($config["protocol"]);
$configCls->setEndpoint($config["endpoint"]);
$configCls->setPassword($config["password"]);
$configCls->setClientKeyContent($config["clientKeyContent"]);
$configCls->setCainfo($config["cainfo"]);
$client = new Dkms($configCls);

$keyId = "";
$val = "";
$request = new EncryptRequest();
$request->setKeyId($keyId);
$request->setPlaintext($val);
$resp = $client->encrypt($request);

$keyId = "";
$val = "";
$iv = "";
$request = new DecryptRequest();
$request->setKeyId($keyId);
$request->setCiphertextBlob($val);
$request->setIv($iv);
$resp = $client->decrypt($request);
```