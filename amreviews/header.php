<?php
// $Id: header.php,v 1.2 2007/01/24 19:24:32 andrew Exp $
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
use Xoopsmodules\amreviews;

//include_once __DIR__ . '/class/psr4/setuploader.php';
include_once __DIR__ . '/include/setup.php';

//require __DIR__ . '/include/setup.php';
include_once dirname(dirname(__DIR__)) . '/mainfile.php';
include_once __DIR__ . '/include/config.inc.php';
//include_once  __DIR__ . '/include/functions.inc.php';
//include_once 'class/ratings.php';

xoops_load('XoopsRequest');

#include_once(XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . '/include/config.php');

/**
 * Set up classes.
 */
//$ratingsHandler = new amrRatings();

$ratingsHandler = new Xoopsmodules\amreviews\AmrRatings($db);

/**
 * For debug
 */
#if (function_exists("tmngstart")) { $tmngstart = tmngstart(); }

