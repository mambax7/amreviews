<?php
// $Id: reviewform.inc.php,v 1.5 2007/01/24 19:15:59 andrew Exp $
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
include_once (XOOPS_ROOT_PATH . "/class/xoopsformloader.php");


/**
* Initialise form.
*/
$reviewform = new XoopsThemeForm($formcaption, "reviewform", xoops_getenv('PHP_SELF'), 'post');

/**
* Review title
*/
if (!isset($title)) { $title = ""; }
$title = new XoopsFormText(_AM_AMREV_REVCAPTTL, 'formdata[title]', 40, 255, $title);
$reviewform->addElement($title);
unset($title);

/**
* Review subtitle
*/
if (!isset($subtitle)) { $subtitle = ""; }
$subtitle = new XoopsFormText(_AM_AMREV_REVCAPSUBTTL, 'formdata[subtitle]', 40, 255, $subtitle);
$reviewform->addElement($subtitle);
unset($subtitle);

/**
* Teaser.
*/
if (!isset($teaser)) { $teaser = ""; }
//$editor = amreviews_getwysiwygform(_AM_AMREV_CAPSTEASER, 'formdata[teaser]', $teaser, "100%", "400px", '8');
//$editor = new XoopsFormTextArea(_AM_AMREV_CAPSTEASER, 'formdata[teaser]', $teaser, $rows=5, $cols=50, $id = "");
$teasereditor = new XoopsFormTextArea(_AM_AMREV_CAPSTEASER, 'formdata[teaser]', $teaser, $rows=5, $cols=50, 0);
$reviewform->addElement($teasereditor);
unset($teasereditor);

/**
* Item details.
*/
if (!isset($item_details)) { $item_details = $xoopsModuleConfig['itemdetailtpl']; }
//$editor = amreviews_getwysiwygform(_AM_AMREV_CAPSTEASER, 'formdata[teaser]', $teaser, "100%", "400px", '8');
//$editor = new XoopsFormTextArea(_AM_AMREV_CAPSDETAILS, 'formdata[item_details]', $item_details, $rows=5, $cols=50, $id = "");
$det_editor = new XoopsFormTextArea(_AM_AMREV_CAPSDETAILS, 'formdata[item_details]', $item_details, $rows=5, $cols=50, 0);
$reviewform->addElement($det_editor);
unset($det_editor);

/**
* Main review text
*/
if (!isset($review)) { $review = ""; }
$editor = amreviews_getwysiwygform(_AM_AMREV_CAPSMAINREVIEW, 'formdata[review]', $review, "100%", "450px", '20');
//$editor = new XoopsFormTextArea(_AM_AMREV_CAPSTEASER, 'formdata[review]', $review, $rows=5, $cols=50, $id = "");
$reviewform->addElement($editor);
unset($editor);

/**
* Keywords
*/
if (!isset($keywords)) { $keywords = ""; }
$keywordseditor = new XoopsFormTextArea('', 'formdata[keywords]', $keywords, $rows=4, $cols=50, 0);
$keywordlabel = new XoopsFormLabel('', _AM_AMREV_CAPSKEYWORDSDSC);
$keywordtray = new XoopsFormElementTray(_AM_AMREV_CAPSKEYWORDS,'<br />');
$keywordtray->addElement($keywordseditor);
$keywordtray->addElement($keywordlabel);
$reviewform->addElement($keywordtray);
unset($keywordseditor);

#$datetray = new XoopsFormElementTray(_AM_AMREV_CAPSDDATE,'<br />');
#$datetray->addElement($publishdate);
#$reviewform->addElement($datetray);
#unset($publishdate);


