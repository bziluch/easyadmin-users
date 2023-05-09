<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e02f0134139eb71cfcc54aa798263f1
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'EasyAdminUsers\\' => 15,
        ),
        'A' => 
        array (
            'App\\Controller\\EasyAdmin\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'EasyAdminUsers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Marketplace/Controller',
        ),
        'App\\Controller\\EasyAdmin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controller/EasyAdmin',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e02f0134139eb71cfcc54aa798263f1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e02f0134139eb71cfcc54aa798263f1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e02f0134139eb71cfcc54aa798263f1::$classMap;

        }, null, ClassLoader::class);
    }
}
