<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/protos/api.proto

namespace Dkms\Models;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>dkms.models.KmsDecryptRequest</code>
 */
class KmsDecryptRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes CiphertextBlob = 1;</code>
     */
    private $CiphertextBlob = '';
    /**
     * Generated from protobuf field <code>bytes Aad = 2;</code>
     */
    private $Aad = '';

    public function __construct() {
        \GPBMetadata\Protobuf\Protos\Api::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>bytes CiphertextBlob = 1;</code>
     * @return string
     */
    public function getCiphertextBlob()
    {
        return $this->CiphertextBlob;
    }

    /**
     * Generated from protobuf field <code>bytes CiphertextBlob = 1;</code>
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
     * Generated from protobuf field <code>bytes Aad = 2;</code>
     * @return string
     */
    public function getAad()
    {
        return $this->Aad;
    }

    /**
     * Generated from protobuf field <code>bytes Aad = 2;</code>
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
