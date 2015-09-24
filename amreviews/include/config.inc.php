<?php
// $Id: config.inc.php,v 1.3 2007/01/24 19:18:48 andrew Exp $
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

// includes
#include_once('header.php');

// Version
define('_AM_AMRVERSION', '0.10');

/**
 * Some config options that may not be changed too oftion
 * and are in here to prevent prefs area getting too
 * cluttered.
 */
// allow to change extension of want to use PNG or JPG, etc.
define('_AM_AMR_RATESTAREXT', 'png');

// For cloning - not entirely sure this will work, yet.
define('_AM_AMRMODDIR', 'amreviews');

/*
* This next part loads a file with some debug options.
* The debug file should not be included in distro, so
* will not affect released versions.
*/
#if (file_exists(XOOPS_ROOT_PATH . '/modules/amreviews/include/debug.php')) {
#   include(XOOPS_ROOT_PATH . '/modules/amreviews/include/debug.php');
#   #include_once(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/config.php');
#}
