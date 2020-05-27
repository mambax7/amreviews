<?php
// $Id: catform.inc.php,v 1.2 2006/04/26 22:27:43 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@the-crescent.net                                         //
//  About:  This file is part of the Articles module for Xoops v2.           //
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

//require dirname(__DIR__) . '/include/setup.php';
include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');

$catform = new XoopsThemeForm($catformcaption, 'categoryform', xoops_getenv('PHP_SELF'), 'post', true);

//XoopsFormSelectGroup
//$groups = ( $xt->id ) ? explode(' ', $xt->groupid ) : true; // line 62
//$catform->addElement( new XoopsFormSelectGroup('thingy', 'groupid', true, $groups, 5, true ) );

//
// Title
//
if (!isset($cat_title)) {
    $cat_title = '';
}
$cat_title = new XoopsFormText(constant($adminLang . '_CATCAPTTL'), 'formdata[cat_title]', 40, 255, $cat_title);
$catform->addElement($cat_title);
unset($cat_title);

//
// Category description
//_AM_FORMCAPTIODESCR
if (!isset($cat_description)) {
    $cat_description = '';
}

// function amreviews_getwysiwygform($caption, $name, $value = "", $width = "100%", $height = '400px', $formrows = "20", $formcols = "50", $config = "")
//$editordesc = amreviews_getwysiwygform($adminLang . '_CATCAPDESC', 'formdata[cat_description]', $cat_description, '100%', '250px', '15');

if (class_exists('XoopsFormEditor')) {
    $options['name']   = 'formdata[cat_description]';
    $options['value']  = $cat_description;
    $options['rows']   = 15;
    $options['cols']   = '100%';
    $options['width']  = '100%';
    $options['height'] = '250px';

    //function XoopsFormEditor($caption, $name, $configs = null, $nohtml = false, $OnFailure = '')
    $editordesc = new XoopsFormEditor(constant($adminLang . '_CATCAPDESC'), $xoopsModuleConfig['amrevieweditadmin'], $options, $nohtml = false, $onfailure = 'textarea');
} else {
    $editordesc = new XoopsFormDhtmlTextArea(constant($adminLang . '_CATCAPDESC'), 'formdata[cat_description]', $cat_description, '100%', '250%', '15');
}

$catform->addElement($editordesc);
unset($editordesc);

//
// Parent category
//
if (!isset($cat_parentid)) {
    $cat_parentid = '0';
}
$catparselect = new XoopsFormSelect(constant($adminLang . '_CATCAPPAR'), 'formdata[cat_id]', $cat_parentid, '1', false);
$catparselect->addOption('0', constant($adminLang . '_CATCAPPARSLT'));

// Based on code from news 1.4
// See news/admin/index.php line 610 on
$xt        = new Xoopsmodules\amreviews\XoopsTree($db, $GLOBALS['xoopsDB']->prefix('amreviews_cat'), 'id', 'cat_parentid');
$cats_arr  = $xt->getChildTreeArray(0, 'cat_title');
$totalcats = count($cats_arr);

//$tmpcpt = $start;
$tmpcpt = 0;

$ok = true;

while ($ok) {
    if ($tmpcpt < $totalcats) {
        if ($cats_arr[$tmpcpt]['cat_parentid'] !== 0) {
            $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '-', $cats_arr[$tmpcpt]['prefix']) . '&nbsp;';
            //echo 'thing1';
        } else {
            $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '', $cats_arr[$tmpcpt]['prefix']);
            //echo 'thing2';
        }
        $cattext = $cats_arr[$tmpcpt]['prefix'];
        //echo
        $catparselect->addOption($cats_arr[$tmpcpt]['id'], $cats_arr[$tmpcpt]['prefix'] . $cats_arr[$tmpcpt]['cat_title']);
    } else {
        $ok = false;
    }
    ++$tmpcpt;
}
$catform->addElement($catparselect);
unset($catparselect);

//
// Category weight/sort order - not used in all display modes.
//
if (!isset($cat_weight)) {
    $cat_weight = '0';
}
$cat_weight = new XoopsFormText(constant($adminLang . '_CATCAPSRT'), 'formdata[cat_weight]', 4, 4, $cat_weight);
$catform->addElement($cat_weight);
unset($cat_weight);

//
// Display this category
//
$cat_showme_checked = '1';
if (isset($cat_showme) && $cat_showme === '0') {
    $cat_showme_checked = '0';
}

$displayedbox = new XoopsFormCheckBox(constant($adminLang . '_CATCAPDSPLY'), 'formdata[cat_showme]', $cat_showme_checked); // checked value here whether will be checked?
$displayedbox->addOption(1, constant($adminLang . '_CATCAPDSPLYTXT')); // checked value here what will be sent in form?
$catform->addElement($displayedbox);
unset($displayedbox);

if ($formaction === 'add') {
    $catform->addElement(new XoopsFormHidden('op', 'save'));
}
if ($formaction === 'edit') {
    $catform->addElement(new XoopsFormHidden('op', 'edit'));
    $catform->addElement(new XoopsFormHidden('subop', 'save'));
    $catform->addElement(new XoopsFormHidden('formdata[id]', $id));
}

//
// Add/submit category button
//
$button_sub = new XoopsFormButton('', 'but_save', $submitbutton, 'submit');

$tray = new XoopsFormElementTray('');
$tray->addElement($button_sub);

$catform->addElement($tray);

// End - Display form
$catform->display();
