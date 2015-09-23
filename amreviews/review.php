<?php
// $Id: review.php,v 1.5 2007/01/24 19:24:32 andrew Exp $
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
//include_once __DIR__ . '/class/psr4/setuploader.php';
require __DIR__ . '/include/setup.php';
include_once 'header.php';
//include_once(XOOPS_ROOT_PATH . '/class/xoopstree.php');

//
$myts =& MyTextSanitizer::getInstance();
//$mytree = new XoopsTree($GLOBALS['xoopsDB']->prefix('amreview_cat'),'id','cat_parentid');

//----------------------------------------------------------------------------//
// Default page view
if (isset($_REQUEST['id'])) {
    $xoopsOption['template_main'] = 'amr_review.tpl';
    include(XOOPS_ROOT_PATH . '/header.php');

    /**
     * General assigns.
     */
    $xoopsTpl->assign('gen_on', constant($mainLang . '_GENON')); //
    $xoopsTpl->assign('reviewed_by', constant($mainLang . '_REVIEWEDBY'));
    //constant($mainLang . '_SUBTTLCAP') // Subtitle caption.
    $xoopsTpl->assign('our_ratingcap', constant($mainLang . '_OURRATECAP'));
    $xoopsTpl->assign('user_ratingcap', constant($mainLang . '_USERRATECAP'));
    $xoopsTpl->assign('mod_dir', AMREVIEW_DIRNAME);
    $xoopsTpl->assign('itemDetailscap', constant($mainLang . '_DETAILSCAP'));
    $xoopsTpl->assign('backcap', constant($mainLang . '_BACKCAP'));
    $xoopsTpl->assign('printcap', constant($mainLang . '_PRINTCAP'));
    $xoopsTpl->assign('emailcap', constant($mainLang . '_EMAILCAP'));
    $xoopsTpl->assign('pdfcap', constant($mainLang . '_PDFCAP'));
    $xoopsTpl->assign('rsscap', constant($mainLang . '_RSSCAP'));
    $xoopsTpl->assign('editcap', constant($mainLang . '_EDITCAP'));
    $xoopsTpl->assign('deletecap', constant($mainLang . '_DELETECAP'));
    $xoopsTpl->assign('readscap', constant($mainLang . '_READCAP'));

    /**
     * Settings assigns
     */
    $xoopsTpl->assign('print_switch', $xoopsModuleConfig['showprint']);
    $xoopsTpl->assign('email_switch', $xoopsModuleConfig['allowemail']);
    $xoopsTpl->assign('pdf_switch', $xoopsModuleConfig['allowpdf']);
    $xoopsTpl->assign('hiliteimg_switch', $xoopsModuleConfig['hiliteimg']);

    /**
     * If admin...
     */
    // admin link
    if ($GLOBALS['xoopsUser'] && $GLOBALS['xoopsUser']->isAdmin($xoopsModule->mid())) {
        $xoopsTpl->assign('isadmin', '1');
    }

    /**
     * Start category view in directory mode.
     * Note: look into adding review count into mysql join.
     * Add pagination.
     */
    $sql    = ('SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE (date_publish='0' OR " . time() . " > date_publish) AND (date_end='0' OR " . time() . " < date_end) AND validated='1' AND showme='1' AND id = '" . (int)($_GET['id']) . "'");
    $result = $GLOBALS['xoopsDB']->query($sql);

    if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
        while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {
            $xoopsTpl->assign('id', $myrow['id']);
            $xoopsTpl->assign('title', $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0));
            $xoopsTpl->assign('item_details', $myts->displayTarea($myrow['item_details'], 1, 1, 1, 1, 1));
            //$xoopsTpl->assign('review',   $myts->displayTarea($myrow['review'], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
            $xoopsTpl->assign('date', formatTimestamp(strtotime($myrow['date']), $xoopsModuleConfig['dateformat']));
            $xoopsTpl->assign('views', $myrow['views']);

            /**
             * If there's a subtitle, display it.
             */
            if ($myrow['subtitle'] !== null) {
                $xoopsTpl->assign('subtitle', $myts->displayTarea($myrow['subtitle']));
                $xoopsTpl->assign('showsubtitle', 1);
            }

            /**
             * Switch comments on/off for review
             */
            $xoopsTpl->assign('allowcomments', $myrow['comments']);

            /**
             * Get image thumbnail image. Gets path from prefs, splits
             * main filename, and adds '_hl' to help make filename for
             * highlight image in review listing.
             */
            //$imgFileName  = explode('.', $myrow['image_file']);
            $xoopsTpl->assign('photopath', $xoopsModuleConfig['photopath']);
            $xoopsTpl->assign('imagefilename', $myrow['image_file']);
            //$xoopsTpl->assign("thumbnail", $amr_photodir . "/thumb/" . $imgFileName['0'] . "." . $imgFileName['1']);

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

            /**
             * Get "our rating" info and image.
             * our_rating
             */
            $baserate   = $myrow['our_rating'];
            $ourRateIMG = 'star-' . $baserate . '.' . _AM_AMR_RATESTAREXT;
            if ($baserate === 0) {
                $staralt = constant($mainLang . '_STARALTNORATE');
            }
            $our_rating = "<img src=\"" . XOOPS_URL . '/modules/' . AMREVIEW_DIRNAME . '/assets/images/' . $ourRateIMG . "\" alt=\"" . constant($mainLang . '_STARALTNORATE') . "\" title=\"" . constant($mainLang . '_STARALTNORATE') . "\">";
            $xoopsTpl->assign('our_rating', $our_rating);

            /**
             * Get public rating
             */
            // match IP address to see if voted already.
            #$voted=@mysql_fetch_assoc(@mysql_query("SELECT title FROM $tableName WHERE used_ips LIKE '%".$_SERVER['REMOTE_ADDR']."%' AND id='$id' "));
            $result = $GLOBALS['xoopsDB']->query('SELECT id FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_rate') . " WHERE rate_user_ip LIKE '%" . $_SERVER['REMOTE_ADDR'] . "%' AND rate_review_id = '" . $myrow['id'] . "'");
            list($voted) = $GLOBALS['xoopsDB']->fetchRow($result);

            #echo $voted;
            if ($voted) { // match
                $xoopsTpl->assign('voted', 1);
            } else { // no match
                $xoopsTpl->assign('voted', 0);
            }

            #$userRatings = $ratingsHandler->getRating((int)($_GET['id']));
            //print_r($userRatings);

            #$xoopsTpl->assign("imgFileName", "star-" . $userRatings['imgNum'] . "." . _AM_AMR_RATESTAREXT);
            #$xoopsTpl->assign("imgALT", sprintf(constant($mainLang . '_USERRATEALT'), $userRatings['rating'], $userRatings['rates']));

            $utilities   = new Xoopsmodules\amreviews\Utilities($db);
            $temp        = XoopsRequest::getInt('id', 0, 'GET');
            $userRatings = $utilities->getUserRating($GLOBALS['xoopsDB'], $temp);
            //print_r ($userRatings);

            $xoopsTpl->assign('user_rating', $userRatings['rate']);
            $xoopsTpl->assign('user_rating_star', $userRatings['rate'] * 12); // for stars state
            $xoopsTpl->assign('user_votes', $userRatings['votes']);

            /**
             * Get breadcrumbs - possibly put in function later.
             */
            //if (isset($_GET['id'])) { $catid = (int)($_GET['id']); }
            //  else { $catid = 0; }
            //$cat_path = "<a href=\"index.php\">" . constant($mainLang . '_NAVBCTOP') . "</a>&nbsp;&#187;&nbsp;";
            //$cat_path .= $mytree->getNicePathFromId($myrow['catid'], "cat_title", "index.php?t=");
            $utilities = new Xoopsmodules\amreviews\Utilities($db);
            $cat_path  = $utilities->getCategoryPath($xoopsModule->getVar('name'), $myrow['catid'], 'cat_title', 'index.php?t=', '&#187;', 'amreviews_cat', 'id', 'cat_parentid'); // constant($mainLang . '_NAVBCTOP
            $xoopsTpl->assign('category_path', $cat_path);

            /**
             * add custom title to page title
             */
            if ($myrow['pagetitle'] === 1) {
                $xoopsTpl->assign('xoops_pagetitle', $xoopsModule->getVar('name') . ' - ' . $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0)); // module name - article title
            }
            if ($myrow['pagetitle'] === 2) {
                $xoopsTpl->assign('xoops_pagetitle', $myts->displayTarea($myrow['title'], 0, 0, 0, 0, 0) . ' - ' . $xoopsModule->getVar('name')); // article title -  module name
            }

            /**
             * Swap meta keywords for own
             */
            if ($myrow['metaheaders'] === 1) {
                $xoopsTpl->assign('xoops_meta_keywords', $myts->displayTarea($myrow['keywords'], 0, 0, 0, 0, 0));
            }

            /**
             * Do pagination where [pagebreak] is used.
             *
             */

            $page = '';
            $page = XoopsRequest::getInt('page', 0, 'GET');

            //$content = $myrow['art_article_text'];

            $contentpages = explode('[pagebreak]', $myrow['review']);
            $pageno       = count($contentpages);
            /* Define the current page  */
            if ($page === '' || $page < 1) {
                $page = 1;
            }
            if ($page > $pageno) {
                $page = $pageno;
            }

            $arrayelement = (int)$page;
            $arrayelement--;
            // next page stuff
            if ($page >= $pageno) {
                $xoopsTpl->assign('pagenext', constant($mainLang . '_PAGENEXT'));
            } else {
                $next_pagenumber = $page + 1;
                $nextlink        = "<a href=\"review.php?id=" . (int)($_GET['id']) . '&amp;page=' . $next_pagenumber . "\">" . constant($mainLang . '_PAGENEXT') . '</a>';
                $xoopsTpl->assign('pagenext', $nextlink);
            }
            // prev page stuff
            if ($page <= 1) {
                $xoopsTpl->assign('pageprev', constant($mainLang . '_PAGEPREV'));
            } else {
                $previous_pagenumber = $page - 1;
                $prevlink            = "<a href=\"review.php?id=" . (int)($_GET['id']) . '&amp;page=' . $previous_pagenumber . "\">" . constant($mainLang . '_PAGEPREV') . '</a>';
                $xoopsTpl->assign('pageprev', $prevlink);
            }

            $xoopsTpl->assign('pagenum', constant($mainLang . '_PAGENUM'));
            $xoopsTpl->assign('pageof', constant($mainLang . '_PAGEOF'));
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
                if (!$GLOBALS['xoopsUser'] || ($GLOBALS['xoopsUser']->isAdmin($xoopsModule->mid()) && $xoopsModuleConfig['noincrementifadmin'] !== 1)) {
                    $utilities = new Xoopsmodules\amreviews\Utilities($db);
                    $utilities->incrementViews($myrow['id']);
                }
            }

            // pass review data to template.
            $xoopsTpl->assign('review', $myts->displayTarea($contentpages[$arrayelement], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']));
        } // while
    } // if

    /**
     * Add custom CSS style sheets and JS.
     */
    $xoopsTpl->assign('xoops_module_header', "<link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/style.css\" />\n" . "<script type=\"text/javascript\" src=\"assets/js/lightbox2/js/prototype.js\"></script>\n" . "<script type=\"text/javascript\" src=\"assets/js/lightbox2/js/scriptaculous.js?load=effects\"></script>\n" . "<script type=\"text/javascript\" src=\"assets/js/lightbox2/js/lightbox.js\"></script>\n" . "<link rel=\"stylesheet\" href=\"assets/js/lightbox2/css/lightbox.css\" type=\"text/css\" media=\"screen\" />");

    include(XOOPS_ROOT_PATH . '/include/comment_view.php');
    include_once(XOOPS_ROOT_PATH . '/footer.php');
} // end if

#include(XOOPS_ROOT_PATH.'/include/comment_view.php');
include_once 'footer.php';
