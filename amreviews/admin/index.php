<?php
// $Id: index.php 8066 2011-11-06 05:09:33Z beckmi $
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
// Author: Raul Recio (AKA UNFOR)                                            //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

include_once 'admin_header.php';
include_once("functions.inc.php");
include_once("../include/config.inc.php");
xoops_cp_header();

$summary = amr_summary();

$indexAdmin = new ModuleAdmin();
//-----------------------
 $indexAdmin->addInfoBox(_AM_AMREV_SUMMARY);

 $indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY,  "<b>"._AM_AMREV_WAITVALCAP ."</b>  ". sprintf(_AM_AMREV_WAITVAL,$summary['waitval']),  'Green');
 $indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY,   "<b>"._AM_AMREV_REVIEWTOTCAP ."</b>  ". sprintf(_AM_AMREV_REVIEWTOT, $summary['revcount']), 'Red');
$indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY,   "<b>"._AM_AMREV_CATETOTCAP ."</b>  ". sprintf(_AM_AMREV_CATETOT, $summary['catcount']),  'Red');
$indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY, "<b>"._AM_AMREV_VIEWSCAP  ."</b>  ". sprintf(_AM_AMREV_VIEWS, $summary['views']),  'Green');
 $indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY,  "<b>"._AM_AMREV_PUBLISHEDCAP ."</b>  ". sprintf(_AM_AMREV_PUBLISHED, $summary['published']),  'Red');
 $indexAdmin->addInfoBoxLine(_AM_AMREV_SUMMARY,  "<b>"._AM_AMREV_HIDDENCAP ."</b>  ". sprintf(_AM_AMREV_HIDDEN, $summary['hidden']));

//----------------------------

echo $indexAdmin->addNavigation('index.php');
echo $indexAdmin->renderIndex();
amr_filechecks();

include 'admin_footer.php';
//xoops_cp_footer();