<?php
// $Id: review.php,v 1.5 2007/01/24 19:24:32 andrew Exp $
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
//include_once(XOOPS_ROOT_PATH . "/class/xoopstree.php");

//
$myts =& MyTextSanitizer::getInstance();
//$mytree = new XoopsTree($xoopsDB->prefix("amreview_cat"),"id","cat_parentid");

//----------------------------------------------------------------------------//
// Default page view
if(isset($_REQUEST['id'])) {

	$xoopsOption['template_main']= "amr_review.html";
	include (XOOPS_ROOT_PATH . "/header.php");
	
	/**
	* General assigns.
	*/
	$xoopsTpl->assign("gen_on",	_MD_AMR_GENON); // 
	$xoopsTpl->assign("reviewed_by",	_MD_AMR_REVIEWEDBY); 
	//_MD_AMR_SUBTTLCAP // Subtitle caption.
	$xoopsTpl->assign("our_ratingcap",		_MD_AMR_OURRATECAP);
	$xoopsTpl->assign("user_ratingcap", _MD_AMR_USERRATECAP);
	$xoopsTpl->assign("mod_dir", _AM_AMRMODDIR);
	$xoopsTpl->assign("item_detailscap", _MD_AMR_DETAILSCAP);
	$xoopsTpl->assign("backcap", _MD_AMR_BACKCAP);
	$xoopsTpl->assign("printcap", _MD_AMR_PRINTCAP);
	$xoopsTpl->assign("emailcap", _MD_AMR_EMAILCAP);
	$xoopsTpl->assign("pdfcap", _MD_AMR_PDFCAP);
	$xoopsTpl->assign("rsscap", _MD_AMR_RSSCAP);
	$xoopsTpl->assign("editcap", _MD_AMR_EDITCAP);
	$xoopsTpl->assign("deletecap", _MD_AMR_DELETECAP);
	$xoopsTpl->assign("readscap", _MD_AMR_READCAP);
	
	/**
	* Settings assigns
	*/	
	$xoopsTpl->assign("print_switch", $xoopsModuleConfig['showprint']);
	$xoopsTpl->assign("email_switch", $xoopsModuleConfig['allowemail']);
	$xoopsTpl->assign("pdf_switch", $xoopsModuleConfig['allowpdf']);
	$xoopsTpl->assign("hiliteimg_switch", $xoopsModuleConfig['hiliteimg']);
	
	/**
	* If admin...
	*/
	// admin link
	if ($xoopsUser AND $xoopsUser->isAdmin($xoopsModule->mid())) {
		$xoopsTpl->assign('isadmin', "1");
	}


		/**
		* Start category view in directory mode.
		* Note: look into adding review count into mysql join.
		* Add pagination.
		*/
		$sql = ("SELECT * FROM " .$xoopsDB->prefix('amreview_reviews') . 
		" WHERE (date_publish='0' OR ". time() ." > date_publish) AND (date_end='0' OR ". time() ." < date_end) AND validated='1' AND showme='1' AND id = '" . intval($_GET['id']) . "'");
		$result=$xoopsDB->query($sql);

		if ($xoopsDB->getRowsNum($result) > 0) {
			while($myrow = $xoopsDB->fetchArray($result)) {

				$xoopsTpl->assign("id",	$myrow['id']);
				$xoopsTpl->assign("title",	$myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0));
				$xoopsTpl->assign("item_details",	$myts->displayTarea($myrow['item_details'], 1, 1, 1, 1, 1));
				//$xoopsTpl->assign("review",	$myts->displayTarea($myrow['review'], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
				$xoopsTpl->assign("date",	formatTimestamp(strtotime($myrow['date']), $xoopsModuleConfig['dateformat']));
				$xoopsTpl->assign("views",	$myrow['views']);
				
				/**
				* If there's a subtitle, display it.
				*/
				if($myrow['subtitle'] != NULL) {
					$xoopsTpl->assign("subtitle", $myts->displayTarea($myrow['subtitle']));
					$xoopsTpl->assign("showsubtitle", 1);
				}
				
				/**
				* Switch comments on/off for review
				*/
				$xoopsTpl->assign("allowcomments",	$myrow['comments']);
				
				
									
				/**
				* Get image thumbnail image. Gets path from prefs, splits 
				* main filename, and adds "_hl" to help make filename for
				* highlight image in review listing.
				*/ 
				//$imgFileName	= explode(".", $myrow['image_file']);
				$xoopsTpl->assign("photopath", $xoopsModuleConfig['photopath']);
				$xoopsTpl->assign("imagefilename", $myrow['image_file']);
				//$xoopsTpl->assign("thumbnail", $amr_photodir . "/thumb/" . $imgFileName['0'] . "." . $imgFileName['1']);

				
				/**
				* Whether or not to show "Reviewed by info", and get
				* info.
				* showreviewedby
				*/
				if ($xoopsModuleConfig['showreviewedby'] == 1) {
					// later add realname option - http://www.xoops.org/misc/api/kernel/XoopsUser.html#getUnameFromId
					$xoopsTpl->assign("reviewer_name",	XoopsUser::getUnameFromId($myrow['uid'],0));
					$xoopsTpl->assign("reviewer_uid",	$myrow['uid']);
					$xoopsTpl->assign("reviewer_show",	1);
				}
				
				/**
				* Get "our rating" info and image.
				* our_rating
				*/
				$baserate = $myrow['our_rating'];
				$ourRateIMG = "star-" . $baserate . "." . _AM_AMR_RATESTAREXT;
				if ($baserate == 0) { $staralt = _MD_AMR_STARALTNORATE; }
				$our_rating = "<img src=\"". XOOPS_URL ."/modules/". _AM_AMRMODDIR ."/images/". $ourRateIMG ."\" alt=\"". _MD_AMR_STARALTNORATE ."\" title=\"". _MD_AMR_STARALTNORATE ."\">";
				$xoopsTpl->assign("our_rating", $our_rating);
				
				/**
				* Get public rating
				*/
				// match IP address to see if voted already.
				#$voted=@mysql_fetch_assoc(@mysql_query("SELECT title FROM $tableName WHERE used_ips LIKE '%".$_SERVER['REMOTE_ADDR']."%' AND id='$id' "));
				$result = $xoopsDB->query("SELECT id FROM " .$xoopsDB->prefix('amreview_rate') . " WHERE rate_user_ip LIKE '%".$_SERVER['REMOTE_ADDR']."%' AND rate_review_id = '".$myrow['id']."'");
				list($voted) = $xoopsDB->fetchRow($result);

				#echo $voted;
				if ($voted) { // match
					$xoopsTpl->assign("voted", 1);
				} else { // no match
					$xoopsTpl->assign("voted", 0);
				}
				
				#$userRatings = $ratings_handler->getRating(intval($_GET['id']));
				//print_r($userRatings);

				#$xoopsTpl->assign("imgFileName", "star-" . $userRatings['imgNum'] . "." . _AM_AMR_RATESTAREXT);
				#$xoopsTpl->assign("imgALT", sprintf(_MD_AMR_USERRATEALT, $userRatings['rating'], $userRatings['rates']));
				
				$userRatings = getUserRating(intval($_GET['id']));
				//print_r ($userRatings);
				
				$xoopsTpl->assign("user_rating", $userRatings['rate']);
				$xoopsTpl->assign("user_rating_star", $userRatings['rate']*12); // for stars state
				$xoopsTpl->assign("user_votes", $userRatings['votes']);
				
				
				/**
				* Get breadcrumbs - possibly put in function later.
				*/
				//if (isset($_GET['id'])) { $catid = intval($_GET['id']); }
				//	else { $catid = 0; }
				//$cat_path = "<a href=\"index.php\">" . _MD_AMR_NAVBCTOP . "</a>&nbsp;&#187;&nbsp;";
				//$cat_path .= $mytree->getNicePathFromId($myrow['catid'], "cat_title", "index.php?t=");
				$cat_path = getCatPath($xoopsModule->getVar('name'), $myrow['catid'], "cat_title", "index.php?t=", "&#187;", "amreview_cat", "id", "cat_parentid"); // _MD_AMR_NAVBCTOP
				$xoopsTpl->assign('category_path', $cat_path);
				
				
				/**
				* add custom title to page title 
				*/
				if ($myrow['pagetitle'] == 1) {
					$xoopsTpl->assign('xoops_pagetitle', $xoopsModule->getVar('name').' - '.$myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0)); // module name - article title
				}
				if ($myrow['pagetitle'] == 2) {
					$xoopsTpl->assign('xoops_pagetitle', $myts->displayTarea($myrow['title'], 0, 0, 0, 0, 0).' - '.$xoopsModule->getVar('name')); // article title -  module name
				}
				
				/**
				* Swap meta keywords for own
				*/ 
				if ($myrow['metaheaders'] == 1) {
					$xoopsTpl->assign('xoops_meta_keywords', $myts->displayTarea($myrow['keywords'], 0, 0, 0, 0, 0));
				}
				
				
				/**
				* Do pagination where [pagebreak] is used.
				* 
				*/
				if(isset($_GET['page'])) { $page = intval($_GET['page']); }
					else { $page = "" ;}
					
					//$content = $myrow['art_article_text'];

					$contentpages = explode( "[pagebreak]", $myrow['review']);
					$pageno = count($contentpages);
					/* Define the current page	*/
					if ( $page=="" || $page < 1 ) {
						$page = 1;
					}
					if ( $page > $pageno ) {
	  					$page = $pageno;
					}
					
					$arrayelement = (int)$page;
					$arrayelement --;
					// next page stuff
					if ( $page >= $pageno ) {
						$xoopsTpl->assign('pagenext', _MD_AMR_PAGENEXT);
					} else {
						$next_pagenumber = $page + 1;
						$nextlink = "<a href=\"review.php?id=". intval($_GET['id']) ."&amp;page=" . $next_pagenumber . "\">". _MD_AMR_PAGENEXT ."</a>";
						$xoopsTpl->assign('pagenext', $nextlink);
					}
					// prev page stuff
					if( $page <= 1 ) {
						$xoopsTpl->assign('pageprev', _MD_AMR_PAGEPREV);
					} else {
						$previous_pagenumber = $page -1;
						$prevlink = "<a href=\"review.php?id=". intval($_GET['id']) ."&amp;page=" . $previous_pagenumber . "\">". _MD_AMR_PAGEPREV ."</a>";
						$xoopsTpl->assign('pageprev', $prevlink);
					}

					$xoopsTpl->assign('pagenum', _MD_AMR_PAGENUM);
					$xoopsTpl->assign('pageof', _MD_AMR_PAGEOF);
					$xoopsTpl->assign('pagenumint', $pageno);
					$xoopsTpl->assign('pageofint', $page);

					// switch to show/hide prev/next links
					$xoopsTpl->assign('numpages', $pageno);

					/**
					* Increment views/reads (but not for admin, if set)
					* down in pagination section, so we can tell it to not
					* increment views if not on first page.
					*/
					if ($page <= 1) {
						if (!$xoopsUser OR ($xoopsUser->isAdmin($xoopsModule->mid()) AND  $xoopsModuleConfig['noincrementifadmin'] != 1)) {
							amr_increment_views($myrow['id']);
						}
					}

					
					// pass review data to template.
					$xoopsTpl->assign("review",	$myts->displayTarea($contentpages[$arrayelement], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
				
				
				
			} // while
		} // if
		
		
		



	/**
	* Add custom CSS style sheets and JS.
	*/
	$xoopsTpl->assign("xoops_module_header", "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />\n".
	"<script type=\"text/javascript\" src=\"include/lightbox2/js/prototype.js\"></script>\n".
	"<script type=\"text/javascript\" src=\"include/lightbox2/js/scriptaculous.js?load=effects\"></script>\n".
	"<script type=\"text/javascript\" src=\"include/lightbox2/js/lightbox.js\"></script>\n".
	"<link rel=\"stylesheet\" href=\"include/lightbox2/css/lightbox.css\" type=\"text/css\" media=\"screen\" />");
	
	
	include(XOOPS_ROOT_PATH.'/include/comment_view.php');
	include_once (XOOPS_ROOT_PATH . "/footer.php");
} // end if

#include(XOOPS_ROOT_PATH.'/include/comment_view.php');
include_once("footer.php");
?>