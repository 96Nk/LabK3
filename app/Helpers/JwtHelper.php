<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{

    public static string $key = 'd41d8cd98f00b204e9800998ecf8427e';

    public static function encodeJWT(array $payload): string
    {
        if (!isset($payload['exp']) || !isset($payload['iat'])) {
            $issuedAt = time();
            $expirationTime = $issuedAt + (60 * 60 * 24 * 2);
            $exp_iat = ['exp' => $expirationTime, 'iat' => $issuedAt];
            $payload = array_merge($payload, $exp_iat);
        }
        return JWT::encode($payload, static::$key, 'HS256');
    }

    public static function decodeJWT(string $jwt): object|array
    {
        return JWT::decode($jwt, new Key(static::$key, 'HS256'));
    }

    public static function checkJwt(string $token): bool
    {
        try {
            $jwt = $token && self::decodeJWT($token);
            return $jwt ?: false;
        } catch (\TypeError $th) {
            return false;
        }
    }

}
