<?php
// $Id: review.php,v 1.4 2007/01/24 19:15:59 andrew Exp $
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
include_once 'admin_header.php';
include_once("functions.inc.php");
include_once("../include/config.inc.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopstree.php");

$myts =& MyTextSanitizer::getInstance(); 

//----------------------------------------------------------------------------//

if (!isset($_REQUEST['op'])) {

xoops_cp_header();

	$rowclass = "";
	
	echo "<table border=\"0\" cellspacing=\"1\" width=\"100%\" class=\"outer\">";
	echo "<tr><th colspan=\"5\">" . _AM_AMREV_REVIEWTBLCAP . "</th></tr>";
	echo "<tr>";
	echo "<td class=\"head\" style=\"text-align: center;\">". _AM_AMREW_REVCAPID ."</td>";
	echo "<td class=\"head\" style=\"text-align: center;\">". _AM_AMREW_REVCAPTTL ."</td>";
    echo "<td class=\"head\" style=\"text-align: center;\">". _AM_AMREW_REVCAP_VISIBLE ."</td>";
    echo "<td class=\"head\" style=\"text-align: center;\">". _AM_AMREW_REVCAP_ACTIONS ."</td>";
//	echo "<td class=\"head\"></td>";
	echo "</tr>";
	
	$sql = ("SELECT * FROM " .$xoopsDB->prefix('amreview_reviews') . " ");
	$result=$xoopsDB->query($sql);

		if ($xoopsDB->getRowsNum($result) > 0) {
			while($myrow = $xoopsDB->fetchArray($result)) {

				$rowclass = ($rowclass == 'odd') ? 'even' : 'odd';
				
				echo "<tr>";
				echo "<td style=\"text-align: center; width: 20px;\" class=\"". $rowclass ."\">" . $myrow['id'] . "</td>";
				echo "<td class=\"". $rowclass ."\"><a href=\"javascript:;\" onclick=\"javascript:window.open('review.php?op=preview&amp;id=". $myrow['id'] ."', 'preview', 'height=500,width=650,status=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');\" title=\"". _AM_AMR_FRMCAPLNKPRVW ."\">". $myrow['title'] ."</a></td>";
				
				if ($myrow['showme'] == 1) { 
					$bulb = "1.png";
					$alttxt = _AM_AMREV_STATUSSHOW;
				} else { 
					$bulb = "0.png";
					$alttxt = _AM_AMREV_STATUSHIDE;
				}
				
				echo "<td style=\"text-align: center; width: 20px;\" class=\"". $rowclass ."\"><img src=".$pathIcon16.'/'.$bulb. " title=\"". $alttxt ."\" alt=\"". $alttxt ."\" width=\"16\" height=\"16\" /></td>";
				echo "<td style=\"text-align: center; width: 20px;\" class=\"". $rowclass ."\"><a href=\"review.php?op=edit&amp;id=". $myrow['id'] ."\"><img src=".$pathIcon16."/edit.png alt=\"". _AM_AMREV_CLICKEDIT ."\" title=\"". _AM_AMREV_CLICKEDIT ."\" width=\"16\" height=\"16\" /></a>"
				 ."<a href=\"review.php?op=del&amp;id=". $myrow['id'] ."\"><img src=".$pathIcon16."/delete.png alt=\"". _AM_AMREV_CLICKDELETE ."\" title=\"". _AM_AMREV_CLICKDELETE ."\" width=\"16\" height=\"16\" /></a></td>";
				echo "</tr>";
			}
		}
	
	echo "</table><br /><br />";

	
	/**
	* include review form - add new.
	*/
	$formcaption = _AM_AMREV_REVCAPTION;
	$submitbutton = _AM_AMREV_REVCAPSAVE;
	$formaction = "add";

	include_once("reviewform.inc.php");
	
amrev_adminfooter();
include_once 'admin_footer.php';
} // end if

//----------------------------------------------------------------------------//

