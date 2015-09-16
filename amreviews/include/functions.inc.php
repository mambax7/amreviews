<?php
// $Id: functions.inc.php,v 1.4 2007/01/24 19:18:48 andrew Exp $
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
include_once("config.inc.php");

/**
*
*/
function amr_ratings($id = "0") {
global $xoopsDB;

	$sql = ("SELECT * FROM " .$xoopsDB->prefix('amreview_cat') . " ");
	$result=$xoopsDB->query($sql);
	
}

//----------------------------------------------------------------------------//

/**
* Xoopstree thingy
* getCatPath("Top/index caption", $catid, column name, path, separator, table name, cat ID tbl name, cat parent id name) 
*/
function getCatPath($topcap="Top", $catid="0", $columnname="", $path, $delim=":", $table, $itemID, $parID) {
global $xoopsDB;
	
	include_once(XOOPS_ROOT_PATH . "/class/xoopstree.php");	
	//$mytree = new XoopsTree($xoopsDB->prefix("amreview_cat"),"id","cat_parentid");
	$mytree = new XoopsTree($xoopsDB->prefix("$table"),"$itemID","$parID");
	
	$cat_path = "<a href=\"index.php\">" . $topcap . "</a>&nbsp;:&nbsp;"; // $xoopsModule->getVar('name') - _MD_AMR_NAVBCTOP
	$cat_path .= $mytree->getNicePathFromId($catid, $columnname, $path);
	
	// Replace link/level separator
	$cat_path = str_replace(":", $delim, $cat_path);
	
	return $cat_path;			
	
} // end function

//----------------------------------------------------------------------------//

/**
* Get review count for category (not recursive)
*/
function amr_getReviewcount($catid="0") {
global $xoopsDB;

	$sql = ("SELECT COUNT(id) AS count FROM " .$xoopsDB->prefix('amreview_reviews') . 
	" WHERE catid='". $catid ."'");
	$result=$xoopsDB->query($sql);
	
		if ($xoopsDB->getRowsNum($result) > 0) {
			while($myrow = $xoopsDB->fetchArray($result)) {
				$count = $myrow['count'];
			}
		}
		return $count;
		

} // end function

//----------------------------------------------------------------------------//

/**
* Increment review views/reads
*/
function amr_increment_views($id) {
global $xoopsDB;

	$sql = ("UPDATE ".$xoopsDB->prefix("amreview_reviews")." SET views=views+1 WHERE id='". intval($id) ."'");
	$xoopsDB->queryF($sql);

} // end function

//----------------------------------------------------------------------------//

/**
* Get review count for category (not recursive)
*/
function amr_getGetsubcats($catid="0") {
global $xoopsDB;

	$sql = ("SELECT * FROM " .$xoopsDB->prefix('amreview_cat') . 
	" WHERE cat_parentid='". $catid ."' ORDER BY cat_title ASC");
	$result=$xoopsDB->query($sql);
	
		$catlist = "";
		if ($xoopsDB->getRowsNum($result) > 0) {
			while($myrow = $xoopsDB->fetchArray($result)) {
				//$count = $myrow['count'];
				$catlist .= "<a href=\"index.php?id=". $myrow['id'] ."\">" . $myrow['cat_title'] ."</a><br />";
			}
		}
		return $catlist;
		

} // end function

//----------------------------------------------------------------------------//
/**
* Return user rating for review.
*/
function getUserRating($id = "0") {
global $xoopsDB;
	
	$result = $xoopsDB->query("SELECT AVG(rate_rating) AS rate, COUNT(rate_rating) AS votes FROM " .$xoopsDB->prefix('amreview_rate') . " WHERE rate_review_id='" . intval($id) . "'");
	list($rate, $votes) = $xoopsDB->fetchRow($result);// {

		if (!$result OR $rate < 0.01) { 
			$summary['rate'] = 0;
			$summary['votes'] = 0;
		} else { 
			$summary['rate'] = @number_format($rate, 1); // @number_format($current_rating/$count,2)
			$summary['votes'] = $votes;
		} 
	unset($result);
	
	return($summary);
	
} // end function


?>