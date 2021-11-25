<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/protos/api.proto

namespace Dkms\Models;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dkms.models.KmsEncryptResponse</code>
 */
class KmsEncryptResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string KeyId = 1;</code>
     */
    private $KeyId = '';
    /**
     * Generated from protobuf field <code>bytes CiphertextBlob = 2;</code>
     */
    private $CiphertextBlob = '';
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
     * Generated from protobuf field <code>bytes CiphertextBlob = 2;</code>
     * @return string
     */
    public function getCiphertextBlob()
    {
        return $this->CiphertextBlob;
    }

    /**
     * Generated from protobuf field <code>bytes CiphertextBlob = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCiphertextBlob($var)
    {
        GPBUtil::checkString($var, False);
        $this->CiphertextBlob = $var;

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

