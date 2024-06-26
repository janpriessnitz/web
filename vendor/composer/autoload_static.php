<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita27791744f06a5b32ea4512d880e55ab
{
    public static $files = array (
        'cbedd1c43698b6479c511903c3cb9bb6' => __DIR__ . '/..' . '/toolkit/stdlib/src/func.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Toolkit\\Stdlib\\' => 15,
            'Toolkit\\FsUtil\\' => 15,
        ),
        'P' => 
        array (
            'PhpPkg\\EasyTpl\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Toolkit\\Stdlib\\' => 
        array (
            0 => __DIR__ . '/..' . '/toolkit/stdlib/src',
        ),
        'Toolkit\\FsUtil\\' => 
        array (
            0 => __DIR__ . '/..' . '/toolkit/fsutil/src',
        ),
        'PhpPkg\\EasyTpl\\' => 
        array (
            0 => __DIR__ . '/..' . '/phppkg/easytpl/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita27791744f06a5b32ea4512d880e55ab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita27791744f06a5b32ea4512d880e55ab::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita27791744f06a5b32ea4512d880e55ab::$classMap;

        }, null, ClassLoader::class);
    }
}