/**
* Save new review data.
*/
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "save") {
xoops_cp_header();


	if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
		else { $formdata = ""; }
		
	//echo "<pre>";
	//print_r($formdata);
	//exit;
	//echo "</pre>";

			//id			=
			$uid			= intval($formdata['uid']);
			$catid			= intval($formdata['catid']);
			$weight			= intval($formdata['weight']);
			$title			= $myts->addSlashes($formdata['title']);
			$subtitle		= $myts->addSlashes($formdata['subtitle']);
			$image_file		= $myts->addSlashes($formdata['image_file']);
			$image_align	= "L"; // (TEMP) $formdata['image_align'];
			$our_rating		= intval($formdata['our_rating']);
			$reviewer_ip	= $formdata['reviewer_ip'];
			$teaser			= $myts->addSlashes($formdata['teaser']);
			$item_details	= $myts->addSlashes($formdata['item_details']);
			$review			= $myts->addSlashes($formdata['review']);
			$keywords		= $myts->addSlashes($formdata['keywords']);
			$date			= date("Y-m-d H:i:s", strtotime($formdata['date']['date']) + $formdata['date']['time']);
			//$date_publish	= strtotime($formdata['date_publish']['date']) + $formdata['date_publish']['time'];
			//$date_end		= strtotime($formdata['date_end']['date']) + $formdata['date_end']['time'];
			$views			= NULL; //intval
			$pagetitle		= intval($formdata['pagetitle']);
			$metaheaders	= intval($formdata['metaheaders']);
			//$comments		= intval($formdata['comments']);
				if (isset($formdata['comments'])) {
					$comments = 1; //intval($formdata['showme']);
				} else {
					$comments = 0;
				}
			$notify			= 0; //intval($formdata['our_rating']);
			$validated		= "1"; //intval($formdata['validated']);
				if (isset($formdata['showme'])) {
					$showme = 1; //intval($formdata['showme']);
				} else {
					$showme = 0;
				}
			$highlight		= "1"; //intval($formdata['our_rating']);
				if (isset($formdata['nohtml'])) {
					$nohtml	= 1; //intval($formdata['nohtml']);
				} else {
					$nohtml = 0;
				}
				if (isset($formdata['nosmiley'])) {
					$nosmiley = 1; //intval($formdata['nosmiley']);
				} else {
					$nosmiley = 0;
				}
				if (isset($formdata['noxcode'])) {
					$noxcode = 1; //intval($formdata['noxcode']);
				} else {
					$noxcode = 0;
				}
				if (isset($formdata['noimage'])) {
					$noimage = 1; //intval($formdata['noimage']);
				} else {
					$noimage = 0;
				}
				if (isset($formdata['nobr'])) {
					$nobr = 1; //intval($formdata['nobr']);
				} else {
					$nobr = 0;
				}


			if(isset($showme) AND $showme == 1) { $showme = 1; }
				else { $showme = 0; }
			
			/**
			* If date_publish switch is set (this meaning there is a start
			* date/time from when to display the review, set the date, else
			* set to zero, so it is ignored.
			*/
			if (isset($formdata['setstartdate']) AND $formdata['setstartdate'] == 1) {
				$date_publish = strtotime($formdata['date_publish']['date']) + $formdata['date_publish']['time'];
			} else {
				$date_publish = 0;
			}
			/**
			* And the same for the expiry date...
			*/
			if (isset($formdata['setendtdate']) AND $formdata['setendtdate'] == 1) {
				$date_end = strtotime($formdata['date_end']['date']) + $formdata['date_end']['time'];
			} else {
				$date_end = 0;
			} 
			//echo $date_publish . "<br>";
			//echo $date_end . "<br>";
	

		$sql = "INSERT INTO ".$xoopsDB->prefix("amreview_reviews")." VALUES (
			NULL, 
			'$uid',
			'$catid',
			'$weight',
			'$title',
			'$subtitle',
			'$image_file',
			'$image_align',
			'$our_rating',
			'$reviewer_ip',
			'$teaser',
			'$item_details',
			'$review',
			'$keywords',
			'$date',
			'$date_publish',
			'$date_end',
			'$views',
			'$pagetitle',
			'$metaheaders',
			'$comments',
			'$notify',
			'$validated',
			'$showme',
			'$highlight',
			'$nohtml',
			'$nosmiley',
			'$noxcode',
			'$noimage',
			'$nobr'
			)";

		$xoopsDB->query($sql); // or $eh->show("0013");
		if ($xoopsDB->getAffectedRows($sql)) {
			redirect_header("review.php", 2, _AM_AMREV_DBUPDATED);
			//echo "entered";
		} else {
			redirect_header("review.php", 2, _AM_AMREV_DBNOUPDATED);
			//echo "not entered";
		}
	
	
