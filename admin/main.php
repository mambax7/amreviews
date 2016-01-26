<?php
// $Id: main.php,v 1.3 2007/01/24 19:15:59 andrew Exp $
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

include_once __DIR__ . '/admin_header.php';
//include_once __DIR__ . '/functions.inc.php';
include_once dirname(__DIR__) . '/include/config.inc.php';

xoops_cp_header();

/**
 * Summary
 */
$summary   = $utilities->summary();
/*
echo "<fieldset>";
echo "<legend style=\"color: #990000; font-weight: bold;\">" . $adminLang . '_SUMMARY . "</legend>";

echo "<ul>";
echo "<li>" . $adminLang . '_WAITVAL' . $summary['waitval'] . "</li>";
echo "<li>" . $adminLang . '_REVIEWTOT' . $summary['revcount'] . "</li>";
echo "<li>" . $adminLang . '_CATETOT' . $summary['catcount'] . "</li>";
echo "</ul>";
echo "</fieldset><br />";
*/

echo '<table width=\'100%\' cellspacing=\'1\' class=\'outer\'>';
echo '<tr><th colspan=\"2\">' . $adminLang . '_SUMMARY' . '</th></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_WAITVALCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_WAITVAL', $summary['waitval']) . '</td></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_REVIEWTOTCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_REVIEWTOT', $summary['revcount']) . '</td></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_CATETOTCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_CATETOT', $summary['catcount']) . '</td></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_VIEWSCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_VIEWS', $summary['views']) . '</td></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_PUBLISHEDCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_PUBLISHED', $summary['published']) . '</td></tr>';
echo '<tr><td class=\"head\">' . $adminLang . '_HIDDENCAP' . '</td><td class=\'odd\'>' . sprintf($adminLang . '_HIDDEN', $summary['hidden']) . '</td></tr>';
echo '</table><br />';

/**
 * Do some tests
 */
$utilities->getServerStats();
include_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
