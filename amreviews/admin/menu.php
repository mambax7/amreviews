<?php
// $Id: menu.php,v 1.2 2007/01/24 19:15:59 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//	About:  This file is part of the AM Reviews module for Xoops v2.         //
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
defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$path = dirname(dirname(dirname(dirname(__FILE__))));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(dirname(__FILE__)));
$module_handler  = xoops_gethandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;


if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

include_once $fileinc;

$adminmenu = array();

$i= 1;

$adminmenu[$i]["title"] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]["link"]  = 'admin/index.php';
$adminmenu[$i]["icon"]  = $pathIcon32 . '/home.png';

//$i++;
//$adminmenu[$i]["title"] =_MI_AMREVIEW_MENU1;
//$adminmenu[$i]["link"]  = 'admin/main.php';
//$adminmenu[$i]["icon"]  = $pathIcon32.'/home.png';

$i++;
$adminmenu[$i]["title"] =_MI_AMREVIEW_MENU2;
$adminmenu[$i]["link"]  = 'admin/category.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/category.png';

$i++;
$adminmenu[$i]["title"] = _MI_AMREVIEW_MENU3;
$adminmenu[$i]["link"]  = 'admin/review.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/button_ok.png';
$i++;
$adminmenu[$i]["title"] = _MI_AMREVIEW_MENU4;
$adminmenu[$i]["link"]  = 'admin/image.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/photo.png';
$i++;
$adminmenu[$i]["title"] = _MI_AMREVIEW_MENU5;
$adminmenu[$i]["link"]  = 'admin/perms.php';
$adminmenu[$i]["icon"]  = $pathIcon32.'/permissions.png';

$i++;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]["link"]  = 'admin/about.php';
$adminmenu[$i]["icon"]  = $pathIcon32 . '/about.png';