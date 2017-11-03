<?php

/*
 * 这个文件是composer的一部分
 */

namespace Composer\Autoload;

/**
 * ClassLoader实现了PSR-0，PSR-4和类映射类加载器。
 *
 *     $loader = new \Composer\Autoload\ClassLoader();
 *
 *     // 使用命名空间注册类
 *     $loader->add('Symfony\Component', __DIR__.'/component');
 *     $loader->add('Symfony',           __DIR__.'/framework');
 *
 *     // 激活自动装载机
 *     $loader->register();
 *
 *     // 以启用搜索包含路径（例如，对于PEAR包）
 *     $loader->setUseIncludePath(true);
 *
 *     在这个例子中，如果您尝试在 Symfony\Component 命名空间或其子类（Symfony\Component\Console）中使用一个实例，
 *     自动装载机如果在没有找到放弃之前，先首查找组件下的类，然后再回退到框架/目录。
 *
 */
class ClassLoader
{
    // PSR-4
    private $prefixLengthsPsr4     = array();
    private $prefixDirsPsr4        = array();
    private $fallbackDirsPsr4      = array();

    // PSR-0
    private $prefixesPsr0          = array();
    private $fallbackDirsPsr0      = array();

    private $useIncludePath        = false;
    private $classMap              = array();
    private $classMapAuthoritative = false;
    private $missingClasses        = array();
    private $apcuPrefix;

    /*
     * 获得前缀
     */
    public function getPrefixes()
    {
        if (!empty($this->prefixesPsr0))
        {
            return call_user_func_array('array_merge', $this->prefixesPsr0);
        }

        return array();
    }

    public function getPrefixesPsr4()
    {
        return $this->prefixDirsPsr4;
    }

    public function getFallbackDirs()
    {
        return $this->fallbackDirsPsr0;
    }

    public function getFallbackDirsPsr4()
    {
        return $this->fallbackDirsPsr4;
    }

    /*
     * 得到类映射
     */
    public function getClassMap()
    {
        return $this->classMap;
    }

    /**
     * @param array $classMap 添加类映射
     */
    public function addClassMap(array $classMap)
    {
        if ($this->classMap)
        {
            $this->classMap = array_merge($this->classMap, $classMap);
        } else {
            $this->classMap = $classMap;
        }
    }

    /**
     * 为给定的前缀注册一组PSR-0目录，或者将前缀添加到前缀的前缀中。
     *
     * @param string       $prefix  The prefix
     * @param array|string $paths   The PSR-0 root directories
     * @param bool         $prepend Whether to prepend the directories
     */
    public function add($prefix, $paths, $prepend = false)
    {
        if (!$prefix)
        {
            if ($prepend)
            {
                $this->fallbackDirsPsr0 = array_merge(
                    (array) $paths,
                    $this->fallbackDirsPsr0
                );
            } else {
                $this->fallbackDirsPsr0 = array_merge(
                    $this->fallbackDirsPsr0,
                    (array) $paths
                );
            }

            return;
        }

        $first = $prefix[0];
        if (!isset($this->prefixesPsr0[$first][$prefix]))
        {
            $this->prefixesPsr0[$first][$prefix] = (array) $paths;

            return;
        }
        if ($prepend)
        {
            $this->prefixesPsr0[$first][$prefix] = array_merge(
                (array) $paths,
                $this->prefixesPsr0[$first][$prefix]
            );
        } else {
            $this->prefixesPsr0[$first][$prefix] = array_merge(
                $this->prefixesPsr0[$first][$prefix],
                (array) $paths
            );
        }
    }

