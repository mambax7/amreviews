<?php
// $Id: reviewform.inc.php,v 1.5 2007/01/24 19:15:59 andrew Exp $
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
use Xoopsmodules\amreviews;

//include_once dirname(__DIR__) . '/class/psr4/setuploader.php';
include_once(XOOPS_ROOT_PATH . '/class/xoopsformloader.php');

/**
 * Initialise form.
 */
$reviewform = new XoopsThemeForm($formcaption, 'reviewform', xoops_getenv('PHP_SELF'), 'post');

/**
 * Review title
 */
if (!isset($title)) {
    $title = '';
}
$title = new XoopsFormText(constant($adminLang . '_REVCAPTTL'), 'formdata[title]', 40, 255, $title);
$reviewform->addElement($title);
unset($title);

/**
 * Review subtitle
 */
if (!isset($subtitle)) {
    $subtitle = '';
}
$subtitle = new XoopsFormText(constant($adminLang . '_REVCAPSUBTTL'), 'formdata[subtitle]', 40, 255, $subtitle);
$reviewform->addElement($subtitle);
unset($subtitle);

/**
 * Teaser.
 */
if (!isset($teaser)) {
    $teaser = '';
}
//$editor = amreviews_getwysiwygform(constant($adminLang . '_CAPSTEASER'), 'formdata[teaser]', $teaser, '100%', '400px', '8');
//$editor = new XoopsFormTextArea(constant($adminLang . '_CAPSTEASER'), 'formdata[teaser]', $teaser, $rows=5, $cols=50, $id = '');
$teasereditor = new XoopsFormTextArea(constant($adminLang . '_CAPSTEASER'), 'formdata[teaser]', $teaser, $rows = 5, $cols = 50, 0);
$reviewform->addElement($teasereditor);
unset($teasereditor);

/**
 * Item details.
 */
if (!isset($itemDetails)) {
    $itemDetails = $xoopsModuleConfig['itemdetailtpl'];
}
//$editor = amreviews_getwysiwygform(constant($adminLang . '_CAPSTEASER'), 'formdata[teaser]', $teaser, '100%', '400px', '8');
//$editor = new XoopsFormTextArea(constant($adminLang . '_CAPSDETAILS'), 'formdata[item_details]', $itemDetails, $rows=5, $cols=50, $id = '');
$det_editor = new XoopsFormTextArea(constant($adminLang . '_CAPSDETAILS'), 'formdata[item_details]', $itemDetails, $rows = 5, $cols = 50, 0);
$reviewform->addElement($det_editor);
unset($det_editor);

/**
 * Main review text
 */
if (!isset($review)) {
    $review = '';
}
// function amreviews_getwysiwygform($caption, $name, $value = "", $width = "100%", $height = '400px', $formrows = "20", $formcols = "50", $config = "")
//$editor = amreviews_getwysiwygform(constant($adminLang . '_CAPSMAINREVIEW'), 'formdata[review]', $review, '100%', '450px', '20');

if (class_exists('XoopsFormEditor')) {
    $options['name']   = 'formdata[review]';
    $options['value']  = $review;
    $options['rows']   = 20;
    $options['cols']   = '100%';
    $options['width']  = '100%';
    $options['height'] = '450px';

    //function XoopsFormEditor($caption, $name, $configs = null, $nohtml = false, $OnFailure = '')
    $editor = new XoopsFormEditor(constant($adminLang . '_CAPSMAINREVIEW'), $xoopsModuleConfig['amrevieweditadmin'], $options, $nohtml = false, $onfailure = 'textarea');
} else {
    $editor = new XoopsFormDhtmlTextArea(constant($adminLang . '_CAPSMAINREVIEW'), 'formdata[review]', $review, '100%', '450%', '20');
}
$reviewform->addElement($editor);
unset($editor);

/**
 * Keywords
 */
if (!isset($keywords)) {
    $keywords = '';
}
$keywordseditor = new XoopsFormTextArea('', 'formdata[keywords]', $keywords, $rows = 4, $cols = 50, 0);
$keywordlabel   = new XoopsFormLabel('', constant($adminLang . '_CAPSKEYWORDSDSC'));
$keywordtray    = new XoopsFormElementTray(constant($adminLang . '_CAPSKEYWORDS'), '<br />');
$keywordtray->addElement($keywordseditor);
$keywordtray->addElement($keywordlabel);
$reviewform->addElement($keywordtray);
unset($keywordseditor);

