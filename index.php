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

use XoopsModules\Amreviews;
use XoopsModules\Amreviews\Helper;

$GLOBALS['xoopsOption']['template_main'] = 'amreviews_index.tpl';
require __DIR__ . '/header.php';
require XOOPS_ROOT_PATH . '/header.php';
//require __DIR__ . '/include/config.php';

global $xoTheme;

// Define Stylesheet
/** @var xos_opal_Theme $xoTheme */
$xoTheme->addStylesheet($stylesheet);
// keywords
$utility::metaKeywords($helper->getConfig('keywords'));
// description
$utility::metaDescription($lang::DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('index.php'));
$GLOBALS['xoopsTpl']->assign('amreviews_url', $helper->url());
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));
//
$GLOBALS['xoopsTpl']->assign('admin', $lang::ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

$GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());
//
require __DIR__ . '/footer.php';
