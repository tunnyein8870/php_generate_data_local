<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ec6339eaecc7482c6b4778ed8cd9b85
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ec6339eaecc7482c6b4778ed8cd9b85::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ec6339eaecc7482c6b4778ed8cd9b85::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4ec6339eaecc7482c6b4778ed8cd9b85::$classMap;

        }, null, ClassLoader::class);
    }
}
