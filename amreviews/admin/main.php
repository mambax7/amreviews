<?php
// $Id: main.php,v 1.3 2007/01/24 19:15:59 andrew Exp $
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

// includes
include ('../../../include/cp_header.php');
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include ("../language/".$xoopsConfig['language']."/main.php");
} else {
	include ("../language/english/main.php");
}
include_once("functions.inc.php");
include_once("../include/config.inc.php");

xoops_cp_header();

/**
* Summary
*/
$summary = amr_summary();
/*
echo "<fieldset>";
echo "<legend style=\"color: #990000; font-weight: bold;\">" . _AM_AMREV_SUMMARY . "</legend>";

echo "<ul>";
echo "<li>" . _AM_AMREV_WAITVAL . $summary['waitval'] . "</li>";
echo "<li>" . _AM_AMREV_REVIEWTOT . $summary['revcount'] . "</li>";
echo "<li>" . _AM_AMREV_CATETOT . $summary['catcount'] . "</li>";
echo "</ul>";
echo "</fieldset><br />";
*/

echo "<table width=\"100%\" cellspacing=\"1\" class=\"outer\">";
echo "<tr><th colspan=\"2\">" . _AM_AMREV_SUMMARY . "</th></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_WAITVALCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_WAITVAL, $summary['waitval']) . "</td></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_REVIEWTOTCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_REVIEWTOT, $summary['revcount']) . "</td></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_CATETOTCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_CATETOT, $summary['catcount']) . "</td></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_VIEWSCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_VIEWS, $summary['views']) . "</td></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_PUBLISHEDCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_PUBLISHED, $summary['published']) . "</td></tr>";
echo "<tr><td class=\"head\">". _AM_AMREV_HIDDENCAP ."</td><td class=\"odd\">" . sprintf(_AM_AMREV_HIDDEN, $summary['hidden']) . "</td></tr>";
echo "</table><br />";






/**
* Do some tests
*/
amr_filechecks();



amrev_adminfooter();
xoops_cp_footer();

?>