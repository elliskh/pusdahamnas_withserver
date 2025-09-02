<?php

namespace App\Services;

class ApiKeyService
{
    public static function verify(string $apiKey): bool
    {
        $pepper     = config('app.security.pepper');
        $apikeyHash = config('app.security.apikey_hash');

        if (!$pepper || !$apikeyHash) {
            return false;
        }

        $peppered = hash_hmac('sha256', $apiKey, $pepper);

        return password_verify($peppered, $apikeyHash);
    }
}
