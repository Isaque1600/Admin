<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit356d81d7f02ce1adbb99ea807bed0c48
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Dotenv\\' => 25,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'Adm\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dotenv',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Adm\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/adm',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit356d81d7f02ce1adbb99ea807bed0c48::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit356d81d7f02ce1adbb99ea807bed0c48::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit356d81d7f02ce1adbb99ea807bed0c48::$classMap;

        }, null, ClassLoader::class);
    }
}
