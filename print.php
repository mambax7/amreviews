<?php
// $Id: print.php,v 1.2 2007/01/24 19:24:32 andrew Exp $
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
require __DIR__ . '/include/setup.php';
include_once 'header.php';
require_once(XOOPS_ROOT_PATH . '/class/template.php');

//
$myts = MyTextSanitizer::getInstance();

# add permissions and stuff

//----------------------------------------------------------------------------//
// Default page view
if (isset($_REQUEST['id'])) {

    //$xoopsOption['template_main']= "amr_index.tpl";
    #include (XOOPS_ROOT_PATH . "/header.php");

    $xoopsTpl = new XoopsTpl();
    global $xoopsModule, $myts;

    $sql    = ('SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE (date_publish='0' OR " . time() . " > date_publish) AND (date_end='0' OR " . time() . " < date_end) AND validated='1' AND showme='1' AND id = '" . (int)($_GET['id']) . "'");
    $result = $GLOBALS['xoopsDB']->query($sql);

    if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
        while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {
            $reviewtext = str_replace('[pagebreak]', '', $myrow['review']);

            $xoopsTpl->assign('id', $myrow['id']);
            $xoopsTpl->assign('title', $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0));
            $xoopsTpl->assign('subtitle', $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0));
            $xoopsTpl->assign('item_details', $myts->displayTarea($myrow['item_details'], 1, 1, 1, 1, 1));
            #$xoopsTpl->assign("review",    $myts->displayTarea($myrow['review'], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
            $xoopsTpl->assign('review', $myts->displayTarea($reviewtext, $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
            $xoopsTpl->assign('date', formatTimestamp(strtotime($myrow['date']), $xoopsModuleConfig['dateformatprint']));

            /**
             * Get image thumbnail image. Gets path from prefs, splits
             * main filename, and adds "_hl" to help make filename for
             * highlight image in review listing.
             */
            //$imgFileName  = explode(".", $myrow['image_file']);
            $xoopsTpl->assign('photopath', $xoopsModuleConfig['photopath']);
            $xoopsTpl->assign('imagefilename', $myrow['image_file']);

            /**
             * Get "our rating" info and image.
             * our_rating
             */
            $baserate   = $myrow['our_rating'];
            $ourRateIMG = 'star-' . $baserate . '.' . _AM_AMR_RATESTAREXT;
            if ($baserate === 0) {
                $staralt = constant($mainLang . '_STARALTNORATE');
            }
            $our_rating = "<img src=\"" . XOOPS_URL . '/modules/' . _AM_AMRMODDIR . '/assets/images/' . $ourRateIMG . "\" alt=\"" . constant($mainLang . '_STARALTNORATE') . "\" title=\"" . constant($mainLang . '_STARALTNORATE') . "\">";
            $xoopsTpl->assign('our_rating', $our_rating);

            /**
             * Whether or not to show "Reviewed by info", and get
             * info.
             * showreviewedby
             */
            if ($xoopsModuleConfig['showreviewedby'] === 1) {
                // later add realname option - http://www.xoops.org/misc/api/kernel/XoopsUser.html#getUnameFromId
                $xoopsTpl->assign('reviewer_name', XoopsUser::getUnameFromId($myrow['uid'], 0));
                $xoopsTpl->assign('reviewer_uid', $myrow['uid']);
                $xoopsTpl->assign('reviewer_show', 1);
            }
        } // while
    } // if

    /**
     * Get public rating
     */
    // match IP address to see if voted already.
    #$voted=@mysql_fetch_assoc(@mysql_query("SELECT title FROM $tableName WHERE used_ips LIKE '%".$_SERVER['REMOTE_ADDR']."%' AND id='$id' "));
    $result = $GLOBALS['xoopsDB']->query('SELECT id FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_rate') . " WHERE rate_user_ip LIKE '%" . $_SERVER['REMOTE_ADDR'] . "%' AND rate_review_id = '" . $myrow['id'] . "'");
    list($voted) = $GLOBALS['xoopsDB']->fetchRow($result);

    $temp        = XoopsRequest::getInt('id', 0, 'GET');
    $userRatings = $utilities->getUserRating($GLOBALS['xoopsDB'], $temp);
    //print_r ($userRatings);

    $xoopsTpl->assign('user_rating', $userRatings['rate']);
    $xoopsTpl->assign('user_rating_star', $userRatings['rate'] * 12); // for stars state
    $xoopsTpl->assign('user_votes', $userRatings['votes']);

    /**
     * General assigns.
     */
    $xoopsTpl->assign('gen_on', constant($mainLang . '_GENON')); //
    $xoopsTpl->assign('mod_dir', _AM_AMRMODDIR);
    $xoopsTpl->assign('reviewedBy', constant($mainLang . '_PRINTAUTHOR'));
    $xoopsTpl->assign('publishedOn', constant($mainLang . '_PRINTPUBBY'));
    $xoopsTpl->assign('publishedBy', $GLOBALS['xoopsConfig']['sitename']);
    $xoopsTpl->assign('our_ratingcap', constant($mainLang . '_OURRATECAP'));
    $xoopsTpl->assign('user_ratingcap', constant($mainLang . '_USERRATECAP'));
    $xoopsTpl->assign('itemDetailscap', constant($mainLang . '_DETAILSCAP'));

    //echo "Sorry, not yet implemented.";

    /// Display template.
    $xoopsTpl->display('db:amr_print.tpl');
} // end function

//----------------------------------------------------------------------------//
