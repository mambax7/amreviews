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
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_cat.tpl';
    } else {
        $GLOBALS['xoopsOption']['template_main'] = 'amreviews_cat_list0.tpl';
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
/** @var \XoopsPersistableObjectHandler $catHandler */
$catHandler = $helper->getHandler('Cat');

$catPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($catPaginationLimit);
$criteria->setStart($start);

$catCount = $catHandler->getCount($criteria);
$catArray = $catHandler->getAll($criteria);

$id = \Xmf\Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'edit':
        $catObject = $catHandler->get(Request::getString('id', ''));
        $form      = $catObject->getForm();
        $form->display();
        break;

    case 'view':
        //        viewItem();
        $catPaginationLimit = 1;
        $myid               = $id;
        //id
        $catObject = $catHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($catPaginationLimit);
        $criteria->setStart($start);
        $cat['id']          = $catObject->getVar('id');
        $cat['pid']         = $catObject->getVar('pid');
        $cat['title']       = $catObject->getVar('title');
        $cat['description'] = $catObject->getVar('description');
        $cat['weight']      = $catObject->getVar('weight');
        $cat['showme']      = $catObject->getVar('showme');

        //       $GLOBALS['xoopsTpl']->append('cat', $cat);
        $keywords[] = $catObject->getVar('title');

        $GLOBALS['xoopsTpl']->assign('cat', $cat);
        $start = $id;

        // Display Navigation
        if ($catCount > $catPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url( 'cat.php'));
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($catCount, $catPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();

        if ($catCount > 0) {
            $GLOBALS['xoopsTpl']->assign('cat', []);
            foreach (array_keys($catArray) as $i) {
                $cat['id']          = $catArray[$i]->getVar('id');
                $cat['pid']         = $catArray[$i]->getVar('pid');
                $cat['title']       = $catArray[$i]->getVar('title');
                $cat['title']       = $utility::truncateHtml($cat['title'], $helper->getConfig('truncatelength'));
                $cat['description'] = $catArray[$i]->getVar('description');
                $cat['description'] = $utility::truncateHtml($cat['description'], $helper->getConfig('truncatelength'));
                $cat['weight']      = $catArray[$i]->getVar('weight');
                $cat['showme']      = $catArray[$i]->getVar('showme');
                $GLOBALS['xoopsTpl']->append('cat', $cat);
                $keywords[] = $catArray[$i]->getVar('title');
                unset($cat);
            }
            // Display Navigation
            if ($catCount > $catPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url('cat.php'));
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav($catCount, $catPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords($helper->getConfig('keywords') . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription($lang::CAT_DESC);

$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', $helper->url( 'cat.php'));
$GLOBALS['xoopsTpl']->assign('amreviews_url', $helper->url());
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));

$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));

$GLOBALS['xoopsTpl']->assign('admin', $lang::ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

$GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

require_once XOOPS_ROOT_PATH . '/include/comment_view.php';

require __DIR__ . '/footer.php';