#$datetray = new XoopsFormElementTray(constant($adminLang . '_CAPSDDATE'),'<br />');
#$datetray->addElement($publishdate);
#$reviewform->addElement($datetray);
#unset($publishdate);

/**
 * Category
 */
if (!isset($catid)) {
    $catid = '0';
}
$catparselect = new XoopsFormSelect(constant($adminLang . '_CATCAP'), 'formdata[catid]', $catid, '1', false);
$catparselect->addOption('0', constant($adminLang . '_CATCAPSLT'));
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
$reviewform->addElement($catparselect);
unset($catparselect);

/**
 * Author
 */
if (!isset($uid)) {
    $uid = $xoopsUser->getVar('uid');
}
$member_handler = &xoops_gethandler('member');
$usercount      = $member_handler->getUserCount();
if ($usercount < 300) {
    $reviewform->addElement(new XoopsFormSelectUser(constant($adminLang . '_CAPSAUTHOR'), 'formdata[uid]', true, $uid), false);
} else {
    $reviewform->addElement(new XoopsFormText(constant($adminLang . '_CAPSAUTHOR'), 'formdata[uid]', 10, 10, $uid), false);
}

/**
 * Rating
 */
if (!isset($our_rating)) {
    $our_rating = '3';
}
$ratingselect = new XoopsFormSelect(constant($adminLang . '_CAPRATE'), 'formdata[our_rating]', $our_rating, '1', false);
$ratingselect->addOption('0', constant($adminLang . '_CAPRATESLT'));
$ratingselect->addOption('1', constant($adminLang . '_CAPRATE1'));
$ratingselect->addOption('2', constant($adminLang . '_CAPRATE2'));
$ratingselect->addOption('3', constant($adminLang . '_CAPRATE3'));
$ratingselect->addOption('4', constant($adminLang . '_CAPRATE4'));
$ratingselect->addOption('5', constant($adminLang . '_CAPRATE5'));
$reviewform->addElement($ratingselect);
unset($ratingselect);

/**
 * Image
 */
//$imageFile = '';
//if (isset($imageFile)) {
//    $imageFile = $imageFile;
//}

$imageFile = isset($imageFile) ? $imageFile : '';

$image_array  =& XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . '/thumb/');
$image_select = new XoopsFormSelect('', 'formdata[image_file]', $imageFile);
$image_select->addOption('-1', '---------------');
$image_select->addOptionArray($image_array);
$image_select->setExtra("onchange='showImgSelected(\"photo\", \"formdata[image_file]\", \"uploads/amreviews/photos/thumb\", \"\", \"" . XOOPS_URL . "\")'");
$image_label = new XoopsFormLabel('', "<img src=" . XOOPS_URL . "/uploads/avatars/blank.gif name='photo' id='photo' alt='' />");

$image_tray = new XoopsFormElementTray(constant($adminLang . '_SELECTIMGCAP'), '<br /><br />');
$image_tray->addElement($image_select);
$image_tray->addElement($image_label);
$reviewform->addElement($image_tray);

/**
 * Review weight (weight)
 */
if (!isset($weight)) {
    $weight = '0';
}
$weight = new XoopsFormText(constant($adminLang . '_CATCAPSRT'), 'formdata[weight]', 4, 4, $weight);
$reviewform->addElement($weight);
unset($weight);

/**
 * Published date/time (this is the date that shows when it was published
 */
$pubdate = '';
if (isset($date)) {
    $pubdate = strtotime($date);
}
$publishdate = new XoopsFormDateTime('', 'formdata[date]', 15, $pubdate);//constant($adminLang . '_CAPSDDATE)
//$reviewform->addElement($publishdate);
$datetray = new XoopsFormElementTray(constant($adminLang . '_CAPSDDATE'), '<br />');
$datetray->addElement($publishdate);
$reviewform->addElement($datetray);
unset($publishdate);

/**
 * Start date/time (this is the date that shows when it was published
 */
