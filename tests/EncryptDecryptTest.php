<?php

namespace Dkms\Test;

use Dkms\Models\EncryptRequest;
use Dkms\Models\EncryptResponse;
use PHPUnit\Framework\TestCase;
use Dkms\Dkms;
use Dkms\Models\DecryptRequest;
use Dkms\Models\DecryptResponse;

class EncryptDecryptTest extends TestCase
{
    use Provider;

    const KEY_ID = "alias/dkms-test";

    /**
     * @var Dkms
     */
    protected $dkmsClient;

    function __construct()
    {
        $this->dkmsClient = $this->initialize();
    }

    public function testEncrypt()
    {
        $request = new EncryptRequest();
        $request->setKeyId(self::KEY_ID);
        $request->setPlaintext("this is test");
        try {
            $this->assertInstanceOf(EncryptResponse::class, $this->dkmsClient->encrypt($request));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function testDecrypt()
    {
        $request = new EncryptRequest();
        $request->setKeyId(self::KEY_ID);
        $request->setPlaintext("hahaha");
        try {
            $encryptResponse = $this->dkmsClient->encrypt($request);
            $decryptRequest = new DecryptRequest();
            $decryptRequest->setKeyId(self::KEY_ID);
            $decryptRequest->setCiphertextBlob($encryptResponse->getCiphertextBlob());
            $decryptRequest->setIv($encryptResponse->getIv());
            $decryptResponse = $this->dkmsClient->decrypt($decryptRequest);
            $this->assertInstanceOf(DecryptResponse::class, $decryptResponse);
            $this->assertEquals("hahaha", $decryptResponse->getPlaintext());
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
