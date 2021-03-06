<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/protos/api.proto

namespace Dkms\Models;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dkms.models.HmacResponse</code>
 */
class HmacResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string KeyId = 1;</code>
     */
    private $KeyId = '';
    /**
     * Generated from protobuf field <code>bytes Signature = 2;</code>
     */
    private $Signature = '';
    /**
     * Generated from protobuf field <code>string RequestId = 3;</code>
     */
    private $RequestId = '';

    public function __construct() {
        \GPBMetadata\Protobuf\Protos\Api::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string KeyId = 1;</code>
     * @return string
     */
    public function getKeyId()
    {
        return $this->KeyId;
    }

    /**
     * Generated from protobuf field <code>string KeyId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setKeyId($var)
    {
        GPBUtil::checkString($var, True);
        $this->KeyId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes Signature = 2;</code>
     * @return string
     */
    public function getSignature()
    {
        return $this->Signature;
    }

    /**
     * Generated from protobuf field <code>bytes Signature = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setSignature($var)
    {
        GPBUtil::checkString($var, False);
        $this->Signature = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string RequestId = 3;</code>
     * @return string
     */
    public function getRequestId()
    {
        return $this->RequestId;
    }

    /**
     * Generated from protobuf field <code>string RequestId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setRequestId($var)
    {
        GPBUtil::checkString($var, True);
        $this->RequestId = $var;

        return $this;
    }

}

