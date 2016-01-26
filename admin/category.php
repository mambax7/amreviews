<?php
// $Id: category.php,v 1.4 2007/01/24 19:15:59 andrew Exp $
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

//use Xoopsmodules\amreviews;
// includes
require dirname(__DIR__) . '/include/setup.php';
include_once __DIR__ . '/admin_header.php';
//include_once __DIR__ . '/functions.inc.php';
include_once dirname(__DIR__) . '/include/config.inc.php';
//include_once(XOOPS_ROOT_PATH . '/class/xoopstree.php');

$myts =& MyTextSanitizer::getInstance();

include_once dirname(__DIR__) . '/class/helper.php';
$helper      = &Xoopsmodules\amreviews\Helper::getInstance();
$mainLang    = '_MD_' . strtoupper($helper->moduleDirName);
$modinfoLang = '_MI_' . strtoupper($helper->moduleDirName);
$adminLang   = '_AM_' . strtoupper($helper->moduleDirName);

//----------------------------------------------------------------------------//

//if (!isset($_REQUEST['op'])) {
if ('' === XoopsRequest::getCmd('op', XoopsRequest::getCmd('op', '', 'POST'), 'GET')) {
    xoops_cp_header();
    $indexAdmin = new ModuleAdmin();
    echo $indexAdmin->addNavigation('category.php');

    /**
     * List categories
     *
     */
    $class = '';
    echo "<table border=\"0\" width=\"100%\" cellspacing=\"1\" class=\"outer\">";

    echo "<th colspan=\"5\">" . constant($adminLang . '_CATTBLCAP') . '</th></td>';
    echo "<tr><td class=\"head\" style=\"text-align: center;\">" . constant($adminLang . '_REVCAPID') . '</td>';
    echo "<td class=\"head\" style=\"text-align: center;\">" . constant($adminLang . '_REVCAPTTL') . '</td>';
    echo "<td class=\"head\" style=\"text-align: center;\">" . constant($adminLang . '_REVCAP_VISIBLE') . '</td>';
    echo "<td class=\"head\" style=\"text-align: center;\">" . constant($adminLang . '_REVCAP_ACTIONS') . '</td>';
    echo '</tr>';

    ##
    ##

    //$start = isset($_GET['start']) ? (int)($_GET['start']) : 0;
    $start = 0;

    // Based on code from news 1.4
    // See news/admin/index.php line 610 on

    $xt        = new Xoopsmodules\amreviews\XoopsTree($db, $db->prefix('amreviews_cat'), 'id', 'cat_parentid');
    $cats_arr  = $xt->getChildTreeArray(0, 'cat_title');
    $totalcats = count($cats_arr);
    $rowclass  = '';

    //echo "<pre>";
    //var_dump($xt);
    //var_dump($cats_arr);
    //echo "</pre>";

    $tmpcpt = $start;

    $ok = true;

    while ($ok) {
        if ($tmpcpt < $totalcats) {
            $rowclass = ($rowclass === 'odd') ? 'even' : 'odd';

            echo '<tr>';
            echo "<td style=\"text-align: center; width: 20px;\" class=\"" . $rowclass . "\">" . $cats_arr[$tmpcpt]['id'] . '</td>';

            if ($cats_arr[$tmpcpt]['cat_parentid'] !== 0) {
                $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '-', $cats_arr[$tmpcpt]['prefix']) . '&nbsp;';
                //echo "thing1";
            } else {
                $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '', $cats_arr[$tmpcpt]['prefix']);
                //echo "thing2";
            }

            echo "<td class=\"" . $rowclass . "\">" . $cats_arr[$tmpcpt]['prefix'] . $cats_arr[$tmpcpt]['cat_title'] . '</td>';

            if ($cats_arr[$tmpcpt]['cat_showme'] === 1) {
                $bulb   = '1.png';
                $alttxt = constant($adminLang . '_STATUSSHOW');
            } else {
                $bulb   = '0.png';
                $alttxt = constant($adminLang . '_STATUSHIDE');
            }

            echo "<td style=\"text-align: center; width: 20px;\" class=\"" . $rowclass . "\"><img src=" . $pathIcon16 . '/' . $bulb . " title=\"" . $alttxt . "\" alt=\"" . $alttxt . "\"></td>";
            echo "<td style=\"text-align: center; width: 20px;\" class=\"" . $rowclass . "\"><a href=\"" . XoopsRequest::getString('PHP_SELF', '', 'SERVER') . "?op=edit&amp;id=" . $cats_arr[$tmpcpt]['id'] . "\"><img src=" . $pathIcon16 . "/edit.png title=\"Click to edit\" /></a>" . "<a href=\"" . XoopsRequest::getString('PHP_SELF', '', 'SERVER') . "?op=del&amp;id=" . $cats_arr[$tmpcpt]['id'] . "\"><img src=" . $pathIcon16 . "/delete.png title=\"Click to delete\" /></a></td>";
            echo '</tr>';

            //$rowclass = ($rowclass == 'even') ? 'odd' : 'even';
        } else {
            $ok = false;
        }
        //echo $tmpcpt ."<br />";
        ++$tmpcpt;
    } // while

    echo '</table><br /><br />';

    /**
     * Load category form to add new.
     */
    $catformcaption = constant($adminLang . '_CATCAPTION');
    $submitbutton   = constant($adminLang . '_CATCAPSAVE');
    $formaction     = 'add';

    include_once 'catform.inc.php';

    //    echo $indexAdmin->addNavigation('category.php');
    include_once __DIR__ . '/admin_footer.php';
} // end if

