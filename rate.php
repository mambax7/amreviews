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
use Xmf\Request;

require __DIR__ . '/header.php';

$op = \Xmf\Request::getCmd('op', 'list');

if ('edit' !== $op) {
    if ('view' === $op) {
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_rate.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_rate_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $rateHandler */
$rateHandler = $helper->getHandler('Rate');

$ratePaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($ratePaginationLimit);
$criteria->setStart($start);

$rateCount = $rateHandler->getCount($criteria);
$rateArray = $rateHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $rateObject = $rateHandler->get(Request::getString('id', ''));
        $form       = $rateObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $ratePaginationLimit = 1;
        $myid                = $id;
        //id
        $rateObject = $rateHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($ratePaginationLimit);
        $criteria->setStart($start);
        $rate['id'] = $rateObject->getVar('id');
        $rate['review_id']    = $reviewsHandler->get($rateObject->getVar('review_id'))->getVar('title');
        $rate['rating']       = $rateObject->getVar('rating');
        $rate['uid']          = strip_tags(\XoopsUser::getUnameFromId($rateObject->getVar('uid')));
        $rate['user_ip']      = $rateObject->getVar('user_ip');
        $rate['user_browser'] = $rateObject->getVar('user_browser');
        $rate['title']        = $rateObject->getVar('title');
        $rate['text']         = $rateObject->getVar('text');
        $rate['date_created'] = formatTimestamp($rateObject->getVar('date_created'), 's');
        $rate['showme']       = $rateObject->getVar('showme');
        $rate['validated']    = $rateObject->getVar('validated');
        $rate['useful']       = $rateObject->getVar('useful');

        //       $GLOBALS['xoopsTpl']->append('rate', $rate);
        $keywords[] = $rateObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('rate', $rate);
        $start = $id;

        // Display Navigation
        if ($rateCount > $ratePaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('rate.php'));
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($rateCount, $ratePaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($rateCount > 0) {
            $GLOBALS['xoopsTpl']->assign('rate', []);
            foreach (array_keys($rateArray) as $i) {
                $rate['id'] = $rateArray[$i]->getVar('id');
                $rate['review_id']    = $reviewsHandler->get($rateArray[$i]->getVar('review_id'))->getVar('title');
                $rate['rating']       = $rateArray[$i]->getVar('rating');
                $rate['uid']          = strip_tags(\XoopsUser::getUnameFromId($rateArray[$i]->getVar('uid')));
                $rate['user_ip']      = $rateArray[$i]->getVar('user_ip');
                $rate['user_browser'] = $rateArray[$i]->getVar('user_browser');
                $rate['title']        = $rateArray[$i]->getVar('title');
                $rate['title']        = $utility::truncateHtml($rate['title'], $helper->getConfig('truncatelength'));
                $rate['text']         = $rateArray[$i]->getVar('text');
                $rate['text']         = $utility::truncateHtml($rate['text'], $helper->getConfig('truncatelength'));
                $rate['date_created'] = formatTimestamp($rateArray[$i]->getVar('date_created'), 's');
                $rate['showme']       = $rateArray[$i]->getVar('showme');
                $rate['validated']    = $rateArray[$i]->getVar('validated');
                $rate['useful']       = $rateArray[$i]->getVar('useful');
                $GLOBALS['xoopsTpl']->append('rate', $rate);
                $keywords[] = $rateArray[$i]->getVar('title');
                unset($rate);
            }
            // Display Navigation
            if ($rateCount > $ratePaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('rate.php'));
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($rateCount, $ratePaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription($lang::RATE_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('rate.php'));
$GLOBALS['xoopsTpl']->assign('amreviews_url', $helper->url());
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', $lang::ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
$GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

require_once XOOPS_ROOT_PATH . '/include/comment_view.php';

require __DIR__ . '/footer.php';
