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

use XoopsModules\Amreviews\Helper;

$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

require __DIR__ . '/preloads/autoloader.php';

$helper    = \XoopsModules\Amreviews\Helper::getInstance();
$language  = ucfirst($GLOBALS['xoopsConfig']['language']);
$lang      = $helper->getLanguage();
$langspace = '\XoopsModules\Amreviews\Locale\\' . $language;

$modversion = [
    'version'             => 2.01,
    'module_status'       => 'Beta 1',
    'release_date'        => '2020/05/27',
    'name'                => $lang::NAME,
    'description'         => $lang::DESC,
    'release'             => '2019-02-11',
    'author'              => 'XOOPS Development Team',
    'author_mail'         => 'name@site.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    //    'license' => 'GPL 2.0 or later',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',

    'release_info' => 'release_info',
    'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/release_info file",

    'manual'              => 'Installation.txt',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '7.2',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => $moduleDirName,
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin things
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Menu
    'hasMain'             => 1,
    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'reviews',
        $moduleDirName . '_' . 'cat',
        $moduleDirName . '_' . 'rate',
    ],
];
// ------------------- Search -----------------------------//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'amreviews_search';
//  ------------------- Comments -----------------------------//
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'com_id';
$modversion['comments']['pageName'] = 'comments.php';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'amreviewsCommentsApprove';
$modversion['comments']['callback']['update']  = 'amreviewsCommentsUpdate';
//  ------------------- Templates -----------------------------//
$modversion['templates'][] = ['file' => 'amreviews_header.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'amreviews_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'amreviews_reviews.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'amreviews_reviews_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'amreviews_cat.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'amreviews_cat_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'amreviews_rate.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'amreviews_rate_list0.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'amreviews_footer.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'admin/amreviews_admin_about.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/amreviews_admin_help.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/amreviews_admin_rate.tpl', 'description' => ''];

// ------------------- Help files ------------------- //
$modversion['help']        = 'page=help';
$modversion['helpsection'] = [
    ['name' => $lang::OVERVIEW, 'link' => 'page=help'],
    ['name' => $lang::DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => $lang::LICENSE, 'link' => 'page=license'],
    ['name' => $lang::SUPPORT, 'link' => 'page=support'],
];

// ------------------- Blocks -----------------------------//
$modversion['blocks'][] = [
    'file'        => 'reviews.php',
    'name'        => $lang::REVIEWS_BLOCK,
    'description' => '',
    'show_func'   => 'showAmreviewsReviews',
    'edit_func'   => 'editAmreviewsReviews',
    'options'     => '|5|25|0',
    'template'    => 'amreviews_reviews_block.tpl',
];

$modversion['blocks'][] = [
    'file'        => 'cat.php',
    'name'        => $lang::CATEGORY_BLOCK,
    'description' => '',
    'show_func'   => 'showAmreviewsCat',
    'edit_func'   => 'editAmreviewsCat',
    'options'     => '|5|25|0',
    'template'    => 'amreviews_cat_block.tpl',
];

// ------------------- Config Options -----------------------------//
xoops_load('xoopseditorhandler');
$editorHandler          = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'amreviewsEditorAdmin',
    'title'       => $langspace . '::EDITOR_ADMIN',
    'description' => $langspace . '::EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'tinymce',
];

$modversion['config'][] = [
    'name'        => 'amreviewsEditorUser',
    'title'       => $langspace . '::EDITOR_USER',
    'description' => $langspace . '::EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea',
];

// -------------- Get groups --------------
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler = xoops_getHandler('member');
$xoopsGroups   = $memberHandler->getGroupList();
foreach ($xoopsGroups as $key => $group) {
    $groups[$group] = $key;
}
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => $langspace . '::GROUPS',
    'description' => $langspace . '::GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $groups,
    'default'     => $groups,
];

// -------------- Get Admin groups --------------
$criteria = new \CriteriaCompo ();
$criteria->add(new \Criteria ('group_type', 'Admin'));
/** @var \XoopsMemberHandler $memberHandler */
$memberHandler    = xoops_getHandler('member');
$adminXoopsGroups = $memberHandler->getGroupList($criteria);
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $admin_groups[$adminGroup] = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => $langspace . '::ADMINGROUPS',
    'description' => $langspace . '::ADMINGROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $admin_groups,
    'default'     => $admin_groups,
];

$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => $langspace . '::KEYWORDS',
    'description' => $langspace . '::KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'amreviews,',
];

// --------------Uploads : maxsize of image --------------
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => $langspace . '::MAXSIZE',
    'description' => $langspace . '::MAXSIZE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5000000,
];

// --------------Uploads : mimetypes of image --------------
$modversion['config'][] = [
    'name'        => 'mimetypes',
    'title'       => $langspace . '::MIMETYPES',
    'description' => $langspace . '::MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/jpg', 'image/png'],
    'options'     => [
        'bmp'   => 'image/bmp',
        'gif'   => 'image/gif',
        'pjpeg' => 'image/pjpeg',
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpg',
        'jpe'   => 'image/jpe',
        'png'   => 'image/png',
    ],
];