/**
* Category
*/
if (!isset($catid)) { $catid = "0"; }
$catparselect = new XoopsFormSelect(_AM_AMREV_CATCAP, 'formdata[catid]', $catid, '1', false);
$catparselect->addOption('0', _AM_AMREV_CATCAPSLT);

	// Based on code from news 1.4
	// See news/admin/index.php line 610 on
	$xt = new XoopsTree($xoopsDB->prefix("amreview_cat"), "id", "cat_parentid");
	$cats_arr = $xt->getChildTreeArray(0,"cat_title");
	$totalcats = count($cats_arr);

	//$tmpcpt = $start;
	$tmpcpt = 0;
	
	$ok = true;
	
		while($ok) {
			if($tmpcpt < $totalcats) {
				if($cats_arr[$tmpcpt]['cat_parentid']!=0) {
					$cats_arr[$tmpcpt]['prefix'] = str_replace(".","-",$cats_arr[$tmpcpt]['prefix']) . '&nbsp;';
					//echo "thing1";
				} else {
					$cats_arr[$tmpcpt]['prefix'] = str_replace(".","",$cats_arr[$tmpcpt]['prefix']);
					//echo "thing2";
				}
				$cattext = $cats_arr[$tmpcpt]['prefix'];
				//echo
				$catparselect->addOption($cats_arr[$tmpcpt]['id'], $cats_arr[$tmpcpt]['prefix'] . $cats_arr[$tmpcpt]['cat_title']);
			} else {
				$ok = false;
			}
			$tmpcpt++;
		}
$reviewform->addElement($catparselect);				
unset($catparselect);

/**
* Author
*/
if(!isset($uid)) {
	$uid = $xoopsUser->getVar('uid');
}
$member_handler = &xoops_gethandler('member');
$usercount = $member_handler->getUserCount();
if ($usercount < 300) {
	$reviewform->addElement(new XoopsFormSelectUser(_AM_AMREV_CAPSAUTHOR, 'formdata[uid]', true, $uid), false);
} else {
	$reviewform->addElement(new XoopsFormText(_AM_AMREV_CAPSAUTHOR, 'formdata[uid]', 10, 10, $uid), false);
}


/**
* Rating
*/
if (!isset($our_rating)) { $our_rating = "3"; }
$ratingselect = new XoopsFormSelect(_AM_AMREV_CAPRATE, 'formdata[our_rating]', $our_rating, '1', false);
$ratingselect->addOption('0', _AM_AMREV_CAPRATESLT);
$ratingselect->addOption('1', _AM_AMREV_CAPRATE1);
$ratingselect->addOption('2', _AM_AMREV_CAPRATE2);
$ratingselect->addOption('3', _AM_AMREV_CAPRATE3);
$ratingselect->addOption('4', _AM_AMREV_CAPRATE4);
$ratingselect->addOption('5', _AM_AMREV_CAPRATE5);
$reviewform->addElement($ratingselect);				
unset($ratingselect);

/**
* Image
*/
if (isset($image_file)) { $image_file = $image_file;  }
	else { $image_file = ""; }
$image_array =& XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/thumb/");
$image_select = new XoopsFormSelect('', 'formdata[image_file]', $image_file);
$image_select->addOption ('-1', '---------------');
$image_select->addOptionArray($image_array);
$image_select->setExtra("onchange='showImgSelected(\"photo\", \"formdata[image_file]\", \"modules/amreviews/photos/thumb/\", \"\", \"".XOOPS_URL."\")'");
$image_label = new XoopsFormLabel("", "<img src='images/avatar/blank.gif' name='photo' id='photo' alt='' />");

$image_tray = new XoopsFormElementTray(_AM_AMREV_SELECTIMGCAP, "<br /><br />");
$image_tray->addElement($image_select);
$image_tray->addElement($image_label);
$reviewform -> addElement($image_tray);


/**
* Review weight (weight)
*/
if (!isset($weight)) { $weight = "0"; }
$weight = new XoopsFormText(_AM_AMREV_CATCAPSRT, 'formdata[weight]', 4, 4, $weight);
$reviewform->addElement($weight);
unset($weight);

/**
* Published date/time (this is the date that shows when it was published
*/
if (isset($date)) {	$pubdate = strtotime($date); }
	else { $pubdate = ""; }
$publishdate = new XoopsFormDateTime("", 'formdata[date]', 15, $pubdate);//_AM_AMREV_CAPSDDATE
//$reviewform->addElement($publishdate);
$datetray = new XoopsFormElementTray(_AM_AMREV_CAPSDDATE,'<br />');
$datetray->addElement($publishdate);
$reviewform->addElement($datetray);
unset($publishdate);

