<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/protos/api.proto

namespace Dkms\Models;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dkms.models.KmsEncryptRequest</code>
 */
class KmsEncryptRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string KeyId = 1;</code>
     */
    private $KeyId = '';
    /**
     * Generated from protobuf field <code>bytes Plaintext = 2;</code>
     */
    private $Plaintext = '';
    /**
     * Generated from protobuf field <code>bytes Aad = 3;</code>
     */
    private $Aad = '';

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
     * Generated from protobuf field <code>bytes Plaintext = 2;</code>
     * @return string
     */
    public function getPlaintext()
    {
        return $this->Plaintext;
    }

    /**
     * Generated from protobuf field <code>bytes Plaintext = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setPlaintext($var)
    {
        GPBUtil::checkString($var, False);
        $this->Plaintext = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes Aad = 3;</code>
     * @return string
     */
    public function getAad()
    {
        return $this->Aad;
    }

    /**
     * Generated from protobuf field <code>bytes Aad = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setAad($var)
    {
        GPBUtil::checkString($var, False);
        $this->Aad = $var;

        return $this;
    }

}