//----------------------------------------------------------------------------//

/**
 * Save new category data.
 */
//if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'save') {
if ('save' === XoopsRequest::getCmd('op', XoopsRequest::getCmd('op', '', 'POST'), 'GET')) {
    xoops_cp_header();

    //    if (isset($_POST['formdata'])) {
    //        $formdata = $_POST['formdata'];
    //    } else {
    //        $formdata = '';
    //    }
    $formdata = XoopsRequest::getArray('formdata', '', 'POST');

    //echo "<pre>";
    //print_r($formdata);
    //echo "</pre>";

    $cat_title       = $myts->addSlashes($formdata['cat_title']);
    $cat_description = $myts->addSlashes($formdata['cat_description']);
    $cat_parentid    = (int)($formdata['cat_id']);
    $cat_weight      = (int)($formdata['cat_weight']);
    $cat_showme      = (int)($formdata['cat_showme']);

    $sql = 'INSERT INTO ' . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . " VALUES (
            NULL,
            '$cat_parentid',
            '$cat_title',
            '$cat_description',
            '$cat_weight',
            '$cat_showme' )";

    $GLOBALS['xoopsDB']->query($sql); // or $eh->show("0013");
    if ($GLOBALS['xoopsDB']->getAffectedRows($sql)) {
        redirect_header('category.php', 2, constant($adminLang . '_DBUPDATED'));
        //echo "entered";
    } else {
        redirect_header('category.php', 2, constant($adminLang . '_DBNOUPDATED'));
        //echo "not entered";
    }

    xoops_cp_footer();
} // end if

//----------------------------------------------------------------------------//

/**
 * Save new category data.
 */