/**
* Start date/time (this is the date that shows when it was published
*/
if (isset($date_publish)) {	$pubstartdate = $date_publish; }
	else { $pubstartdate = ""; }
$startdate = new XoopsFormDateTime("", 'formdata[date_publish]', 15, $pubstartdate);//_AM_AMREV_CAPSDDATE
// Set start 
if ($date_publish != 0) { $startdate_checked = 1; }
	else { $startdate_checked = 0; }
$startdatetick = new XoopsFormCheckBox("", 'formdata[setstartdate]', $startdate_checked); // checked value here whether will be checked?
$startdatetick->addOption(1, _AM_AMREV_CAPSSTARTDTBX); // checked value here what will be sent in form?
// Clear yes/no
//$startdateYN = new XoopsFormRadioYN(_AM_AMREV_CAPSSTARTDTYN, 'formdata[removestartdate]', $value=0, $yes=_YES, $no=_NO, $id="");
// tray
$pubdatetray = new XoopsFormElementTray(_AM_AMREV_CAPSSTARTDATE,'<br />');
$pubdatetray->addElement($startdatetick);
$pubdatetray->addElement($startdate);
//$pubdatetray->addElement($startdateYN);
$reviewform->addElement($pubdatetray);
unset($startdate);
unset($pubdatetray);


/**
* End date/time (this is the date that shows when it was published
*/
if (isset($date_end)) {	$pubenddate = $date_end; }
	else { $pubenddate = ""; }
$enddate = new XoopsFormDateTime("", 'formdata[date_end]', 15, $pubenddate);//_AM_AMREV_CAPSDDATE
// Set end
if ($date_end != 0) { $enddate_checked = 1; }
	else { $enddate_checked = 0; }
$enddatetick = new XoopsFormCheckBox("", 'formdata[setendtdate]', $enddate_checked); // checked value here whether will be checked?
$enddatetick->addOption(1, _AM_AMREV_CAPSENDDTBX); // checked value here what will be sent in form?
// Clear - yes/no
//$enddateYN = new XoopsFormRadioYN(_AM_AMREV_CAPSENDDTYN, 'formdata[removeenddate]', $value=0, $yes=_YES, $no=_NO, $id="");
//tray
$pubdatetray = new XoopsFormElementTray(_AM_AMREV_CAPSENDDATE,'<br />');
$pubdatetray->addElement($enddatetick);
$pubdatetray->addElement($enddate);
//$pubdatetray->addElement($enddateYN);
$reviewform->addElement($pubdatetray);
unset($enddate);
unset($pubdatetray);

/**
* Page title options
* $xoopsModuleConfig['']
*/
if (!isset($pagetitle)) { $pagetitle = $xoopsModuleConfig['pagettldefault']; }
$pagettlselect = new XoopsFormSelect(_AM_AMREV_PAGETTL, 'formdata[pagetitle]', $pagetitle, '1', false);
$pagettlselect->addOption('0', _AM_AMREV_PAGETTL_OPT_0);
$pagettlselect->addOption('1', _AM_AMREV_PAGETTL_OPT_1);
$pagettlselect->addOption('2', _AM_AMREV_PAGETTL_OPT_2);
$reviewform->addElement($pagettlselect);				
unset($pagettlselect);

/**
* Meta header options
*/
if (!isset($metaheaders)) { $metaheaders = $xoopsModuleConfig['pagemetadefault']; }
$metaselect = new XoopsFormSelect(_AM_AMREV_KEYWORD, 'formdata[metaheaders]', $metaheaders, '1', false);
$metaselect->addOption('0', _AM_AMREV_KEYWORD_OPT_0);
$metaselect->addOption('1', _AM_AMREV_KEYWORD_OPT_1);
//$metaselect->addOption('2', _AM_AMREV_KEYWORD_OPT_2);
$reviewform->addElement($metaselect);				
unset($metaselect);

