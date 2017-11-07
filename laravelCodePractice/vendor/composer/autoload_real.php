<?php

// 由Composer生成的autoload_real.php

class ComposerAutoloaderInit926d1c2f0ed1623f34619099dd63b982
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class)
        {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader)
        {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit926d1c2f0ed1623f34619099dd63b982', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit926d1c2f0ed1623f34619099dd63b982', 'loadClassLoader'));

//        print_r($loader);
//        die();

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        // php版本大于等于5.6  常量HHVM_VERSION未被定义  zend_loader_file_encoded方法不存在 走下分支
        if ($useStaticLoader)
        {
            require_once __DIR__ . '/autoload_static.php';
            call_user_func(\Composer\Autoload\ComposerStaticInit926d1c2f0ed1623f34619099dd63b982::getInitializer($loader));
        } else {

            // 将命名空间按照首字母分类
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path)
            {
                $loader->set($namespace, $path);
            }

            // 判断命名空间是否以 `\` 结尾
            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path)
            {
                $loader->setPsr4($namespace, $path);
            }

            // 如果类映射中存在则合并不存在则赋值
            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap)
            {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader)
        {
            $includeFiles = Composer\Autoload\ComposerStaticInit926d1c2f0ed1623f34619099dd63b982::$files;
        }else{
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }

        foreach ($includeFiles as $fileIdentifier => $file)
        {
            composerRequire926d1c2f0ed1623f34619099dd63b982($fileIdentifier, $file);
        }

        return $loader;
    }
}


function composerRequire926d1c2f0ed1623f34619099dd63b982 ($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier]))
    {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}