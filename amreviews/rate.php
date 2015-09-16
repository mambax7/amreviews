<?php
// $Id: rate.php,v 1.2 2007/01/24 19:24:32 andrew Exp $
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
include_once("header.php");
include_once(XOOPS_ROOT_PATH . "/class/xoopsformloader.php");

//
$myts =& MyTextSanitizer::getInstance();


//----------------------------------------------------------------------------//
// Check access (permissions and stuff, logged in)
if($xoopsModuleConfig['loggedinvote'] == 1) {
	#echo "logged in ";
	if (empty($xoopsUser)) {
		#echo "(empty user)";
		redirect_header(XOOPS_URL."/user.php", 2, _MD_LOGGEDINVOTE);
		exit();
	}
}


//----------------------------------------------------------------------------//
// Add vote stuff
if(isset($_REQUEST['id']) AND isset($_REQUEST['rate'])) {
	
	/**
	* Check to see if voted.
	*/
	$result = $xoopsDB->query("SELECT id FROM " .$xoopsDB->prefix('amreview_rate') . " WHERE rate_user_ip LIKE '%".$_SERVER['REMOTE_ADDR']."%' AND rate_review_id = '".intval($_GET['id'])."'");
	list($voted) = $xoopsDB->fetchRow($result);

	if ($voted) { // match
		#echo "you've voted";
		redirect_header("review.php?id=".intval($_GET['id'])."", 2, _AM_AMREV_ALRDYVTD);
		exit();
	}


	/**
	*  Insert vote data.
	*/
	$rate_review_id		= intval($_GET['id']);
	$rate_rating		= intval($_GET['rate']);
	
	// find user id
	if (empty($xoopsUser)) { $rate_uid = 0;} 
		else { $rate_uid = $xoopsUser->getVar('uid'); }

	$rate_user_ip		= $_SERVER['REMOTE_ADDR'];
	$rate_user_browser	= "";
	$rate_title			= "";
	$rate_text			= "";
	//$rate_datetime
	$rate_showme		= "";
	$rate_validated		= "";
	$rate_useful		= "";
	
		$sql = "INSERT INTO ".$xoopsDB->prefix("amreview_rate")." VALUES (
			NULL, 
			'$rate_review_id',
			'$rate_rating',
			'$rate_uid',
			'$rate_user_ip',
			'$rate_user_browser',
			'$rate_title',
			'$rate_text',
			NOW(),
			'$rate_showme',
			'$rate_validated',
			'$rate_useful'
			)";
		
		$xoopsDB->queryF($sql); // or $eh->show("0013");
		if ($xoopsDB->getAffectedRows($sql)) {
			redirect_header("review.php?id=".intval($_GET['id'])."", 2, _AM_AMREV_VOTED);
			//echo "voted";
		} else {
			redirect_header("review.php?id=".intval($_GET['id'])."", 2, _AM_AMREV_DBVOTEFAIL);
			//echo "not entered";
		}	

/*
id
rate_review_id
rate_rating
rate_uid
rate_user_ip
rate_user_browser
rate_title
rate_text
rate_datetime
rate_showme
rate_validated
rate_useful
*/	
	
} // end section


//----------------------------------------------------------------------------//
// Default page view - defunct, remove me
#if(!isset($_REQUEST['op'])) {
if(isset($_REQUEST['somethingsoIdonotgetloaded'])) {

	$xoopsOption['template_main']= "amr_rate.html";
	include (XOOPS_ROOT_PATH . "/header.php");
	
	/**
	* General assigns.
	*/
	//$xoopsTpl->assign("gen_on",	_MD_AMR_GENON);
	//$xoopsTpl->assign("gen_on",	_MD_AMR_GENON);
	
	//echo "Sorry, not yet implemented.";
	
	
	$rateform = new XoopsThemeForm(_MD_AMR_RATEFRMCAP, "rateform", xoops_getenv('PHP_SELF'), 'post');
	
	/**
	* Rating type
	* 0 - Rate only, 1 - Rating and comment, 2 - comment only
	*/
	$rateselect = new XoopsFormSelect(_MD_AMR_RATETYPECAP, 'formdata[type]', $art_cat_id, '1', false);
	$rateselect->addOption('0', _MD_AMR_RATETYPEONLY);
	$rateselect->addOption('1', _MD_AMR_RATETYPERANDC);
	$rateselect->addOption('2', _MD_AMR_RATETYPECOMM);
	$rateform->addElement($rateselect);
	unset($rateselect);
	
	/**
	* Rating (out of 5)
	*/
	$ratingselect = new XoopsFormSelect(_MD_AMR_CAPRATE, 'formdata[rating]', $our_rating="0", '1', false);
	$ratingselect->addOption('0', _MD_AMR_CAPRATESLT);
	$ratingselect->addOption('1', _MD_AMR_CAPRATE1);
	$ratingselect->addOption('2', _MD_AMR_CAPRATE2);
	$ratingselect->addOption('3', _MD_AMR_CAPRATE3);
	$ratingselect->addOption('4', _MD_AMR_CAPRATE4);
	$ratingselect->addOption('5', _MD_AMR_CAPRATE5);
	$rateform->addElement($ratingselect);				
	unset($ratingselect);

	/**
	* Review title/subject
	*/
	$title = new XoopsFormText(_MD_AMR_FRMCAPSDTTL, 'formdata[title]', 40, 50, $art_title);
	$rateform->addElement($title);
	unset($title);
	
	/**
	* Comment
	*/
	$commeditor = new XoopsFormTextArea(_MD_AMR_COMMENTTXT, 'formdata[comment]', $item_details, $rows=8, $cols=36, 0);
	$rateform->addElement($commeditor);
	unset($commeditor);
	
	/**
	* Hidden fields
	*/
	$rateform->addElement(new XoopsFormHidden('formdata[id]', intval($_GET['id'])));
	$rateform->addElement(new XoopsFormHidden('op', 'save'));
	
	/**
	* Buttons
	*/
	$button_sub = new XoopsFormButton('', 'but_save', _MD_AMR_RATESUBMIT, 'submit');
	//$button_sub->setExtra('onclick="return checkfields();"');
	$button_can = new XoopsFormButton('', 'but_reset', _MD_AMR_RATERESET, 'reset');
	
	$tray = new XoopsFormElementTray('');
	$tray->addElement($button_sub);
	$tray->addElement($button_can);
	$rateform->addElement($tray);
	unset($button_sub);
	unset($button_can);
	
	#$rateform->display();
	//
	// Assign to template		
	$xoopsTpl->assign('rateform',	$rateform->render());
	unset($rateform);
	
	// header bit
	$xoopsTpl->assign('category_path', "<a href=\"". XOOPS_URL ."/modules/". _AM_AMRMODDIR ."/index.php\">" . $xoopsModule->getVar('name') ."</a> &#187; ". _MD_AMR_RATEPGNM);
	
	include_once (XOOPS_ROOT_PATH . "/footer.php");	
} // end 

//----------------------------------------------------------------------------//

include_once("footer.php");
?>