/**
Reference:

[title]
[subtitle]
[teaser]
[item_details]
[review]
[catid]
[uid]
[weight]
[date]
	(
		[date] => 2006-04-11
		[time] => 71400
	)
[setstartdate]
[date_publish]
	(
		[date] => 2006-04-11
		[time] => 73200
	)
[removestartdate]
[setendtdate]
[date_end]
	(
		[date] => 2006-04-11
		[time] => 78000
	)
[removeenddate]
[showme]
[nohtml]
[nobr]
[nosmiley]
[noxcode]
[noimage]


id				int(10)			No   	0
uid				int(10)			No  	0 
catid			int(10)			No  	0 
weight			int(10)			No  	0 
title			varchar(100)	Yes  	NULL 
subtitle		varchar(100)	Yes  	NULL 
image_file		varchar(100)	Yes  	NULL 
image_align		char(1)			No  	L 
our_rating		varchar(5)		No  	0 
reviewer_ip		varchar(20)		No  	000.000.000.000 
teaser			text			Yes  	NULL 
item_details	text			Yes  	NULL 
review			text			Yes  	NULL 
keywords		text			Yes  	NULL 
date			datetime		No  	0000-00-00 00:00:00 
date_publish	datetime		No  	0000-00-00 00:00:00 
date_end		datetime		No  	0000-00-00 00:00:00 
views			datetime		No  	0000-00-00 00:00:00 
pagetitle		int(5)			No		0
metaheaders		int(5)			No  	0
comments		enum('0', '1')	No		1 
notify			enum('0', '1')	No  	0 
validated		enum('0', '1')	No  	0 
showme			enum('0', '1')	No  	0 
highlight		enum('0', '1')	No  	0 
nohtml			enum('0', '1')	No  	1 
nosmiley		enum('0', '1')	No  	1 
noxcode			enum('0', '1')	No  	1 
noimage			enum('0', '1')	No  	1 
nobr			enum('0', '1')	No   	1

*/
#amrev_adminfooter();	
xoops_cp_footer();	
} //

//----------------------------------------------------------------------------//

