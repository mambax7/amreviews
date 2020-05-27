<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: Amreviews
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 */

use XoopsModules\Amreviews;
use XoopsModules\Amreviews\Helper;
use Xmf\Request;

require __DIR__ . '/header.php';

$op = \Xmf\Request::getCmd('op', 'list');

if ('edit' !== $op) {
    if ('view' === $op) {
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_reviews.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_reviews_list0.tpl';
    }
}
require_once XOOPS_ROOT_PATH . '/header.php';

global $xoTheme;

$start = \Xmf\Request::getInt('start', 0);
// Define Stylesheet
/** @var xos_opal_Theme $xoTheme */
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $reviewsHandler */
$reviewsHandler = $helper->getHandler('Reviews');

$reviewsPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($reviewsPaginationLimit);
$criteria->setStart($start);

$reviewsCount = $reviewsHandler->getCount($criteria);
$reviewsArray = $reviewsHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $reviewsObject = $reviewsHandler->get(Request::getString('id', ''));
        $form          = $reviewsObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $reviewsPaginationLimit = 1;
        $myid                   = $id;
        //id
        $reviewsObject = $reviewsHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($reviewsPaginationLimit);
        $criteria->setStart($start);
        $reviews['id']  = $reviewsObject->getVar('id');
        $reviews['uid'] = strip_tags(\XoopsUser::getUnameFromId($reviewsObject->getVar('uid')));
        $reviews['catid']        = $catHandler->get($reviewsObject->getVar('catid'))->getVar('title');
        $reviews['weight']       = $reviewsObject->getVar('weight');
        $reviews['title']        = $reviewsObject->getVar('title');
        $reviews['subtitle']     = $reviewsObject->getVar('subtitle');
        $reviews['image_file']   = $reviewsObject->getVar('image_file');
        $reviews['image_align']  = $reviewsObject->getVar('image_align');
        $reviews['our_rating']   = $reviewsObject->getVar('our_rating');
        $reviews['reviewer_ip']  = $reviewsObject->getVar('reviewer_ip');
        $reviews['teaser']       = $reviewsObject->getVar('teaser');
        $reviews['item_details'] = $reviewsObject->getVar('item_details');
        $reviews['review']       = $reviewsObject->getVar('review');
        $reviews['keywords']     = strip_tags($reviewsObject->getVar('keywords'));
        $reviews['date']         = formatTimestamp($reviewsObject->getVar('date'), 's');
        $reviews['date_publish'] = formatTimestamp($reviewsObject->getVar('date_publish'), 's');
        $reviews['date_end']     = formatTimestamp($reviewsObject->getVar('date_end'), 's');
        $reviews['views']        = $reviewsObject->getVar('views');
        $reviews['pagetitle']    = $reviewsObject->getVar('pagetitle');
        $reviews['metaheaders']  = $reviewsObject->getVar('metaheaders');
        $reviews['comments']     = $reviewsObject->getVar('comments');
        $reviews['notify']       = $reviewsObject->getVar('notify');
        $reviews['validated']    = $reviewsObject->getVar('validated');
        $reviews['showme']       = $reviewsObject->getVar('showme');
        $reviews['highlight']    = $reviewsObject->getVar('highlight');
        $reviews['nohtml']       = $reviewsObject->getVar('nohtml');
        $reviews['nosmiley']     = $reviewsObject->getVar('nosmiley');
        $reviews['noxcode']      = $reviewsObject->getVar('noxcode');
        $reviews['noimage']      = $reviewsObject->getVar('noimage');
        $reviews['nobr']         = $reviewsObject->getVar('nobr');

        //       $GLOBALS['xoopsTpl']->append('reviews', $reviews);
        $keywords[] = $reviewsObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('reviews', $reviews);
        $start = $id;

        // Display Navigation
        if ($reviewsCount > $reviewsPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url( 'reviews.php'));
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($reviewsCount, $reviewsPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($reviewsCount > 0) {
            $GLOBALS['xoopsTpl']->assign('reviews', []);
            foreach (array_keys($reviewsArray) as $i) {
                $reviews['id']  = $reviewsArray[$i]->getVar('id');
                $reviews['uid'] = strip_tags(\XoopsUser::getUnameFromId($reviewsArray[$i]->getVar('uid')));
                $reviews['catid']        = $catHandler->get($reviewsArray[$i]->getVar('catid'))->getVar('title');
                $reviews['weight']       = $reviewsArray[$i]->getVar('weight');
                $reviews['title']        = $reviewsArray[$i]->getVar('title');
                $reviews['title']        = $utility::truncateHtml($reviews['title'], $helper->getConfig('truncatelength'));
                $reviews['subtitle']     = $reviewsArray[$i]->getVar('subtitle');
                $reviews['image_file']   = $reviewsArray[$i]->getVar('image_file');
                $reviews['image_align']  = $reviewsArray[$i]->getVar('image_align');
                $reviews['our_rating']   = $reviewsArray[$i]->getVar('our_rating');
                $reviews['reviewer_ip']  = $reviewsArray[$i]->getVar('reviewer_ip');
                $reviews['teaser']       = $reviewsArray[$i]->getVar('teaser');
                $reviews['teaser']       = $utility::truncateHtml($reviews['teaser'], $helper->getConfig('truncatelength'));
                $reviews['item_details'] = $reviewsArray[$i]->getVar('item_details');
                $reviews['item_details'] = $utility::truncateHtml($reviews['item_details'], $helper->getConfig('truncatelength'));
                $reviews['review']       = $reviewsArray[$i]->getVar('review');
                $reviews['review']       = $utility::truncateHtml($reviews['review'], $helper->getConfig('truncatelength'));
                $reviews['keywords']     = strip_tags($reviewsArray[$i]->getVar('keywords'));
                $reviews['date']         = formatTimestamp($reviewsArray[$i]->getVar('date'), 's');
                $reviews['date_publish'] = formatTimestamp($reviewsArray[$i]->getVar('date_publish'), 's');
                $reviews['date_end']     = formatTimestamp($reviewsArray[$i]->getVar('date_end'), 's');
                $reviews['views']        = $reviewsArray[$i]->getVar('views');
                $reviews['pagetitle']    = $reviewsArray[$i]->getVar('pagetitle');
                $reviews['metaheaders']  = $reviewsArray[$i]->getVar('metaheaders');
                $reviews['comments']     = $reviewsArray[$i]->getVar('comments');
                $reviews['notify']       = $reviewsArray[$i]->getVar('notify');
                $reviews['validated']    = $reviewsArray[$i]->getVar('validated');
                $reviews['showme']       = $reviewsArray[$i]->getVar('showme');
                $reviews['highlight']    = $reviewsArray[$i]->getVar('highlight');
                $reviews['nohtml']       = $reviewsArray[$i]->getVar('nohtml');
                $reviews['nosmiley']     = $reviewsArray[$i]->getVar('nosmiley');
                $reviews['noxcode']      = $reviewsArray[$i]->getVar('noxcode');
                $reviews['noimage']      = $reviewsArray[$i]->getVar('noimage');
                $reviews['nobr']         = $reviewsArray[$i]->getVar('nobr');
                $GLOBALS['xoopsTpl']->append('reviews', $reviews);
                $keywords[] = $reviewsArray[$i]->getVar('title');
                unset($reviews);
            }
            // Display Navigation
            if ($reviewsCount > $reviewsPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('reviews.php'));
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($reviewsCount, $reviewsPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription($lang::REVIEWS_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url( 'reviews.php'));
$GLOBALS['xoopsTpl']->assign('amreviews_url', $helper->url());
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', $lang::ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

$GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

require_once XOOPS_ROOT_PATH . '/include/comment_view.php';

require __DIR__ . '/footer.php';
