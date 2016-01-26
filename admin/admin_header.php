<?php
### =============================================================
### Mastop InfoDigital - Paix�o por Internet
### =============================================================
### Header com includes padr�es para a Admin do M�dulo
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital � 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
### $Id: admin_header.php,v 1.3 2007/05/15 09:17:05 topet05 Exp $
### =============================================================
use Xoopsmodules\amreviews;

//include_once dirname(__DIR__) . '/class/psr4/setuploader.php';
include_once dirname(__DIR__) . '/include/setup.php';

$moduleDirName = basename(dirname(__DIR__));
include_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';
include_once $GLOBALS['xoops']->path('www/include/cp_functions.php');
include_once $GLOBALS['xoops']->path('www/include/cp_header.php');
include_once $GLOBALS['xoops']->path('www/class/xoopsformloader.php');

xoops_load('XoopsRequest');

//include_once dirname(__DIR__) . '/class/helper.php';
//$helper      = &Xoopsmodules\amreviews\Helper::getInstance();

//$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');

$pathIcon16           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons16'));
$pathIcon32           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons32'));
$xoopsModuleAdminPath = $GLOBALS['xoops']->path('www/' . $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin'));
require_once $xoopsModuleAdminPath . '/moduleadmin.php';

$myts =& MyTextSanitizer::getInstance();
if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    include_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
}

//Module specific elements
//include_once $GLOBALS['xoops']->path("modules/{$moduleDirName}/include/functions.php");
//include_once $GLOBALS['xoops']->path("modules/{$moduleDirName}/include/config.php");

//Handlers
//$XXXHandler =& xoops_getModuleHandler('XXX', $moduleDirName);

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);

//xoops_cp_header();
//$adminObject = new ModuleAdmin();