/**
* Edit review
*/
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "edit") {


	/**
	* Load form if subop not set.
	*/
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();

		
			if (isset($_GET['id'])) { $id = intval($_GET['id']); }
				else { $id = ""; }
	
			$sql = ("SELECT * FROM " .$xoopsDB->prefix('amreview_reviews'). " WHERE id='" . $id . "'");
			$result=$xoopsDB->query($sql);

				if ($xoopsDB->getRowsNum($result) > 0) {
					while($myrow = $xoopsDB->fetchArray($result)) {

						$rev_id			= $myrow['id'];
						$uid			= $myrow['uid'];
						$catid			= $myrow['catid'];
						$weight			= $myrow['weight'];
						$title			= $myts->htmlSpecialChars($myrow['title']);
						$subtitle		= $myts->htmlSpecialChars($myrow['subtitle']);
						$image_file		= $myrow['image_file'];
						$image_align	= $myrow['image_align'];
						$our_rating		= $myrow['our_rating'];
						$reviewer_ip	= $myrow['reviewer_ip'];
						$teaser			= $myts->htmlSpecialChars($myrow['teaser']);
						$item_details	= $myts->htmlSpecialChars($myrow['item_details']);
						$review			= $myts->htmlSpecialChars($myrow['review']);
						$keywords		= $myts->htmlSpecialChars($myrow['keywords']);
						$date			= $myrow['date'];
						$date_publish	= $myrow['date_publish'];
						$date_end		= $myrow['date_end'];
						$views			= $myrow['views'];
						$pagetitle		= $myrow['pagetitle'];
						$metaheaders	= $myrow['metaheaders'];
						$comments		= $myrow['comments'];
						$notify			= $myrow['notify'];
						$validated		= $myrow['validated'];
						$showme			= $myrow['showme'];
						$highlight		= $myrow['highlight'];
						$nohtml			= $myrow['nohtml'];
						$nosmiley		= $myrow['nosmiley'];
						$noxcode		= $myrow['noxcode'];
						$noimage		= $myrow['noimage'];
						$nobr			= $myrow['nobr'];
				
					} // while
				} // if

			/**
			* include review form - add new.
			*/
			$formcaption = _AM_AMREV_REVCAPEDIT;
			$submitbutton = _AM_AMREV_REVCAPSAVE;
			$formaction = "edit";

			include_once("reviewform.inc.php");
	
		amrev_adminfooter();
        include_once 'admin_footer.php';
	} // end if no subop

	/**
	* Save update if subop set.
	*/
	if (isset($_REQUEST['subop']) AND $_REQUEST['subop'] == "save") {
		xoops_cp_header();
		
		if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
			else { $formdata = ""; }

		//echo "<pre>";
		//print_r($formdata);
		//exit;
		//echo "</pre>";
		
			$id				= intval($formdata['id']);
			$uid			= intval($formdata['uid']);
			$catid			= intval($formdata['catid']);
			$weight			= intval($formdata['weight']);
			$title			= $myts->addSlashes($formdata['title']);
			$subtitle		= $myts->addSlashes($formdata['subtitle']);
			$image_file		= $myts->addSlashes($formdata['image_file']);
			$image_align	= "L"; // (TEMP) $formdata['image_align'];
			$our_rating		= intval($formdata['our_rating']);
			$reviewer_ip	= $formdata['reviewer_ip'];
			$teaser			= $myts->addSlashes($formdata['teaser']);
			$item_details	= $myts->addSlashes($formdata['item_details']);
			$review			= $myts->addSlashes($formdata['review']);
			$keywords		= $myts->addSlashes($formdata['keywords']);
			$date			= date("Y-m-d H:i:s", strtotime($formdata['date']['date']) + $formdata['date']['time']);
			//$date_publish	= strtotime($formdata['date_publish']['date']) + $formdata['date_publish']['time'];
			//$date_end		= strtotime($formdata['date_end']['date']) + $formdata['date_end']['time'];
			$views			= intval($formdata['views']); //NULL; //intval
			$pagetitle		= intval($formdata['pagetitle']);
			$metaheaders	= intval($formdata['metaheaders']);
			//$comments		= intval($formdata['comments']);
				if (isset($formdata['comments'])) {
					$comments = 1; //intval($formdata['showme']);
				} else {
					$comments = 0;
				}
			$notify			= 0; //intval($formdata['notify']);
			$validated		= "1"; //intval($formdata['validated']);
				if (isset($formdata['showme'])) {
					$showme = 1; //intval($formdata['showme']);
				} else {
					$showme = 0;
				}
			$highlight		= "1"; //intval($formdata['our_rating']);
				if (isset($formdata['nohtml'])) {
					$nohtml	= 1; //intval($formdata['nohtml']);
				} else {
					$nohtml = 0;
				}
				if (isset($formdata['nosmiley'])) {
					$nosmiley = 1; //intval($formdata['nosmiley']);
				} else {
					$nosmiley = 0;
				}
				if (isset($formdata['noxcode'])) {
					$noxcode = 1; //intval($formdata['noxcode']);
				} else {
					$noxcode = 0;
				}
				if (isset($formdata['noimage'])) {
					$noimage = 1; //intval($formdata['noimage']);
				} else {
					$noimage = 0;
				}
				if (isset($formdata['nobr'])) {
					$nobr = 1; //intval($formdata['nobr']);
				} else {
					$nobr = 0;
				}


			if(isset($showme) AND $showme == 1) { $showme = 1; }
				else { $showme = 0; }
			
			/**
			* If date_publish switch is set (this meaning there is a start
			* date/time from when to display the review, set the date, else
			* set to zero, so it is ignored.
			*/
			if (isset($formdata['setstartdate']) AND $formdata['setstartdate'] == 1) {
				$date_publish = strtotime($formdata['date_publish']['date']) + $formdata['date_publish']['time'];
			} else {
				$date_publish = 0;
			}
			/**
			* And the same for the expiry date...
			*/
			if (isset($formdata['setendtdate']) AND $formdata['setendtdate'] == 1) {
				$date_end = strtotime($formdata['date_end']['date']) + $formdata['date_end']['time'];
			} else {
				$date_end = 0;
			} 
			//echo $date_publish . "<br>";
			//echo $date_end . "<br>";
		
			/**
			* Save updates
			*/
			$sql = ("UPDATE ".$xoopsDB->prefix("amreview_reviews")." SET 
				id				= '$id',
				uid				= '$uid',
				catid			= '$catid',
				weight			= '$weight',
				title			= '$title',
				subtitle		= '$subtitle',
				image_file		= '$image_file',
				image_align		= '$image_align',
				our_rating		= '$our_rating',
				reviewer_ip		= '$reviewer_ip',
				teaser			= '$teaser',
				item_details	= '$item_details',
				review			= '$review',
				keywords		= '$keywords',
				date			= '$date',
				date_publish	= '$date_publish',
				date_end		= '$date_end',
				views			= '$views',
				pagetitle		= '$pagetitle',
				metaheaders		= '$metaheaders',
				comments		= '$comments',
				notify			= '$notify',
				validated		= '$validated',
				showme			= '$showme',
				highlight		= '$highlight',
				nohtml			= '$nohtml',
				nosmiley		= '$nosmiley',
				noxcode			= '$noxcode',
				noimage			= '$noimage',
				nobr			= '$nobr'
				WHERE id='$id'");
	
				$result=$xoopsDB->query($sql);

				//if ($xoopsDB->query($sql)) {
				if ($result) {
					redirect_header("review.php", 2, _AM_AMREV_DBUPDATED);
					//echo "entered";
				} else {
					redirect_header("review.php", 2, _AM_AMREV_DBNOUPDATED);
					//echo "not entered";
				}
		
		#amrev_adminfooter();
		xoops_cp_footer();
	} // end subop save update

} // end

//----------------------------------------------------------------------------//

/**
* Delete review.
*/
if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "del") {
//xoops_cp_header();

	if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); }
		else { $id = ""; }

	/**
	* Confirm deletion.
	*/
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();
		xoops_confirm(array('op' => 'del', 'id' => $id, 'subop' => 'delok'), 'review.php', _AM_AMREV_DBCONFMDEL);
		#amrev_adminfooter();
		xoops_cp_footer();
	} // end if
	
	/**
	* Delete
	*/
	if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == "delok") {
	
		$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("amreview_reviews"), $id);
	                
		if ($xoopsDB->queryF($sql)) {
			// Delete comments for this review
			xoops_comment_delete($xoopsModule->getVar('mid'), $id);
			// delete notifications for this review
			#xoops_notification_deletebyitem($xoopsModule->getVar('mid'), 'global', $art_id);
			// redirect
			redirect_header("review.php", 2, _AM_AMREV_DBDELETED);
			//echo "deleted";
		} else {
			redirect_header("review.php", 2, _AM_AMREV_DBNOTDELETED);
			//echo "not deleted";
		} //
	} //
	
	
} // end if


//****************************************************************************//

if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "preview") {

echo "moo";



} // end



?>