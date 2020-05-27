<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package     review
 * @since       1.0
 * @author      Andrew Mills (ajmills@sirium.net), XOOPS Development Team
 * @version     $Id $
 */

$moduleDirName = basename(__DIR__);
$modinfoLang   = '_MI_' . strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion = array(
    'name'                => constant($modinfoLang . '_NAME'),
    'description'         => constant($modinfoLang . '_DESC'),
    'official'            => 0, //1 indicates supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => 'Andrew Mills',
    'author_mail'         => 'ajmills@sirium.net',
    'author_website_url'  => 'http://support.sirium.net',
    'author_website_name' => 'Sirium',
    'credits'             => 'XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'help'                => 'page=help',
    //
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . "/modules/{$moduleDirName}/docs/changelog file",
    //
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/install.txt",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.7.2',
    'min_admin'           => '1.1',
    'min_db'              => array('mysql' => '5.0.7', 'mysqli' => '5.0.7'),
    // images
    'image'               => 'assets/images/module_logo.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => $moduleDirName,
    //Frameworks
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => 'Frameworks/moduleclasses/icons/16',
    'sysicons32'          => 'Frameworks/moduleclasses/icons/32',
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'version'             => 1.00,
    'module_status'       => 'Beta 1',
    'release_date'        => '2015/07/06', //yyyy/mm/dd
    //    'release'             => '2015-04-04',
    'demo_site_url'       => 'http://www.xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin menu
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Main menu
    'hasMain'             => 1,
    //Search & Comments
    'hasSearch'           => 1,
    'search'              => array(
        'file' => 'include/search.inc.php',
        'func' => $moduleDirName . '_' . 'search'),
    'hasComments'         => 1,
    'comments'            => array(
        'pageName' => 'review.php',
        'itemName' => 'id'),
    // Install/Update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php'//  'onUninstall'         => 'include/onuninstall.php'

);

// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'] = array(
    $moduleDirName . '_' . 'reviews',
    $moduleDirName . '_' . 'cat',
    $moduleDirName . '_' . 'rate');

// ------------------- Templates ------------------- //

$modversion['templates'] = array(
    array('file' => 'amr_index.tpl', 'description' => ''),
    array('file' => 'amr_review.tpl', 'description' => ''),
    array('file' => 'amr_rate.tpl', 'description' => ''),
    array('file' => 'amr_print.tpl', 'description' => ''));

// ------------------- blocks ------------------- //

//$modversion['blocks'][] = array(
//    'file'        => 'blocks_subscrinfo.php',
//    'name'        => $modinfoLang . '_SUBSCRINFO_BLOCK',
//    'description' => '',
//    'show_func'   => 'b_xnewsletter_subscrinfo',
//    'edit_func'   => '',
//    'template'    => 'xnewsletter_subscrinfo_block.tpl',
//    'can_clone'   => true,
//    'options'     => '');

// ------------------- Config Options ------------------- //

#$modversion['config'][1]['name']       = 'indextype';
#$modversion['config'][1]['title']      = $modinfoLang . '_OTPN_INDEX';
#$modversion['config'][1]['description']    = $modinfoLang . '_OTPN_INDEXDESC';
#$modversion['config'][1]['formtype']   = 'select';
#$modversion['config'][1]['valuetype']  = 'int';
#$modversion['config'][1]['default']        = '0';
#$modversion['config'][1]['options']        = array('default' => '0', 'Directory' => '1');

