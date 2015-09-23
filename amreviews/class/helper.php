<?php namespace Xoopsmodules\amreviews;

    /*
     You may not change or alter any portion of this comment or credits
     of supporting developers from this source code or any supporting source code
     which is considered copyrighted (c) material of the original comment or credit authors.

     This program is distributed in the hope that it will be useful,
     but WITHOUT ANY WARRANTY; without even the implied warranty of
     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    */
    /**
     * xoalbum module for xoops
     *
     * @copyright       XOOPS Project (http://xoops.org)
     * @license         GPL 2.0 or later
     * @package         xoalbum
     * @since           2.0.0
     * @author          XOOPS Development Team <name@site.com> - <http://xoops.org>
     * @version         $Id: 2.10 helper.php 11532 Mon 2014/04/28 11:10:05Z XOOPS Development Team $
     */

    //namespace Xoopsmodules\Amreview;

    //defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Class Helper
 */
class Helper   /*extends Module_Helper_Abstract*/
{
    /**
     * Init vars
     * @initialize variables
     */
    private $config;
    private $dirname;
    private $handler;
    private $module;
    public  $moduleDirName;

    /**
     * Constructor
     *
     * @param $dirname
     */
    public function __construct($dirname = '')
    {
        $this->dirname = $dirname;
        $this->init();
    }

    public function init()
    {
        //        $this->setDirname('alumni');
        //        $moduleDirName = basename(dirname(__DIR__));
        $this->setDirname(basename(dirname(__DIR__)));

        $this->moduleDirName = basename(dirname(__DIR__));

        //        $this->criteriaFactory = new CriteriaFactory;
        //        $this->formElementFactory = new FormElementFactory;

        //$this->setDebug(true);
        //    $this->loadLanguage('modinfo');
    }

    /**
     * @param string $dirname dirname of the module
     */
    protected function setDirname($dirname)
    {
        $this->dirname = strtolower($dirname);
    }

    /**
     * Get instance
     * @return object
     */
    public static function &getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Init config
     * @initialize object
     */
    public function initConfig()
    {
        $modConfigHandler = &xoops_gethandler('config');
        $this->_config    = $modConfigHandler->getConfigsByCat(0, $this->getModule()->getVar('mid'));
    }

    /**
     * Init module
     * @initialize object
     */
    public function initModule()
    {
        global $xoopsModule;
        if (isset($xoopsModule) && is_object($xoopsModule) && $xoopsModule->getVar('dirname') === $this->dirname) {
            $this->_module = $xoopsModule;
        } else {
            $moduleHandler = &xoops_gethandler('module');
            $this->_module = $moduleHandler->getByDirname($this->dirname);
        }
    }

    /**
     * Init handler
     * @initialize object
     * @param $name
     */
    public function initHandler($name)
    {
        $this->handler[$name . '_handler'] = &xoops_getmodulehandler($name, $this->dirname);
    }

    /**
     * Get module
     * @return object
     */
    public function &getModule()
    {
        if ($this->module === null) {
            $this->initModule();
        }

        return $this->module;
    }

    /**
     * Get modules
     *
     * @param array $dirnames
     * @param null  $otherCriteria
     * @param bool  $asObj
     *
     * @return array objects
     */
    public function &getModules(array $dirnames = null, $otherCriteria = null, $asObj = false)
    {
        // get all dirnames
        $moduleHandler = &xoops_gethandler('module');
        $criteria      = new CriteriaCompo();
        if (count($dirnames) > 0) {
            foreach ($dirnames as $mDir) {
                $criteria->add(new Criteria('dirname', $mDir), 'OR');
            }
        }
        if (!empty($otherCriteria)) {
            $criteria->add($otherCriteria);
        }
        $criteria->add(new Criteria('isactive', 1), 'AND');
        $modules = $moduleHandler->getObjects($criteria, true);
        if ($asObj) {
            return $modules;
        }
        $dirs['system-root'] = _YOURHOME;
        foreach ($modules as $module) {
            $dirs[$module->dirname()] = $module->name();
        }

        return $dirs;
    }

    /**
     * Get handler
     *
     * @param $name
     *
     * @return object
     */
    public function &getHandler($name)
    {
        if (!isset($this->handler[$name . 'Handler'])) {
            $this->initHandler($name);
        }

        return $this->handler[$name . 'Handler'];
    }

    /**
     * @return string
     */
    public function getModuleDirName()
    {
        //        $moduleDirName = $this->_dirname;
        //        $moduleDirName2 = basename(dirname(__DIR__));
        //        $moduleDirName3 = $this->dirName;
        return $this->moduleDirName;
    }
}