$pubstartdate = '';
if (isset($date_publish)) {
    $pubstartdate = $date_publish;
}
$startdate = new XoopsFormDateTime('', 'formdata[date_publish]', 15, $pubstartdate);//constant($adminLang . '_CAPSDDATE)
// Set start
$startdate_checked = 0;
if (isset($date_publish) && $date_publish !== 0) {
    $startdate_checked = 1;
}
$startdatetick = new XoopsFormCheckBox('', 'formdata[setstartdate]', $startdate_checked); // checked value here whether will be checked?
$startdatetick->addOption(1, constant($adminLang . '_CAPSSTARTDTBX')); // checked value here what will be sent in form?
// Clear yes/no
//$startdateYN = new XoopsFormRadioYN(constant($adminLang . '_CAPSSTARTDTYN'), 'formdata[removestartdate]', $value=0, $yes=_YES, $no=_NO, $id='');
// tray
$pubdatetray = new XoopsFormElementTray(constant($adminLang . '_CAPSSTARTDATE'), '<br />');
$pubdatetray->addElement($startdatetick);
$pubdatetray->addElement($startdate);
//$pubdatetray->addElement($startdateYN);
$reviewform->addElement($pubdatetray);
unset($startdate, $pubdatetray);

/**
 * End date/time (this is the date that shows when it was published
 */
$pubenddate = '';
if (isset($date_end)) {
    $pubenddate = $date_end;
}
$enddate = new XoopsFormDateTime('', 'formdata[date_end]', 15, $pubenddate);//constant($adminLang . '_CAPSDDATE)
// Set end
$enddate_checked = 0;
if (isset($date_end) && $date_end !== 0) {
    $enddate_checked = 1;
}
$enddatetick = new XoopsFormCheckBox('', 'formdata[setendtdate]', $enddate_checked); // checked value here whether will be checked?
$enddatetick->addOption(1, constant($adminLang . '_CAPSENDDTBX')); // checked value here what will be sent in form?
// Clear - yes/no
//$enddateYN = new XoopsFormRadioYN(constant($adminLang . '_CAPSENDDTYN'), 'formdata[removeenddate]', $value=0, $yes=_YES, $no=_NO, $id='');
//tray
$pubdatetray = new XoopsFormElementTray(constant($adminLang . '_CAPSENDDATE'), '<br />');
$pubdatetray->addElement($enddatetick);
$pubdatetray->addElement($enddate);
//$pubdatetray->addElement($enddateYN);
$reviewform->addElement($pubdatetray);
unset($enddate, $pubdatetray);

/**
 * Page title options
 * $xoopsModuleConfig['']
 */
if (!isset($pagetitle)) {
    $pagetitle = $xoopsModuleConfig['pagettldefault'];
}
$pagettlselect = new XoopsFormSelect(constant($adminLang . '_PAGETTL'), 'formdata[pagetitle]', $pagetitle, '1', false);
$pagettlselect->addOption('0', constant($adminLang . '_PAGETTL_OPT_0'));
$pagettlselect->addOption('1', constant($adminLang . '_PAGETTL_OPT_1'));
$pagettlselect->addOption('2', constant($adminLang . '_PAGETTL_OPT_2'));
$reviewform->addElement($pagettlselect);
unset($pagettlselect);

/**
 * Meta header options
 */
if (!isset($metaheaders)) {
    $metaheaders = $xoopsModuleConfig['pagemetadefault'];
}
$metaselect = new XoopsFormSelect(constant($adminLang . '_KEYWORD'), 'formdata[metaheaders]', $metaheaders, '1', false);
$metaselect->addOption('0', constant($adminLang . '_KEYWORD_OPT_0'));
$metaselect->addOption('1', constant($adminLang . '_KEYWORD_OPT_1'));
//$metaselect->addOption('2', constant($adminLang . '_KEYWORD_OPT_2'));
$reviewform->addElement($metaselect);
unset($metaselect);

/**
 * Allow comments for this item - y/n
 */
$comment_checked = '1';
if (isset($comments) && $comments === '0') {
    $comment_checked = '0';
}
$commentsbox = new XoopsFormCheckBox(constant($adminLang . '_CAPCOMMENTS'), 'formdata[comments]', $comment_checked); // checked value here whether will be checked?
$commentsbox->addOption(1, constant($adminLang . '_CAPCOMMENTSTXT')); // checked value here what will be sent in form?
$reviewform->addElement($commentsbox);
unset($commentsbox);

/**
 * Display this review
 */
