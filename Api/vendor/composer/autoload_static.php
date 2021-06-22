<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7745b6462958cf3159a993e117ae44ca
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lucie\\Api\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lucie\\Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7745b6462958cf3159a993e117ae44ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7745b6462958cf3159a993e117ae44ca::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7745b6462958cf3159a993e117ae44ca::$classMap;

        }, null, ClassLoader::class);
    }
}