// Number of category columns in directory view
$modversion['config'][] = array(
    'name'        => 'indexcolumns',
    'title'       => $modinfoLang . '_INDXCOL',
    'description' => $modinfoLang . '_INDXCOLDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '2');

// Date format - review page
$modversion['config'][] = array(
    'name'        => 'indxlistdatefrmt',
    'title'       => $modinfoLang . '_DATEFRMTINDX',
    'description' => $modinfoLang . '_DATEFRMTINDXDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'Y/m/d');

// Date format - review page
$modversion['config'][] = array(
    'name'        => 'dateformat',
    'title'       => $modinfoLang . '_DATEFRMT',
    'description' => $modinfoLang . '_DATEFRMTDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'Y/m/d');

// Date format - print page
$modversion['config'][] = array(
    'name'        => 'dateformatprint',
    'title'       => $modinfoLang . '_DATEFRMTPRT',
    'description' => $modinfoLang . '_DATEFRMTPRTDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'D, j F Y');

// Date format - review page
$modversion['config'][] = array(
    'name'        => 'dateformatpdf',
    'title'       => $modinfoLang . '_DATEFRMTPDF',
    'description' => $modinfoLang . '_DATEFRMTPDFDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'Y/m/d');

// Show reviewed by
$modversion['config'][] = array(
    'name'        => 'showreviewedby',
    'title'       => $modinfoLang . '_SHWRVWDBY',
    'description' => $modinfoLang . '_SHWRVWDBYDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 1);

/*
// Show reviewed on (show/hide date)
$modversion['config'][] = array(
    'name'        => 'showreviewedon',
    'title'       => $modinfoLang . '_OPT_SHWRVWDON',
    'description' => $modinfoLang . '_OPT_SHWRVWDONDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1
);
*/

// Show print version
$modversion['config'][] = array(
    'name'        => 'showprint',
    'title'       => $modinfoLang . '_SHWPRINT',
    'description' => $modinfoLang . '_SHWPRINTDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// Allow e-mail to friend feature.
$modversion['config'][] = array(
    'name'        => 'allowpdf',
    'title'       => $modinfoLang . '_ALLOWPDF',
    'description' => $modinfoLang . '_ALLOWPDFDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// Allow e-mail to friend feature.
$modversion['config'][] = array(
    'name'        => 'allowemail',
    'title'       => $modinfoLang . '_ALLOWEMAIL',
    'description' => $modinfoLang . '_ALLOWEMAILDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// Log in to use - emailtofriendlogin
$modversion['config'][] = array(
    'name'        => 'emailtofriendlogin',
    'title'       => $modinfoLang . '_EMLLOGGEDIN',
    'description' => $modinfoLang . '_EMLLOGGEDINDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// Allow user to include own message
$modversion['config'][] = array(
    'name'        => 'emailtofriendownmsg',
    'title'       => $modinfoLang . '_OPTION_EMLOWNMSG',
    'description' => $modinfoLang . '_OPTION_EMLOWNMSGDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// Characters in message
$modversion['config'][] = array(
    'name'        => 'emailtofreindchars',
    'title'       => $modinfoLang . '_OPTION_EMLMSGCHRS',
    'description' => $modinfoLang . '_OPTION_EMLMSGCHRSDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '200');

// Subject text
$modversion['config'][] = array(
    'name'        => 'emailtofreindsubect',
    'title'       => $modinfoLang . '_OPTION_EMLMSGSBJCT',
    'description' => $modinfoLang . '_OPTION_EMLMSGSBJCTDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => constant($modinfoLang . '_OPTION_EMLMSGSUBJECT'));

// send to friend e-mail text
$modversion['config'][] = array(
    'name'        => 'emailtext',
    'title'       => $modinfoLang . '_OPTION_EMAILTXT',
    'description' => $modinfoLang . '_OPTION_EMAILTXTSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => constant($modinfoLang . '_OPTION_EMAILTXTMSG'));

/*
// Index page header text
$modversion['config'][] = array(
    'name'        => 'headertext',
    'title'       => $modinfoLang . '_OPT_HEADER',
    'description' => $modinfoLang . '_OPT_HEADERDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => $modinfoLang . '_OPT_HEADERTXT''
);
*/

// Item details template
$modversion['config'][] = array(
    'name'        => 'itemdetailtpl',
    'title'       => $modinfoLang . '_DETAILTPL',
    'description' => $modinfoLang . '_DETAILTPLDSC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => constant($modinfoLang . '_DETAILTPLTXT'));

// Do not increment admin views
$modversion['config'][] = array(
    'name'        => 'noincrementifadmin',
    'title'       => $modinfoLang . '_INCREMENTADMIN',
    'description' => $modinfoLang . '_INCREMENTADMINDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// default admin editor
xoops_load('XoopsEditorHandler');
$editor_handler         = &XoopsEditorHandler::getInstance();
$editorList             = array_flip($editor_handler->getList());
$modversion['config'][] = array(
    'name'        => 'amrevieweditadmin',
    'title'       => $modinfoLang . '_EDITADMIN',
    'description' => $modinfoLang . '_EDITADMINDSC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => $editorList);

//
$modversion['config'][] = array(
    'name'        => 'photopath',
    'title'       => $modinfoLang . '_PHOTOPATH',
    'description' => $modinfoLang . '_PHOTOPATHDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => "/uploads/{$moduleDirName}/photos");

// Maximum upload size - admin
$modversion['config'][] = array(
    'name'        => 'maxuploadadmin',
    'title'       => $modinfoLang . '_MAXUPADMIN',
    'description' => $modinfoLang . '_MAXUPADMINDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '200');

// Highlight image - default width (used in review/cat listing)
$modversion['config'][] = array(
    'name'        => 'imghighwdith',
    'title'       => $modinfoLang . '_IMGHIGHWIDTH',
    'description' => $modinfoLang . '_IMGHIGHWIDTHDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '80');

// Thumbnail image - default width (used in review article)
$modversion['config'][] = array(
    'name'        => 'imgthumbwdith',
    'title'       => $modinfoLang . '_IMGTHUMBWIDTH',
    'description' => $modinfoLang . '_IMGTHUMBWIDTHDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => '120');

// show/hide showsubcats
$modversion['config'][] = array(
    'name'        => 'showsubcats',
    'title'       => $modinfoLang . '_SHOWSUBCATS',
    'description' => $modinfoLang . '_SHOWSUBCATSDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);

// show/hide cats for people who do not have permission to view.
$modversion['config'][] = array(
    'name'        => 'hidenopermcats',
    'title'       => $modinfoLang . '_HIDENOPERMCATS',
    'description' => $modinfoLang . '_HIDENOPERMCATSDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0);

// Default page title options.
$modversion['config'][] = array(
    'name'        => 'pagettldefault',
    'title'       => $modinfoLang . '_PAGETTLDEF',
    'description' => $modinfoLang . '_PAGETTLDEFDSC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => '0',
    'options'     => array(
        $modinfoLang . '_PAGETTLDEF_OPT_0' => '0',
        $modinfoLang . '_PAGETTLDEF_OPT_1' => '1',
        $modinfoLang . '_PAGETTLDEF_OPT_2' => '2'));

// Default page meta tag options
$modversion['config'][] = array(
    'name'        => 'pagemetadefault',
    'title'       => $modinfoLang . '_PAGEMETADEF',
    'description' => $modinfoLang . '_PAGEMETADEFDSC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => '0',
    'options'     => array($modinfoLang . '_PAGEMETADEF_OPT_0' => '0', $modinfoLang . '_PAGEMETADEF_OPT_1' => '1')//, $modinfoLang . '_PAGEMETADEF_OPT_2' => '2')
);

// Logged in to vote
$modversion['config'][] = array(
    'name'        => 'loggedinvote',
    'title'       => $modinfoLang . '_LOGGEDINVOTE',
    'description' => $modinfoLang . '_LOGGEDINVOTEDSC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0);

// Default page meta tag options
$modversion['config'][] = array(
    'name'        => 'hiliteimg',
    'title'       => $modinfoLang . '_HILITEIMG',
    'description' => $modinfoLang . '_HILITEIMGDSC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => array($modinfoLang . '_HILITEIMG_OPT_0' => '0', $modinfoLang . '_HILITEIMG_OPT_1' => '1')//, $modinfoLang . '_PAGEMETADEF_OPT_2' => '2')
);
