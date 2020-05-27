<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * AmReviews module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        amreviews
 * @since          1.0
 * @min_xoops      2.5.10
 * @author         Mamba - Email:<info@email.com> - Website:<http://xoops.org>
 */

use XoopsModules\Amreviews\Helper;

//if (count($xoBreadcrumbs) > 1) {
//    $GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
//}

$helper       = Helper::getInstance();
$lang         = $helper->getLanguage();

include_once XOOPS_ROOT_PATH . '/include/notification_select.php';

$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));
// 
$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));
// 
$GLOBALS['xoopsTpl']->assign('admin', $lang::ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
// 
require_once XOOPS_ROOT_PATH . '/footer.php';

define('_MI_NEWS_GLOBAL_NOTIFY', 'global notification');
define('_MI_NEWS_GLOBAL_NOTIFYDSC', 'applied to the entire news module notification options');
define('_MI_NEWS_STORY_NOTIFY', 'categories - news');
define('_MI_NEWS_STORY_NOTIFYDSC', 'applied to the current classification of notification options.');
