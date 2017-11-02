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
}