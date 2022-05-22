<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit596f26c0830d00e10405c9850bd34739
{
    public static $files = array (
        '70578a15c1a86ecd4d2951994c48ad09' => __DIR__ . '/../..' . '/Core/ConfigLoader.php',
        'b79431f07acc754ab6cac1eb0ff6dcee' => __DIR__ . '/../..' . '/Core/HelperLoader.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit596f26c0830d00e10405c9850bd34739::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit596f26c0830d00e10405c9850bd34739::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit596f26c0830d00e10405c9850bd34739::$classMap;

        }, null, ClassLoader::class);
    }
}