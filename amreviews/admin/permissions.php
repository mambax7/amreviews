<?php
// $Id: perms.php,v 1.2 2007/01/24 19:15:59 andrew Exp $
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
include_once dirname(__DIR__) . '/include/config.inc.php';
//include_once (XOOPS_ROOT_PATH . "/class/xoopstree.php");
//include_once(XOOPS_ROOT_PATH . "/class/xoopslists.php");
include_once(XOOPS_ROOT_PATH . "/class/xoopsform/grouppermform.php");

$myts      =& MyTextSanitizer::getInstance();
$module_id = $xoopsModule->getVar('mid');

//----------------------------------------------------------------------------//

if (!isset($_REQUEST['op'])) {
    xoops_cp_header();
    $indexAdmin = new ModuleAdmin();
    echo $indexAdmin->addNavigation('permissions.php');
    /**
     * For my reference, and anyone else's - how to use group perms:
     * http://www.xoops.org/modules/newbb/viewtopic.php?topic_id=12230&viewmode=flat&order=ASC&start=0
     */
    ### /news/admin/groupperms.php
    ### /smartfaq/admin/myblocksadmin.php ?

    $title_of_form = 'Permission form for my module';
    //$perm_name = 'Category Permission';
    $perm_desc = 'Select categories that each group is allowed to view';

    /*
    $item_list = array('1' => 'Category 1', '2' => 'Category 2', '3' => 'Category 3');


    $form = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc,'admin/permissions.php');
    foreach ($item_list as $item_id => $item_name) {
        $form->addItem($item_id, $item_name);
    }
    echo $form->render();
    */
    ##################
    ##################

    //$categories = array();
    // Another example from news thingy, but allows for sub categories
    // See smartsection/permissions.php line 36 - 50
    //$permform = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc,'admin/permissions.php');
    //$xt = new XoopsTopic($GLOBALS['xoopsDB']->prefix("amreview_cat"));
    //$xt = new XoopsTree($GLOBALS['xoopsDB']->prefix("amreview_cat"), "id", "cat_parentid");
    //$categories = $xt->getChildTreeArray(0,"cat_title");
    //$categories = $xt->getTopicsList();

    $permform = new XoopsGroupPermForm(constant($adminLang . '_CATPERMTTL'), $module_id, 'Category Permission', constant($adminLang . '_CATPERMDSC'), 'admin/permissions.php');
    $sql      = ('SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . '');
    $result   = $GLOBALS['xoopsDB']->query($sql);

    //$cats = array();
    $key = 1;
    if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
        while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {

            //$cat = array();
            //$cat['id']                = $myrow['id'];
            //$cat['cat_title']     = $myrow['cat_title'];
            //$cat['cat_parentid']  = $myrow['cat_parentid'];

            $categories1[$key] = array('name' => $myts->displayTarea($myrow['cat_title'], 0, 0, 0, 0, 0), 'parent' => (int)($myrow['cat_parentid']));
            ++$key;
            //array_push($cats, $cat);
        } // while
    } // if

    foreach ($categories1 as $cat_id => $cat_data) {
        $permform->addItem($cat_id, $cat_data['name'], $cat_data['parent']);
    }
    echo $permform->render();
    echo "<br />\n";
    unset($permform);

//Submit permissions.

    include_once __DIR__ . '/admin_footer.php';
}
