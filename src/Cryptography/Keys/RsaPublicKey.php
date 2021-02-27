<?php

namespace MiladRahimi\Jwt\Cryptography\Keys;

use MiladRahimi\Jwt\Exceptions\InvalidKeyException;

/**
 * Class RsaPublicKey
 *
 * @package MiladRahimi\Jwt\Cryptography\Keys
 */
class RsaPublicKey
{
    /**
     * @var resource    Key file resource handler
     */
    private $resource;

    /**
     * PublicKey constructor.
     *
     * @param string $filePath
     * @throws InvalidKeyException
     */
    public function __construct(string $filePath)
    {
        if (file_exists($filePath)) {
            $filePath = 'file:///' . $filePath;
        }
        $this->resource = openssl_pkey_get_public($filePath);

        if (empty($this->resource)) {
            throw new InvalidKeyException();
        }
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Close key resource
     */
    public function close()
    {
       // PHP 8 deprecation
       // openssl_free_key($this->getResource());
    }
}
