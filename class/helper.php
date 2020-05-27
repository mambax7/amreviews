<?php

declare(strict_types=1);

namespace XoopsModules\Amreviews;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * Module: Amreviews
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 */

/**
 * Class Helper
 */
class Helper extends \Xmf\Module\Helper
{
    public $debug;

    /**
     * Constructor
     *
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        $this->debug   = $debug;
        $moduleDirName = \basename(\dirname(__DIR__));
        parent::__construct($moduleDirName);
    }

    /**
     * @param bool $debug
     * @return \XoopsModules\Amreviews\Helper
     */
    public static function getInstance($debug = false)
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($debug);
        }
        return $instance;
    }

    /**
     * @return string
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * Get an Object Handler
     *
     * @param string $name name of handler to load
     *
     * @return bool|\XoopsObjectHandler|\XoopsPersistableObjectHandler
     */
    public function getHandler($name)
    {
        //$ret   = false;
        $class = __NAMESPACE__ . '\\' . \ucfirst($name) . 'Handler';
        if (!\class_exists($class)) {
            throw new \RuntimeException("Class '$class' not found");
        }
        /** @var \XoopsMySQLDatabase $db */
        $db     = \XoopsDatabaseFactory::getDatabaseConnection();
        $helper = self::getInstance();
        $ret    = new $class($db, $helper);
        $this->addLog("Getting handler '{$name}'");
        return $ret;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        $language  = \ucfirst($GLOBALS['xoopsConfig']['language']);
        $className = __NAMESPACE__ . '\Locale\\' . $language;
        //        setlocale(LC_ALL, 'en_US');
        //        xoops_load('XoopsLocal');
        //        $className = __NAMESPACE__ .  '\Locale\\' . LC_ALL . '\Locale';

        if (!\class_exists($className)) {
            throw new \RuntimeException("Language Class '$className' not found");
        }
        if (\class_exists($className)) {
            $lang = new $className();
            return $lang;
        }
    }

    /**
     * @return string
     */
    public function getLanguageClass()
    {
        $language  = \ucfirst($GLOBALS['xoopsConfig']['language']);
        $className = __NAMESPACE__ . '\Locale\\' . $language;
        //        setlocale(LC_ALL, 'en_US');
        //        xoops_load('XoopsLocal');
        //        $className = __NAMESPACE__ .  '\Locale\\' . LC_ALL . '\Locale';

        if (!\class_exists($className)) {
            throw new \RuntimeException("Language Class '$className' not found");
        }
        return $className;
    }
}