$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => $langspace . '::ADMINPAGER',
    'description' => $langspace . '::ADMINPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => $langspace . '::USERPAGER',
    'description' => $langspace . '::USERPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => $langspace . '::ADVERTISE',
    'description' => $langspace . '::ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];

$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => $langspace . '::BOOKMARKS',
    'description' => $langspace . '::BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

$modversion['config'][] = [
    'name'        => 'fbcomments',
    'title'       => $langspace . '::FBCOMMENTS',
    'description' => $langspace . '::FBCOMMENTS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// Truncate Max. length 
$modversion['config'][] = [
    'name'        => 'truncatelength',
    'title'       => $langspace . '::TRUNCATE_LENGTH',
    'description' => $langspace . '::TRUNCATE_LENGTH_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 100,
];

/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => $langspace . '::SHOW_SAMPLE_BUTTON',
    'description' => $langspace . '::SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Show Developer Tools?
 */
$modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => $langspace . '::SHOW_DEV_TOOLS',
    'description' => $langspace . '::SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// -------------- Notifications amreviews --------------
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'amreviews_notify_iteminfo';

$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => $lang::GLOBAL_NOTIFY,
    'description'    => $lang::GLOBAL_NOTIFY_DESC,
    'subscribe_from' => ['index.php', 'viewcat.php', 'singlefile.php'],
];

$modversion['notification']['category'][] = [
    'name'           => 'category',
    'title'          => $lang::CATEGORY_NOTIFY,
    'description'    => $lang::CATEGORY_NOTIFY_DESC,
    'subscribe_from' => ['viewcat.php', 'singlefile.php'],
    'item_name'      => 'cid',
    'allow_bookmark' => 1,
];

$modversion['notification']['category'][] = [
    'name'           => 'file',
    'title'          => $lang::FILE_NOTIFY,
    'description'    => $lang::FILE_NOTIFY_DESC,
    'subscribe_from' => 'cat.php',
    'item_name'      => 'id',
    'allow_bookmark' => 1,
];

// -------------- Mail Notifications ----------------------------

$modversion['notification']['event'][] = [
    'name'          => 'new_category',
    'category'      => 'global',
    'title'         => $lang::GLOBAL_NEWCATEGORY_NOTIFY,
    'caption'       => $lang::GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
    'description'   => $lang::GLOBAL_NEWCATEGORY_NOTIFY_DESC,
    'mail_template' => 'global_newcategory_notify',
    'mail_subject'  => $lang::GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_modify',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => $lang::GLOBAL_FILEMODIFY_NOTIFY,
    'caption'       => $lang::GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
    'description'   => $lang::GLOBAL_FILEMODIFY_NOTIFY_DESC,
    'mail_template' => 'global_filemodify_notify',
    'mail_subject'  => $lang::GLOBAL_FILEMODIFY_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => $lang::GLOBAL_FILEBROKEN_NOTIFY,
    'caption'       => $lang::GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
    'description'   => $lang::GLOBAL_FILEBROKEN_NOTIFY_DESC,
    'mail_template' => 'global_filebroken_notify',
    'mail_subject'  => $lang::GLOBAL_FILEBROKEN_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => $lang::GLOBAL_FILESUBMIT_NOTIFY,
    'caption'       => $lang::GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => $lang::GLOBAL_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'global_filesubmit_notify',
    'mail_subject'  => $lang::GLOBAL_FILESUBMIT_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'global',
    'title'         => $lang::GLOBAL_NEWFILE_NOTIFY,
    'caption'       => $lang::GLOBAL_NEWFILE_NOTIFY_CAPTION,
    'description'   => $lang::GLOBAL_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'global_newfile_notify',
    'mail_subject'  => $lang::GLOBAL_NEWFILE_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'category',
    'admin_only'    => 1,
    'title'         => $lang::CATEGORY_FILESUBMIT_NOTIFY,
    'caption'       => $lang::CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => $lang::CATEGORY_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'category_filesubmit_notify',
    'mail_subject'  => $lang::CATEGORY_FILESUBMIT_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'category',
    'title'         => $lang::CATEGORY_NEWFILE_NOTIFY,
    'caption'       => $lang::CATEGORY_NEWFILE_NOTIFY_CAPTION,
    'description'   => $lang::CATEGORY_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'category_newfile_notify',
    'mail_subject'  => $lang::CATEGORY_NEWFILE_NOTIFY_SUBJECT,
];

$modversion['notification']['event'][] = [
    'name'          => 'approve',
    'category'      => 'file',
    'admin_only'    => 1,
    'title'         => $lang::FILE_APPROVE_NOTIFY,
    'caption'       => $lang::FILE_APPROVE_NOTIFY_CAPTION,
    'description'   => $lang::FILE_APPROVE_NOTIFY_DESC,
    'mail_template' => 'file_approve_notify',
    'mail_subject'  => $lang::FILE_APPROVE_NOTIFY_SUBJECT,
];