$showme_checked = '1';
if (isset($showme) && $showme === 0) {
    $showme_checked = '0';
}

$displayedbox = new XoopsFormCheckBox(constant($adminLang . '_CAPDSPLYREV'), 'formdata[showme]', $showme_checked); // checked value here whether will be checked?
$displayedbox->addOption(1, constant($adminLang . '_CAPDSPLYREVTXT')); // checked value here what will be sent in form?
$reviewform->addElement($displayedbox);
unset($displayedbox);

/**
 * show/disable html
 */
$nohtml_checked = '1';
if (isset($nohtml) && $nohtml === '0') {
    $nohtml_checked = '0';
}
$nohtmlbox = new XoopsFormCheckBox('', 'formdata[nohtml]', $nohtml_checked); // checked value here whether will be checked?
$nohtmlbox->addOption(1, constant($adminLang . '_FRMCAPNOHTML')); // checked value here what will be sent in form?

/**
 * show/disable auto line breaks
 */
$nobr_checked = '1';
if (isset($nobr) && $nobr === '0') {
    $nobr_checked = '0';
}
$nobrbox = new XoopsFormCheckBox('', 'formdata[nobr]', $nobr_checked); // checked value here whether will be checked?
$nobrbox->addOption(1, constant($adminLang . '_FRMCAPNOBR')); // checked value here what will be sent in form?

/**
 * show/disable smileys
 */
$nosmiley_checked = '1';
if (isset($nosmiley) && $nosmiley === '0') {
    $nosmiley_checked = '0';
}
$smileybox = new XoopsFormCheckBox('', 'formdata[nosmiley]', $nosmiley_checked); // checked value here whether will be checked?
$smileybox->addOption(1, constant($adminLang . '_FRMCAPNOSMLY')); // checked value here what will be sent in form?

/**
 * show/disable xoops codes
 */
$noxcode_checked = '1';
if (isset($noxcode) && $noxcode === '0') {
    $noxcode_checked = '0';
}
$xcodebox = new XoopsFormCheckBox('', 'formdata[noxcode]', $noxcode_checked); // checked value here whether will be checked?
$xcodebox->addOption(1, constant($adminLang . '_FRMCAPNOXCDE')); // checked value here what will be sent in form?

/**
 * show/disable xoops images
 */
$noimage_checked = '1';
if (isset($noimage) && $noimage === '0') {
    $noimage_checked = '0';
}
$imgcodebox = new XoopsFormCheckBox('', 'formdata[noimage]', $noimage_checked); // checked value here whether will be checked?
$imgcodebox->addOption(1, constant($adminLang . '_FRMCAPNOXIMG')); // checked value here what will be sent in form?

$optionstray = new XoopsFormElementTray('', '<br />');
$optionstray->addElement($nohtmlbox);
$optionstray->addElement($nobrbox);
$optionstray->addElement($smileybox);
$optionstray->addElement($xcodebox);
$optionstray->addElement($imgcodebox);
$reviewform->addElement($optionstray);
unset($nohtmlbox, $smileybox, $xcodebox, $imgcodebox, $nobrbox);

/**
 * Hidden fields
 */
if ($formaction === 'add') {
    $reviewform->addElement(new XoopsFormHidden('op', 'save'));
}
if ($formaction === 'edit') {
    $reviewform->addElement(new XoopsFormHidden('op', 'edit'));
    $reviewform->addElement(new XoopsFormHidden('subop', 'save'));
    $reviewform->addElement(new XoopsFormHidden('formdata[id]', $rev_id));
    $reviewform->addElement(new XoopsFormHidden('formdata[views]', $views));
}

/**
 * reviewer's IP
 */
if (isset($reviewer_ip)) {
    $reviewform->addElement(new XoopsFormHidden('formdata[reviewer_ip]', $reviewer_ip));
} else {
    $reviewform->addElement(new XoopsFormHidden('formdata[reviewer_ip]', $_SERVER['REMOTE_ADDR']));
}

/**
 * Add/submit category button
 */
$button_sub  = new XoopsFormButton('', 'but_save', $submitbutton, 'submit');
$button_tray = new XoopsFormElementTray('');
$button_tray->addElement($button_sub);
$reviewform->addElement($button_tray);

/**
 * End - Display form
 */
$reviewform->display();
