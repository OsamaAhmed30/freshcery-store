<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc44053762671f5e67f14e0d2c9f01b33
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'apimatic\\jsonmapper\\' => 20,
        ),
        'U' => 
        array (
            'Unirest\\' => 8,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PaypalServerSdkLib\\' => 19,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'CoreInterfaces\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'apimatic\\jsonmapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/jsonmapper/src',
        ),
        'Unirest\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/unirest-php/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'PaypalServerSdkLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-server-sdk/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/core/src',
        ),
        'CoreInterfaces\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/core-interfaces/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rs\\Json' => 
            array (
                0 => __DIR__ . '/..' . '/php-jsonpointer/php-jsonpointer/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc44053762671f5e67f14e0d2c9f01b33::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc44053762671f5e67f14e0d2c9f01b33::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc44053762671f5e67f14e0d2c9f01b33::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitc44053762671f5e67f14e0d2c9f01b33::$classMap;

        }, null, ClassLoader::class);
    }
}