//if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'edit') {
if ('edit' === XoopsRequest::getCmd('op', XoopsRequest::getCmd('op', '', 'POST'), 'GET')) {
    //xoops_cp_header();

    /**
     * Load form if subop not set.
     */
    if ('' === (XoopsRequest::getCmd('subop', XoopsRequest::getCmd('subop', '', 'POST'), 'GET'))) {
        xoops_cp_header();
        $indexAdmin = new ModuleAdmin();
        echo $indexAdmin->addNavigation('category.php');

        //        if (isset($_GET['id'])) {
        //            $id = $_GET['id'];
        //        } else {
        //            $id = "";
        //        }
        $id = XoopsRequest::getInt('id', 0, 'GET');

        $result = $GLOBALS['xoopsDB']->query("SELECT id, cat_parentid, cat_title, cat_description, cat_weight, cat_showme  FROM " . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . " WHERE id=$id LIMIT 1");
        list($id, $cat_parentid, $cat_title, $cat_description, $cat_weight, $cat_showme) = $GLOBALS['xoopsDB']->fetchRow($result);

        $cat_title       = $myts->htmlSpecialChars($cat_title);
        $cat_description = $myts->htmlSpecialChars($cat_description);
        //$cat_weight

        // form stuff (edit)
        $catformcaption = constant($adminLang . '_CATCAPTIONED');
        $submitbutton   = constant($adminLang . '_CATCAPSAVEED');
        $formaction     = 'edit';

        include_once 'catform.inc.php';
        xoops_cp_footer();
    } // end if

    /**
     * Save update if subop set.
     */
    //    if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == 'save') {
    if ('save' === XoopsRequest::getCmd('subop', XoopsRequest::getCmd('subop', '', 'POST'), 'GET')) {
        xoops_cp_header();

        //        if (isset($_POST['formdata'])) {
        //            $formdata = $_POST['formdata'];
        //        } else {
        //            $formdata = "";
        //        }
        $formdata = XoopsRequest::getArray('formdata', '', 'POST');
        //echo "<pre>";
        //print_r($formdata);
        //echo "</pre>";

        $id              = (int)($formdata['id']);
        $cat_parentid    = (int)($formdata['cat_id']);
        $cat_title       = $myts->addSlashes($formdata['cat_title']);
        $cat_description = $myts->addSlashes($formdata['cat_description']);
        $cat_weight      = (int)($formdata['cat_weight']);
        $cat_showme      = (int)($formdata['cat_showme']);

        $sql = ('UPDATE ' . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . " SET
                id = '$id',
                cat_parentid    = '$cat_parentid',
                cat_title       = '$cat_title',
                cat_description = '$cat_description',
                cat_weight      = '$cat_weight',
                cat_showme      = '$cat_showme'
                WHERE id=$id");

        $result = $GLOBALS['xoopsDB']->query($sql);

        if ($GLOBALS['xoopsDB']->query($sql)) {
            redirect_header('category.php', 2, constant($adminLang . '_DBUPDATED'));
            //echo 'entered';
        } else {
            redirect_header('category.php', 2, constant($adminLang . '_DBNOUPDATED'));
            //echo "not entered";
        }

        xoops_cp_footer();
    } // end if

    //xoops_cp_footer();
} // end if

//----------------------------------------------------------------------------//

/**
 * Delete category.
 */
//if (isset($_REQUEST['op']) && $_REQUEST['op'] == 'del') {
if ('del' === XoopsRequest::getCmd('op', XoopsRequest::getCmd('op', '', 'POST'), 'GET')) {
    //xoops_cp_header();

    //    if (isset($_REQUEST['id'])) {
    //        $id = (int)($_REQUEST['id']);
    //    } else {
    //        $id = "";
    //    }
    $id = XoopsRequest::getInt('id', XoopsRequest::getInt('id', 0, 'POST'), 'GET');
    /**
     * Confirm deletion.
     */
    //    if (!isset($_REQUEST['subop'])) {
    if ('' !== (XoopsRequest::getCmd('subop', XoopsRequest::getCmd('subop', '', 'POST'), 'GET'))) {
        xoops_cp_header();
        xoops_confirm(array('op' => 'del', 'id' => $id, 'subop' => 'delok'), 'category.php', constant($adminLang . '_DBCONFMDEL'));
        xoops_cp_footer();
    } // end if

    /**
     * Delete
     */
    //    if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == 'delok') {
    if ('delok' === XoopsRequest::getCmd('subop', XoopsRequest::getCmd('subop', '', 'POST'), 'GET')) {
        $sql = sprintf("DELETE FROM %s WHERE id = %u", $GLOBALS['xoopsDB']->prefix('amreviews_cat'), $id);

        if ($GLOBALS['xoopsDB']->queryF($sql)) {
            // Delete permissions.
            xoops_groupperm_deletebymoditem($xoopsModule->getVar('mid'), 'Category Permission', $id);
            redirect_header('category.php', 2, constant($adminLang . '_DBDELETED'));
            //echo 'deleted';
        } else {
            redirect_header('category.php', 2, constant($adminLang . '_DBNOTDELETED'));
            //echo "not deleted";
        } //
    } //
} // end if
