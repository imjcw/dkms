<?php

namespace Dkms;

use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Dkms\Models\DecryptRequest;
use Dkms\Models\DecryptResponse;
use Dkms\Models\EncryptRequest;
use Dkms\Models\EncryptResponse;

/**
 * Dkms
 */
class Dkms extends Client
{
    const VERSION          = "dkms-gcs-0.2";
    const SIGNATURE_METHOD = "RSA_PKCS1_SHA_256";

    /**
     * @param EncryptRequest $request
     *
     * @return EncryptResponse
     */
    public function encrypt(EncryptRequest $request)
    {
        $runtime = new RuntimeOptions([]);

        return $this->encryptWithOptions($request, $runtime);
    }

    /**
     * @param EncryptRequest $request
     * @param RuntimeOptions $runtime
     *
     * @return EncryptResponse
     */
    public function encryptWithOptions(EncryptRequest $request, RuntimeOptions $runtime)
    {
        $resp = new EncryptResponse();
        $resp->mergeFromString(
            $this->doRPCRequest("Encrypt", self::VERSION, "HTTPS", "POST", self::SIGNATURE_METHOD, $request, $runtime)
        );
        return $resp;
    }

    /**
     * @param DecryptRequest $request
     *
     * @return DecryptResponse
     */
    public function decrypt(DecryptRequest $request)
    {
        $runtime = new RuntimeOptions([]);

        return $this->decryptWithOptions($request, $runtime);
    }

    /**
     * @param DecryptRequest $request
     * @param RuntimeOptions $runtime
     *
     * @return DecryptResponse
     */
    public function decryptWithOptions(DecryptRequest $request, RuntimeOptions $runtime)
    {
        $resp = new DecryptResponse();
        $resp->mergeFromString(
            $this->doRPCRequest("Decrypt", self::VERSION, "HTTPS", "POST", self::SIGNATURE_METHOD, $request, $runtime)
        );
        return $resp;
    }
}
