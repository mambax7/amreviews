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

use Xmf\Request;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = \Xmf\Request::getString('op', 'list');
$order = \Xmf\Request::getString('order', 'desc');
$sort  = \Xmf\Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var \Xmf\Module\Helper\Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir  = XOOPS_UPLOAD_PATH . '/amreviews/rate/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/amreviews/rate/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton($lang::RATE_LIST, 'rate.php', 'list');
        $adminObject->displayButton('left');

        $rateObject = $rateHandler->create();
        $form       = $rateObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('rate.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $rateObject = $rateHandler->get(Request::getInt('id', 0));
        } else {
            $rateObject = $rateHandler->create();
        }
        // Form save fields
        $rateObject->setVar('review_id', Request::getVar('review_id', ''));
        $rateObject->setVar('rating', Request::getVar('rating', ''));
        $rateObject->setVar('uid', Request::getVar('uid', ''));
        $rateObject->setVar('user_ip', Request::getVar('user_ip', ''));
        $rateObject->setVar('user_browser', Request::getVar('user_browser', ''));
        $rateObject->setVar('title', Request::getVar('title', ''));
        $rateObject->setVar('text', Request::getText('text', ''));
        $resDate     = Request::getArray('date_created', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $rateObject->setVar('date_created', $dateTimeObj->getTimestamp() + $resDate['time']);
        $rateObject->setVar('showme', ((1 == \Xmf\Request::getInt('showme', 0)) ? '1' : '0'));
        $rateObject->setVar('validated', ((1 == \Xmf\Request::getInt('validated', 0)) ? '1' : '0'));
        $rateObject->setVar('useful', Request::getVar('useful', ''));
        if ($rateHandler->insert($rateObject)) {
            redirect_header('rate.php?op=list', 2, $lang::FORMOK);
        }

        echo $rateObject->getHtmlErrors();
        $form = $rateObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton($lang::ADD_RATE, 'rate.php?op=new', 'add');
        $adminObject->addItemButton($lang::RATE_LIST, 'rate.php', 'list');
        $adminObject->displayButton('left');
        $rateObject = $rateHandler->get(Request::getString('id', ''));
        $form       = $rateObject->getForm();
        $form->display();
        break;

    case 'delete':
        $rateObject = $rateHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('rate.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($rateHandler->delete($rateObject)) {
                redirect_header('rate.php', 3, $lang::FORMDELOK);
            } else {
                echo $rateObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf($lang::FORMSUREDEL, $rateObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('amreviews_rate', 'id', $id_field)) {
            redirect_header('rate.php', 3, $lang::CLONED_OK);
        } else {
            redirect_header('rate.php', 3, $lang::CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton($lang::ADD_RATE, 'rate.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start               = \Xmf\Request::getInt('start', 0);
        $ratePaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($ratePaginationLimit);
        $criteria->setStart($start);
        $rateTempRows  = $rateHandler->getCount();
        $rateTempArray = $rateHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".$lang::FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($rateTempRows > $ratePaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $rateTempRows, $ratePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('rateRows', $rateTempRows);
        $rateArray = [];

        //    $fields = explode('|', id:int:5::NOT NULL::primary:ID:0|review_id:int:5::NOT NULL:0::Review:1|rating:int:5::NOT NULL:0::Rating:2|uid:int:10::NOT NULL:0::User:3|user_ip:varchar:45::NOT NULL:0::IP:4|user_browser:varchar:50::NOT NULL:0::Browser:5|title:varchar:100::NOT NULL:0::Title:6|text:text:0::NOT NULL:::Text:7|date_created:int:11:UNSIGNED:NOT NULL:0::Created:8|showme:tinyint:1::NOT NULL:1::Showme:9|validated:tinyint:1::NOT NULL:0::Validated:10|useful:varchar:20::NOT NULL:0/0::Useful:11);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($ratePaginationLimit);
        $criteria->setStart($start);

        $rateCount     = $rateHandler->getCount($criteria);
        $rateTempArray = $rateHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($rateCount > 0) {
            foreach (array_keys($rateTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', $lang::RATE_ID);
                $rateArray['id'] = $rateTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorreview_id', $lang::RATE_REVIEW_ID);
                $rateArray['review_id'] = $reviewsHandler->get($rateTempArray[$i]->getVar('review_id'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectorrating', $lang::RATE_RATING);
                $rateArray['rating'] = $rateTempArray[$i]->getVar('rating');

                $GLOBALS['xoopsTpl']->assign('selectoruid', $lang::RATE_UID);
                $rateArray['uid'] = strip_tags(\XoopsUser::getUnameFromId($rateTempArray[$i]->getVar('uid')));

                $GLOBALS['xoopsTpl']->assign('selectoruser_ip', $lang::RATE_USER_IP);
                $rateArray['user_ip'] = $rateTempArray[$i]->getVar('user_ip');

                $GLOBALS['xoopsTpl']->assign('selectoruser_browser', $lang::RATE_USER_BROWSER);
                $rateArray['user_browser'] = $rateTempArray[$i]->getVar('user_browser');

                $GLOBALS['xoopsTpl']->assign('selectortitle', $lang::RATE_TITLE);
                $rateArray['title'] = $rateTempArray[$i]->getVar('title');
                $rateArray['title'] = $utility::truncateHtml($rateArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectortext', $lang::RATE_TEXT);
                $rateArray['text'] = $rateTempArray[$i]->getVar('text');
                $rateArray['text'] = $utility::truncateHtml($rateArray['text'], $helper->getConfig('truncatelength'));

                $selectordate_created = $utility::selectSorting($lang::RATE_DATE_CREATED, 'date_created');
                $GLOBALS['xoopsTpl']->assign('selectordate_created', $selectordate_created);
                $rateArray['date_created'] = formatTimestamp($rateTempArray[$i]->getVar('date_created'), 's');

                $GLOBALS['xoopsTpl']->assign('selectorshowme', $lang::RATE_SHOWME);
                $rateArray['showme'] = $rateTempArray[$i]->getVar('showme');

                $GLOBALS['xoopsTpl']->assign('selectorvalidated', $lang::RATE_VALIDATED);
                $rateArray['validated'] = $rateTempArray[$i]->getVar('validated');

                $GLOBALS['xoopsTpl']->assign('selectoruseful', $lang::RATE_USEFUL);
                $rateArray['useful']      = $rateTempArray[$i]->getVar('useful');
                $rateArray['edit_delete'] = "<a href='rate.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='rate.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='rate.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('rateArrays', $rateArray);
                unset($rateArray);
            }
            unset($rateTempArray);
            // Display Navigation
            if ($rateCount > $ratePaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $rateCount, $ratePaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            $GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/amreviews_admin_rate.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
