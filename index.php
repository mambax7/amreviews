<?php
// $Id: index.php,v 1.4 2006/05/02 01:59:56 andrew Exp $
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
//include_once(XOOPS_ROOT_PATH . "/class/xoopstree.php");

//
$myts =& MyTextSanitizer::getInstance();
//$mytree = new XoopsTree($GLOBALS['xoopsDB']->prefix("amreview_cat"),"id","cat_parentid");
$gperm_handler =& xoops_gethandler('groupperm');

//----------------------------------------------------------------------------//
// Default page view
if (!isset($_REQUEST['op'])) {
    $xoopsOption['template_main'] = 'amr_index.tpl';
    include(XOOPS_ROOT_PATH . '/header.php');

    /**
     * General assigns.
     */
    $xoopsTpl->assign('gen_on', constant($mainLang . '_GENON')); //
    $xoopsTpl->assign('reviewed_by', constant($mainLang . '_REVIEWEDBY'));
    $xoopsTpl->assign('mod_dir', AMREVIEW_DIRNAME);

    /**
     * Set column count default
     */
    $colcount = 1;

    /**
     * Change SQL query as per if ID is set, if it's not, we want parent_id to be
     * 0 (when we only want to show top level categories, no id is set at this
     * point).
     */
    $sqlquery = " WHERE cat_showme='1' AND cat_parentid = '0'";
    if (isset($_GET['id'])) {
        $sqlquery = "WHERE cat_parentid = '" . (int)($_GET['id']) . "' AND cat_showme='1' ";
        //echo $sqlquery;
    }

    /**
     * Start category view in directory mode.
     * Note: look into adding review count into mysql join.
     */
    $sql    = ('SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . ' ' . $sqlquery . '');
    $result = $GLOBALS['xoopsDB']->query($sql);

    if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
        while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {
            $amr_cat              = array();
            $amr_cat['id']        = $myrow['id'];
            $amr_cat['cat_title'] = $myts->displayTarea($myrow['cat_title']);
            //$amr_cat['rev_count'] = $utilities->getReviewCount($myrow['id']);

            //TEST
            //            if (isset($myrow['id'])) {
            //                $temp1 = $utilities->getReviewCount($myrow['id']);
            //                $temp2 = $utilities->getRowCount('amreviews_reviews', 'id', 'catid', 'int', $myrow['id']);
            //            }
            /**
             * Create switch to start new row.
             */
            if ($colcount === $xoopsModuleConfig['indexcolumns']) { //$amr_catcols) {
                $amr_cat['newrow'] = 1;
                $colcount          = 0;
            }
            ++$colcount;

            /**
             * Get subcatagories (non-recursive)
             * amr_getGetsubcats
             */
            if ($xoopsModuleConfig['showsubcats'] === 1) {
                $amr_cat['subcatsswitch'] = 1;
                $amr_cat['subcats'] = $utilities->getSubcats($myrow['id']);
            }

            $xoopsTpl->append('categories', $amr_cat);
            unset($amr_cat);
        } // end while
    } // end if
    else {
        // Echo "No cat" error message
    }

    /**
     * Get breadcrumbs - possibly put in function later.
     */
    $catid = 0;
    if (isset($_GET['id'])) {
        $catid = (int)($_GET['id']);
    }
    //$cat_path = "<a href=\"index.php\">" . constant($mainLang . '_NAVBCTOP') . "</a>&nbsp;&#187;&nbsp;";
    //$cat_path .= $mytree->getNicePathFromId($catid, "cat_title", "index.php?t=");

    $cat_path  = $utilities->getCategoryPath($xoopsModule->getVar('name'), $catid, 'cat_title', 'index.php?t=', '&#187;', 'amreviews_cat', 'id', 'cat_parentid');
    $xoopsTpl->assign('category_path', $cat_path);

    /**
     * Do review listing if "id" (for category) is set, list
     * reviews for that category - if any.
     */
    if (isset($_GET['id'])) {
        /**
         * Deal with category permissions.
         */
        $groups = XOOPS_GROUP_ANONYMOUS;
        if ($GLOBALS['xoopsUser']) {
            $groups = $GLOBALS['xoopsUser']->getGroups();
        }

        // (int)($_GET['category_id']) - $xoopsModule->getVar('mid')
        if ($gperm_handler->checkRight('Category Permission', (int)($_GET['id']), $groups, $xoopsModule->getVar('mid'))) {
            // allowed, so display contents within the category
            //echo "hello";
        } else {
            // not allowed, display an error message or redirect to another page
            redirect_header(XOOPS_URL . "/user.php", 3, constant($mainLang . '_NOPERMCATMSG'));
        }

        /**
         * Start category view in directory mode.
         * Note: look into adding review count into mysql join.
         * Add pagination.
         */
        // TEMP NOTE - see news module, class/class.newsstory.php line 137
        // Watch start date when adding...
        $sql = ('SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE (date_publish='0' OR " . time() . " > date_publish) AND (date_end='0' OR " . time() . " < date_end) AND validated='1' AND showme='1' AND catid='" . (int)($_GET['id']) . "' ORDER BY date DESC");
        //" WHERE (date_publish > 0 AND date_publish <= '". time() ."') AND (date_end = 0 OR date_end > '". time() ."')"); //AND id='" . (int)($_GET['id']) . "'");
        $result = $GLOBALS['xoopsDB']->query($sql);

        if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
            while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {
                $amr_reviews           = array();
                $amr_reviews['id']     = $myrow['id'];
                $amr_reviews['title']  = $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0);
                $amr_reviews['teaser'] = $myts->displayTarea($myrow['teaser'], 1, 1, 1, 1, 1);
                $amr_reviews['date']   = formatTimestamp(strtotime($myrow['date']), $xoopsModuleConfig['indxlistdatefrmt']);

                /**
                 * Get image highlight image. Gets path from prefs, splits
                 * main filename, and adds "_hl" to help make filename for
                 * highlight image in review listing.
                 */
                //$imgFileName  = explode(".", $myrow['image_file']);
                //$amr_reviews['highlight'] = $amr_photodir . "/highlight/" . $imgFileName['0'] . "." . $imgFileName['1'];
                $amr_reviews['photopath']     = $xoopsModuleConfig['photopath'];
                $amr_reviews['imagefilename'] = $myrow['image_file'];
                //$xoopsTpl->assign("thumbnail", $amr_photodir . "/thumb/" . $imgFileName['0'] . "." . $imgFileName['1']);

                /**
                 * Align image left or right.
                 */
                if ($myrow['image_align'] === 'L') {
                    $amr_reviews['imageAlign'] = 'left';
                } else {
                    $amr_reviews['imageAlign'] = 'right';
                }

                /**
                 * Whether or not to show "Reviewed by info", and get
                 * info.
                 * showreviewedby
                 */
                if ($xoopsModuleConfig['showreviewedby'] === 1) {
                    // later add realname option - http://www.xoops.org/misc/api/kernel/XoopsUser.html#getUnameFromId
                    $amr_reviews['reviewer_name'] = XoopsUser::getUnameFromId($myrow['uid'], 0);
                    $amr_reviews['reviewer_uid']  = $myrow['uid'];
                    $amr_reviews['reviewer_show'] = 1;
                }

                $xoopsTpl->append('reviews', $amr_reviews);
                unset($amr_reviews);
            } // while
        } // end if
        else {
            $xoopsTpl->assign('noreviews', 1);
            $xoopsTpl->assign('noreviewscap', constant($mainLang . '_NOREVIEWCAP'));
        }
    } // end if

    /**
     * Add custom CSS style sheet.
     */
    $xoopsTpl->assign('xoops_module_header', '<link rel="stylesheet" type="text/css" href="assets/css/style.css" />');
    include_once(XOOPS_ROOT_PATH . '/footer.php');
} // end if

include_once __DIR__ . '/footer.php';