/**
* Allow comments for this item - y/n
*/
if (isset($comments) AND $comments == "0") { $comment_checked = "0"; }
else { $comment_checked = "1"; } 
$commentsbox = new XoopsFormCheckBox(_AM_AMREV_CAPCOMMENTS, 'formdata[comments]', $comment_checked); // checked value here whether will be checked?
$commentsbox->addOption(1, _AM_AMREV_CAPCOMMENTSTXT); // checked value here what will be sent in form?
$reviewform->addElement($commentsbox);
unset($commentsbox);

/**
* Display this review
*/
if (isset($showme) AND $showme == "0") { $showme_checked = "0"; }
else { $showme_checked = "1"; } 

$displayedbox = new XoopsFormCheckBox(_AM_AMREV_CAPDSPLYREV, 'formdata[showme]', $showme_checked); // checked value here whether will be checked?
$displayedbox->addOption(1, _AM_AMREV_CAPDSPLYREVTXT); // checked value here what will be sent in form?
$reviewform->addElement($displayedbox);
unset($displayedbox);


/**
* show/disable html
*/
if (isset($nohtml) AND $nohtml == "0") { $nohtml_checked = "0"; }
else { $nohtml_checked = "1"; } 
$nohtmlbox = new XoopsFormCheckBox("", 'formdata[nohtml]', $nohtml_checked); // checked value here whether will be checked?
$nohtmlbox->addOption(1, _AM_AMREV_FRMCAPNOHTML); // checked value here what will be sent in form?

/**
* show/disable auto line breaks
*/
if (isset($nobr) AND $nobr == "0") { $nobr_checked = "0"; }
else { $nobr_checked = "1"; }
$nobrbox = new XoopsFormCheckBox("", 'formdata[nobr]', $nobr_checked); // checked value here whether will be checked?
$nobrbox->addOption(1, _AM_AMREV_FRMCAPNOBR); // checked value here what will be sent in form?

/**
* show/disable smileys
*/
if (isset($nosmiley) AND $nosmiley == "0") { $nosmiley_checked = "0"; }
else { $nosmiley_checked = "1";}
$smileybox = new XoopsFormCheckBox("", 'formdata[nosmiley]', $nosmiley_checked); // checked value here whether will be checked?
$smileybox->addOption(1, _AM_AMREV_FRMCAPNOSMLY); // checked value here what will be sent in form?

/**
* show/disable xoops codes
*/
if (isset($noxcode) AND $noxcode == "0") { $noxcode_checked = "0"; }
else { $noxcode_checked = "1"; }
$xcodebox = new XoopsFormCheckBox("", 'formdata[noxcode]', $noxcode_checked); // checked value here whether will be checked?
$xcodebox->addOption(1, _AM_AMREV_FRMCAPNOXCDE); // checked value here what will be sent in form?

/**
* show/disable xoops images
*/
if (isset($noimage) AND $noimage == "0") { $noimage_checked = "0"; }
else { $noimage_checked = "1"; }
$imgcodebox = new XoopsFormCheckBox("", 'formdata[noimage]', $noimage_checked); // checked value here whether will be checked?
$imgcodebox->addOption(1, _AM_AMREV_FRMCAPNOXIMG); // checked value here what will be sent in form?

$optionstray = new XoopsFormElementTray('','<br />');
$optionstray->addElement($nohtmlbox);
$optionstray->addElement($nobrbox);
$optionstray->addElement($smileybox);
$optionstray->addElement($xcodebox);
$optionstray->addElement($imgcodebox);
$reviewform->addElement($optionstray);
unset($nohtmlbox);
unset($smileybox);
unset($xcodebox);
unset($imgcodebox);
unset($nobrbox);


/**
* Hidden fields
*/
if ($formaction == "add") {
	$reviewform->addElement(new XoopsFormHidden('op', 'save'));
}
if ($formaction == "edit") {
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
$button_sub = new XoopsFormButton('', 'but_save', $submitbutton, 'submit');
$button_tray = new XoopsFormElementTray('');
$button_tray->addElement($button_sub);
$reviewform->addElement($button_tray);


/**
* End - Display form
*/
$reviewform->display();



?>