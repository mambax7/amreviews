<?php

declare(strict_types=1);

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

use XoopsModules\{Amreviews, Amreviews\Common, Amreviews\Helper};

require dirname(dirname(__DIR__)) . '/mainfile.php';

//require XOOPS_ROOT_PATH . '/header.php';

require __DIR__ . '/preloads/autoloader.php';
require __DIR__ . '/include/common.php';
$moduleDirName = basename(__DIR__);

$helper       = Helper::getInstance();
$lang         = $helper->getLanguage();
$utility      = new Amreviews\Utility();
$configurator = new Common\Configurator();
$copyright    = $configurator->modCopyright;

$modulePath = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
$db         = \XoopsDatabaseFactory::getDatabaseConnection();

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new \xos_opal_Theme();
}

$stylesheet = "modules/{$moduleDirName}/assets/css/style.css";
if (file_exists($GLOBALS['xoops']->path($stylesheet))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$stylesheet}"));
}
/** @var \XoopsPersistableObjectHandler $reviewsHandler */
$reviewsHandler = $helper->getHandler('Reviews');
/** @var \XoopsPersistableObjectHandler $catHandler */
$catHandler = $helper->getHandler('Cat');
/** @var \XoopsPersistableObjectHandler $rateHandler */
$rateHandler = $helper->getHandler('Rate');

$GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

