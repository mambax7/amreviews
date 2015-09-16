<?php
// $Id: menu.php,v 1.2 2007/01/24 19:15:59 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//  About:  This file is part of the AM Reviews module for Xoops v2.         //
//                                                                           //
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';

$moduleDirName = basename(dirname(__DIR__));
$moduleHandler = &xoops_gethandler('module');
$module        = $moduleHandler->getByDirname($moduleDirName);
$pathIcon32    = '../../' . $module->getInfo('sysicons32');

$xoopsModuleAdminPath = XOOPS_ROOT_PATH . '/' . $module->getInfo('dirmoduleadmin');
if (!file_exists($fileinc = $xoopsModuleAdminPath . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $xoopsModuleAdminPath . '/language/english/main.php';
}
include_once $fileinc;

xoops_loadLanguage('modinfo', $moduleDirName);

//include_once $GLOBALS['xoops']->path("modules/{$moduleDirName}/include/config.php");

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png');
//global $modinfoLang;
//include_once dirname(__DIR__) . '/class/helper.php';
//$helper      = & Helper::getInstance();
use Xoopsmodules\amreviews;

$helper = new Xoopsmodules\amreviews\Helper();
//echo $modinfoLang. '<br/>';
//echo '--- 1  ----'. '<br/>';
$mainLang    = '_MD_' . strtoupper($helper->moduleDirName);
$modinfoLang = '_MI_' . strtoupper($helper->moduleDirName);
$adminLang   = '_AM_' . strtoupper($helper->moduleDirName);
//echo $mainLang. '<br/>';
//echo $modinfoLang. '<br/>';
//echo $adminLang. '<br/>';
//echo strtoupper($helper->moduleDirName). '<br/>';
//echo '--- 2  ----'. '<br/>';
$adminmenu[] = array(
    //    'title' => $modinfoLang . '_MENU2',
    'title' => constant($modinfoLang . '_MENU2'),
    'link'  => 'admin/category.php',
    'icon'  => $pathIcon32 . '/category.png');

$adminmenu[] = array(
    'title' => constant($modinfoLang . '_MENU3'),
    'link'  => 'admin/review.php',
    'icon'  => $pathIcon32 . '/button_ok.png');

$adminmenu[] = array(
    'title' => constant($modinfoLang . '_MENU4'),
    'link'  => 'admin/image.php',
    'icon'  => $pathIcon32 . '/photo.png');

$adminmenu[] = array(
    'title' => constant($modinfoLang . '_MENU5'),
    'link'  => 'admin/permissions.php',
    'icon'  => $pathIcon32 . '/permissions.png');

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png');
