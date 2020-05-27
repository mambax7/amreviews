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

require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var \XoopsModules\Amreviews\Helper $helper */
$helper = Amreviews\Helper::getInstance();
//$helper->loadLanguage('common');
//$helper->loadLanguage('feedback');
$lang = $helper->getLanguage();

// get path to icons
$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getConfig('modicons32');
}

$adminObject = \Xmf\Module\Admin::getInstance();

$adminmenu[] = [
    'title' => $lang::ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => "{$pathIcon32}/home.png",
];

$adminmenu[] = [
    'title' => $lang::ADMENU3,
    'link'  => 'admin/cat.php',
    'icon'  => "{$pathIcon32}/category.png",
];

$adminmenu[] = [
    'title' => $lang::ADMENU2,
    'link'  => 'admin/reviews.php',
    'icon'  => "{$pathIcon32}/administration.png",
];

$adminmenu[] = [
    'title' => $lang::ADMENU4,
    'link'  => 'admin/rate.php',
    'icon'  => "{$pathIcon32}/button_ok.png",
];

$adminmenu[] = [
    'title' => $lang::ADMENU8,
    'link'  => 'admin/permissions.php',
    'icon'  => "{$pathIcon32}/permissions.png",
];

$adminmenu[] = [
    'title' => $lang::ADMENU5,
    'link'  => 'admin/feedback.php',
    'icon'  => "{$pathIcon32}/mail_foward.png",
];

$adminmenu[] = [
    'title' => $lang::BLOCKS,
    'link'  => 'admin/blocksadmin.php',
    'icon'  => "{$pathIcon32}/block.png",
];

if (is_object($helper->getModule()) && $helper->getConfig('displayDeveloperTools')) {
    $adminmenu[] = [
        'title' => $lang::ADMENU6,
        'link'  => 'admin/migrate.php',
        'icon'  => "{$pathIcon32}/database_go.png",
    ];
}

$adminmenu[] = [
    'title' => $lang::ADMENU7,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png",
];
