<?php

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret Key
    |--------------------------------------------------------------------------
    |
    | This key will be used to sign your tokens. You should set this value
    | to a random string of sufficient length that will be hard to guess.
    | You can use the 'jwt:secret' Artisan command to generate this key.
    |
    */

    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Keys
    |--------------------------------------------------------------------------
    |
    | The keys can be used to add extra security to the tokens. This is useful
    | if you want more than one secret. These keys will be used to sign tokens
    | and can be used to validate tokens. You can use the 'jwt:secret' Artisan
    | command to generate these keys.
    |
    */

    'keys' => [
        'secret' => env('JWT_SECRET'),
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication JWTAuth Factory
    |--------------------------------------------------------------------------
    |
    | This key will be used to create an instance of the JWTAuth. This
    | will be used to create the token, to validate the token and to
    | verify the token.
    |
    */

    'factory' => [
        'type' => 'jwt',
        'options' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Claim Keys
    |--------------------------------------------------------------------------
    |
    | These keys will be used to add claims to the tokens. You can add
    | your own claims, or you can add claims that you want to be able
    | to validate with the JWT library.
    |
    */

    'claim' => [
        'iss' => env('JWT_ISS'),
        'aud' => env('JWT_AUD'),
        'exp' => env('JWT_EXP'),
        'nbf' => env('JWT_NBF'),
        'iat' => env('JWT_IAT'),
        'jti' => env('JWT_JTI'),
    ],

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Leeway
    |--------------------------------------------------------------------------
    |
    | This key will be used to specify how much leeway the JWTAuth library
    | should use when validating tokens. The leeway is the amount of
    | time that the JWT library will give to the time difference between
    | the token and the current time. If the leeway is set to 0, then
    | the token must be created in the exact same second as the current
    | time. If the leeway is set to 1, then the token can be created
    | one second before or one second after the current time.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Providers
    |--------------------------------------------------------------------------
    |
    | These providers will be used to validate the tokens. You can
    | use the 'jwt:secret' Artisan command to generate these providers.
    |
    */

    'providers' => [
        'tymon\jwt\providers\jwt\provider' => env('JWT_PROVIDER', 'tymon\jwt\providers\jwt\provider'),
    ],

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Algorithm
    |--------------------------------------------------------------------------
    |
    | This key will be used to specify the algorithm that the JWTAuth library
    | should use when signing tokens. The available algorithms are 'HS256',
    | 'HS384', 'HS512', 'RS256', 'RS384', 'RS512', 'ES256', 'ES384', and 'ES512'.
    |
    */

    'algorithm' => env('JWT_ALG', 'HS256'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Refresh TTL
    |--------------------------------------------------------------------------
    |
    | This key will be used to specify the time-to-live for the refresh tokens.
    | The TTL is the amount of time that the refresh tokens will be valid for.
    | You can use the 'jwt:secret' Artisan command to generate the TTL.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Time To Live
    |--------------------------------------------------------------------------
    |
    | This key will be used to specify the time-to-live for the tokens.
    | The TTL is the amount of time that the tokens will be valid for.
    | You can use the 'jwt:secret' Artisan command to generate the TTL.
    |
    */

    'ttl' => env('JWT_TTL', 1440),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Backtrace
    |--------------------------------------------------------------------------
    |
    | This key will be used to specify whether the JWTAuth library should
    | enable the backtrace information. The backtrace is a list of all
    | the function calls that were made in the JWTAuth library. If the
    | backtrace is enabled, then the JWTAuth library will add the
    | backtrace information to the token.
    |
    */

    'backtrace' => env('JWT_BACKTRACE', false),

];
