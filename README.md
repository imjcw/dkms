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