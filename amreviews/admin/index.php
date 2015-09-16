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
 * @copyright    XOOPS Project (http://xoops.org)
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 * @version      $Id $
 */
// a setup file that creates a $db variable
//require dirname(__DIR__) . '/include/setup.php';
include_once __DIR__ . '/admin_header.php';
include_once dirname(__DIR__) . '/include/config.inc.php';
//include_once dirname(__DIR__) . '/include/config.php';
//include_once dirname(__DIR__) . '/class/utilities.php';
xoops_cp_header();

$indexAdmin = new ModuleAdmin();
$indexAdmin->addConfigBoxLine('  ', '');

// check on folders, and create new if needed
foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
    Xoopsmodules\amreviews\Utilities::prepareFolder($uploadFolders[$i]);
    $indexAdmin->addConfigBoxLine($uploadFolders[$i], 'folder');
    //    $indexAdmin->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}

//$moduleStatsArray = Summary::getModuleStats();

//-----------------------
$utilities   = new Xoopsmodules\amreviews\Utilities($db);
$moduleStats = $utilities->getModuleStats();
$indexAdmin->addInfoBox(constant($adminLang . '_SUMMARY'));

$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_WAITVALCAP') . '</b>  ' . sprintf(constant($adminLang . '_WAITVAL'), $moduleStats['waitval']), 'Green');
$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_REVIEWTOTCAP') . '</b>  ' . sprintf(constant($adminLang . '_REVIEWTOT'), $moduleStats['revcount']), 'Red');
$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_CATETOTCAP') . '</b>  ' . sprintf(constant($adminLang . '_CATETOT'), $moduleStats['catcount']), 'Red');
$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_VIEWSCAP') . '</b>  ' . sprintf(constant($adminLang . '_VIEWS'), $moduleStats['views']), 'Green');
$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_PUBLISHEDCAP') . '</b>  ' . sprintf(constant($adminLang . '_PUBLISHED'), $moduleStats['published']), 'Red');
$indexAdmin->addInfoBoxLine(constant($adminLang . '_SUMMARY'), '<b>' . constant($adminLang . '_HIDDENCAP') . '</b>  ' . sprintf(constant($adminLang . '_HIDDEN'), $moduleStats['hidden']));
//----------------------------

echo $indexAdmin->addNavigation('index.php');
echo $indexAdmin->renderIndex();

$utilities->getServerStats();

include_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();

