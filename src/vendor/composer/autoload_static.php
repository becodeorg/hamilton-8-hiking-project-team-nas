<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0f2a37a3cd46a50b6e540f9cf1cb9409
{
    public static $classMap = array (
        'ComposerAutoloaderInit0f2a37a3cd46a50b6e540f9cf1cb9409' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit0f2a37a3cd46a50b6e540f9cf1cb9409' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'models\\Database' => __DIR__ . '/../..' . '/models/Database.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit0f2a37a3cd46a50b6e540f9cf1cb9409::$classMap;

        }, null, ClassLoader::class);
    }
}
