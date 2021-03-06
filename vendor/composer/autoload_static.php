<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit72ea86b29c14801a9d7c75b90b828791
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        'bccfaf6207f67190a92f35585e9a78b2' => __DIR__ . '/..' . '/twilio/sdk/Services/Twilio.php',
        'e320f53bb3364b7ed572ecc5ef33c5cf' => __DIR__ . '/../..' . '/app/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'P' => 
        array (
            'Predis\\' => 7,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\' => 11,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'A' => 
        array (
            'Authy' => 
            array (
                0 => __DIR__ . '/..' . '/authy/php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'AdminController' => __DIR__ . '/../..' . '/app/controllers/AdminController.php',
        'ApiController' => __DIR__ . '/../..' . '/app/controllers/ApiController.php',
        'ApiResponse' => __DIR__ . '/../..' . '/app/core/ApiResponse.php',
        'Auth' => __DIR__ . '/../..' . '/app/libs/Auth.php',
        'Controller' => __DIR__ . '/../..' . '/app/core/Controller.php',
        'DB' => __DIR__ . '/../..' . '/app/libs/DB.php',
        'GilbertApp' => __DIR__ . '/../..' . '/app/core/GilbertApp.php',
        'JWTLib' => __DIR__ . '/../..' . '/app/libs/JWTLib.php',
        'MainController' => __DIR__ . '/../..' . '/app/controllers/MainController.php',
        'Redis' => __DIR__ . '/../..' . '/app/libs/Redis.php',
        'Session' => __DIR__ . '/../..' . '/app/libs/Session.php',
        'User' => __DIR__ . '/../..' . '/app/models/User.php',
        'UserController' => __DIR__ . '/../..' . '/app/controllers/UserController.php',
        'View' => __DIR__ . '/../..' . '/app/core/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit72ea86b29c14801a9d7c75b90b828791::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit72ea86b29c14801a9d7c75b90b828791::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit72ea86b29c14801a9d7c75b90b828791::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit72ea86b29c14801a9d7c75b90b828791::$classMap;

        }, null, ClassLoader::class);
    }
}