    /**
     * 也可以为给定的命名空间注册一组PSR-4目录附加或预先为以前为此命名空间设置的那些。
     *
     * @param string       $prefix  The prefix/namespace, with trailing '\\'
     * @param array|string $paths   The PSR-4 base directories
     * @param bool         $prepend Whether to prepend the directories
     *
     * @throws \InvalidArgumentException
     */
    public function addPsr4($prefix, $paths, $prepend = false)
    {
        if (!$prefix)
        {
            // 注册根命名空间的目录。
            if ($prepend)
            {
                $this->fallbackDirsPsr4 = array_merge(
                    (array) $paths,
                    $this->fallbackDirsPsr4
                );
            } else {
                $this->fallbackDirsPsr4 = array_merge(
                    $this->fallbackDirsPsr4,
                    (array) $paths
                );
            }
        } elseif (!isset($this->prefixeDirsPsr4[$prefix]))
        {
            // 注册一个新命名空间的目录。
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1])
            {
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
            $this->prefixDirsPsr4[$prefix] = (array) $paths;
        } elseif ($prepend) {
            // 为已注册的命名空间预置目录。
            $this->prefixDirsPsr4[$prefix] = array_merge(
                (array) $paths,
                $this->prefixDirsPsr4[$prefix]
            );
        } else {
            // 追加一个已经注册的命名空间的目录。
            $this->prefixDirsPsr4[$prefix] = array_merge(
                $this->prefixDirsPsr4[$prefix],
                (array) $paths
            );
        }
    }

    /**
     * 为给定的前缀注册一组PSR-0目录,
     * 替换任何先前前缀。
     *
     * @param string       $prefix The prefix
     * @param array|string $paths  The PSR-0 base directories
     */
    public function set($prefix, $paths)
    {
        if (!$prefix)
        {
            $this->fallbackDirsPsr0 = (array) $paths;
        } else {
            $this->prefixesPsr0[$prefix[0]][$prefix] = (array) $paths;
        }
    }

    /**
     * 为给定的命名空间注册一组PSR-4目录,
     * 替换命名空间任何先前的前缀.
     *
     * @param string       $prefix The prefix/namespace, with trailing '\\'
     * @param array|string $paths  The PSR-4 base directories
     *
     * @throws \InvalidArgumentException
     */
    public function setPsr4($prefix, $paths)
    {
        if (!$prefix)
        {
            $this->fallbackDirsPsr4 = (array) $paths;
        } else {
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1])
            {
                //非空的PSR-4前缀必须以名称空间分隔符结尾
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
        }
    }

    /**
     * 打开搜索类文件的包含路径。
     *
     * @param bool $useIncludePath
     */
    public function setUseIncludePath($useIncludePath)
    {
        $this->useIncludePath = $useIncludePath;
    }

    /**
     * 可以用来检查自动加载器是否使用包含路径来检查
     * for classes.
     *
     * @return bool
     */
    public function getUseIncludePath()
    {
        return $this->useIncludePath;
    }

    /**
     * 关闭搜索尚未使用类映射注册的类的前缀和后备目录。
     *
     * @param bool $classMapAuthoritative
     */
    public function setClassMapAuthoritative($classMapAuthoritative)
    {
        $this->classMapAuthoritative = $classMapAuthoritative;
    }

    /**
     * Should class lookup fail if not found in the current class map?
     * 如果在当前的类映射找不到类是否应该查询失败
     * @return bool
     */
    public function isClassMapAuthoritative()
    {
        return $this->classMapAuthoritative;
    }

    /**
     * APCu prefix to use to cache found/not-found classes, if the extension is enabled.
     * APCu前缀用于缓存找到/未找到的类，如果扩展已启用。
     * @param string|null $apcuPrefix
     */
    public function setApcuPrefix($apcuPrefix)
    {
        $this->apcuPrefix = function_exists('apcu_fetch') && ini_get('apc.enabled') ? $apcuPrefix : null;
    }

    /**
     * The APCu prefix in use, or null if APCu caching is not enabled.
     * 正在使用的APCu前缀;如果未启用APCu缓存，则为null。
     * @return string|null
     */
    public function getApcuPrefix()
    {
        return $this->apcuPrefix;
    }

    /**
     * Registers this instance as an autoloader.
     * 注册自动加载类的实例
     * @param bool $prepend Whether to prepend the autoloader or not
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    /**
     * Unregisters this instance as an autoloader.
     * 取消注册此实例作为自动加载器。
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Loads the given class or interface.
     * 加载类或者接口
     *
     * @param  string    $class The name of the class 类名
     * @return bool|null True if loaded, null otherwise 真或者空
     */
    public function loadClass($class)
    {
        if ($file = $this->findFile($class))
        {
            includeFile($file);

            return $file;
        }
    }

    /**
     * Finds the path to the file where the class is defined.
     * 找到定义类的文件的路径。
     *
     * @param string $class The name of the class 类名
     *
     * @return string|false The path if found, false otherwise
     */
    public function findFile($class)
    {
        // 类映射查询
        if (isset($this->classMap[$class]))
        {
            return $this->classMap[$class];
        }

        if ($this->classMapAuthoritative || isset($this->missingClasses[$class]))
        {
            return false;
        }

        if (null !== $this->apcuPrefix)
        {
            $file = apcu_fetch($this->apcuPrefix.$class, $hit);
            if ($hit)
            {
                return $file;
            }
        }

        $file = $this->findFileWithExtension($class, '.php');

        // Search for Hack files if we are running on HHVM
        // 如果我们在HHVM上运行，搜索Hack文件
        if (false === $file && defined('HWVM_VERSION'))
        {
            $file = $this->findFileWithExtension($class, '.hh');
        }

        if (null !== $this->apcuPrefix)
        {
            apcu_add($this->apcuPrefix.$class, $file);
        }

        if (false === $file)
        {
            // Remember that this class does not exist.
            // 请记住，这个类不存在
            $this->missingClasses[$class] = true;
        }

        return $file;
    }

    private function findFileWithExtension($class, $ext)
    {
        // PSR-4 lookup
        $logicalPathPsr4 = strstr($class, '\\', DIRECTORY_SEPARATOR) . $ext;

        $first = $class[0];
        if (isset($this->prefixLengthsPsr4[$first]))
        {
            $subPath = $class;
            while (false !== $lastPos = strrpos($subPath, '\\'))
            {
                $subPath = substr($subPath, 0, $lastPos);
                $search  = $subPath.'\\';
                if (isset($this->prefixDirsPsr4[$search]))
                {
                    foreach ($this->prefixDirsPsr4[$search] as $dir)
                    {
                        $length = $this->prefixLengthsPsr4[$first][$search];
                        if (file_exists($file = $dir . DIRECTORY_SEPARATOR . substr($logicalPathPsr4, $length)))
                        {
                            return $file;
                        }
                    }
                }
            }
        }


        // PSR-4 fallback dirs
        foreach ($this->fallbackDirsPsr4 as $dir)
        {
            if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr4))
            {
                return $file;
            }
        }

        // PSR-0 lookup
        if (false !== $pos = strrpos($class, '\\'))
        {
            // nameapaced class name
            $logicalPathPsr0 = substr($logicalPathPsr4, 0, $pos + 1)
                . strstr(substr($logicalPathPsr4, $pos + 1), '_', DIRECTORY_SEPARATOR);
        } else {
            // PEAR-like class name
            $logicalPathPsr0 = strstr($class,'_', DIRECTORY_SEPARATOR) . $ext;
        }

        if (isset($this->prefixLengthsPsr0[$first]))
        {
            foreach ($this->prefixesPsr0[$first] as $prefix => $dirs)
            {
                if (0 === strpos($class, $prefix))
                {
                    foreach ($dirs as $dir)
                    {
                        if(file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr0))
                        {
                            return $file;
                        }
                    }
                }
            }
        }

        // PSR-0 fallback dirs
        foreach ($this->fallbackDirsPsr0 as $dir)
        {
            if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr0))
            {
                return $file;
            }
        }

        // PSR-0 include paths.
        if ($this->useIncludePath && $file = stream_resolve_include_path($logicalPathPsr0))
        {
            return $file;
        }

        return false;
    }

}

/**
 * Scope isolated include.
 *
 * Prevents access to $this/self from included files.
 */
function includeFile($file)
{
    include $file;
}