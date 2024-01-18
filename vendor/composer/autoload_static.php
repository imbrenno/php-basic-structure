<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b7827027fc3583a7d1aa820e8ae264d
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Codes\\BasicStructure\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Codes\\BasicStructure\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b7827027fc3583a7d1aa820e8ae264d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b7827027fc3583a7d1aa820e8ae264d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9b7827027fc3583a7d1aa820e8ae264d::$classMap;

        }, null, ClassLoader::class);
    }
}
