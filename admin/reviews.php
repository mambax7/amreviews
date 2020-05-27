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
$uploadDir  = XOOPS_UPLOAD_PATH . '/amreviews/reviews/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/amreviews/reviews/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton($lang::REVIEWS_LIST, 'reviews.php', 'list');
        $adminObject->displayButton('left');

        $reviewsObject = $reviewsHandler->create();
        $form          = $reviewsObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('reviews.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $reviewsObject = $reviewsHandler->get(Request::getInt('id', 0));
        } else {
            $reviewsObject = $reviewsHandler->create();
        }
        // Form save fields
        $reviewsObject->setVar('uid', Request::getVar('uid', ''));
        $reviewsObject->setVar('catid', Request::getVar('catid', ''));
        $reviewsObject->setVar('weight', Request::getVar('weight', ''));
        $reviewsObject->setVar('title', Request::getVar('title', ''));
        $reviewsObject->setVar('subtitle', Request::getVar('subtitle', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/amreviews/images/';
        $uploader  = new \XoopsMediaUploader(
            $uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null
        );
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {
            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['image_file']).'.'.$extension;

            $uploader->setPrefix('image_file_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $reviewsObject->setVar('image_file', $uploader->getSavedFileName());
            }
        } else {
            $reviewsObject->setVar('image_file', Request::getVar('image_file', ''));
        }

        $reviewsObject->setVar('image_align', Request::getVar('image_align', ''));
        $reviewsObject->setVar('our_rating', Request::getVar('our_rating', ''));
        $reviewsObject->setVar('reviewer_ip', Request::getVar('reviewer_ip', ''));
        $reviewsObject->setVar('teaser', Request::getText('teaser', ''));
        $reviewsObject->setVar('item_details', Request::getText('item_details', ''));
        $reviewsObject->setVar('review', Request::getText('review', ''));
        $reviewsObject->setVar('keywords', Request::getVar('keywords', ''));
        $resDate     = Request::getArray('date', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $reviewsObject->setVar('date', $dateTimeObj->getTimestamp() + $resDate['time']);
        $resDate     = Request::getArray('date_publish', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $reviewsObject->setVar('date_publish', $dateTimeObj->getTimestamp() + $resDate['time']);
        $resDate     = Request::getArray('date_end', [], 'POST');
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $resDate['date']);
        $dateTimeObj->setTime(0, 0, 0);
        $reviewsObject->setVar('date_end', $dateTimeObj->getTimestamp() + $resDate['time']);
        $reviewsObject->setVar('views', Request::getVar('views', ''));
        $reviewsObject->setVar('pagetitle', Request::getVar('pagetitle', ''));
        $reviewsObject->setVar('metaheaders', Request::getVar('metaheaders', ''));
        $reviewsObject->setVar('comments', ((1 == \Xmf\Request::getInt('comments', 0)) ? '1' : '0'));
        $reviewsObject->setVar('notify', ((1 == \Xmf\Request::getInt('notify', 0)) ? '1' : '0'));
        $reviewsObject->setVar('validated', ((1 == \Xmf\Request::getInt('validated', 0)) ? '1' : '0'));
        $reviewsObject->setVar('showme', ((1 == \Xmf\Request::getInt('showme', 0)) ? '1' : '0'));
        $reviewsObject->setVar('highlight', ((1 == \Xmf\Request::getInt('highlight', 0)) ? '1' : '0'));
        $reviewsObject->setVar('nohtml', ((1 == \Xmf\Request::getInt('nohtml', 0)) ? '1' : '0'));
        $reviewsObject->setVar('nosmiley', ((1 == \Xmf\Request::getInt('nosmiley', 0)) ? '1' : '0'));
        $reviewsObject->setVar('noxcode', ((1 == \Xmf\Request::getInt('noxcode', 0)) ? '1' : '0'));
        $reviewsObject->setVar('noimage', ((1 == \Xmf\Request::getInt('noimage', 0)) ? '1' : '0'));
        $reviewsObject->setVar('nobr', ((1 == \Xmf\Request::getInt('nobr', 0)) ? '1' : '0'));
        //Permissions
        //===============================================================

        $mid = $GLOBALS['xoopsModule']->mid();
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = xoops_getHandler('groupperm');
        $id               = \Xmf\Request::getInt('id', 0);

        /**
         * @param $myArray
         * @param $permissionGroup
         * @param $id
         * @param $grouppermHandler
         * @param $permissionName
         * @param $mid
         */
        function setPermissions($myArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid)
        {
            $permissionArray = $myArray;
            if ($id > 0) {
                $sql = 'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name` = '" . $permissionName . "' AND `gperm_itemid`= $id;";
                $GLOBALS['xoopsDB']->query($sql);
            }
            //admin
            $gperm = $grouppermHandler->create();
            $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
            $gperm->setVar('gperm_name', $permissionName);
            $gperm->setVar('gperm_modid', $mid);
            $gperm->setVar('gperm_itemid', $id);
            $grouppermHandler->insert($gperm);
            unset($gperm);
            //non-Admin groups
            if (is_array($permissionArray)) {
                foreach ($permissionArray as $key => $cat_groupperm) {
                    if ($cat_groupperm > 0) {
                        $gperm = $grouppermHandler->create();
                        $gperm->setVar('gperm_groupid', $cat_groupperm);
                        $gperm->setVar('gperm_name', $permissionName);
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $id);
                        $grouppermHandler->insert($gperm);
                        unset($gperm);
                    }
                }
            } elseif ($permissionArray > 0) {
                $gperm = $grouppermHandler->create();
                $gperm->setVar('gperm_groupid', $permissionArray);
                $gperm->setVar('gperm_name', $permissionName);
                $gperm->setVar('gperm_modid', $mid);
                $gperm->setVar('gperm_itemid', $id);
                $grouppermHandler->insert($gperm);
                unset($gperm);
            }
        }

        //setPermissions for View items
        $permissionGroup   = 'groupsRead';
        $permissionName    = 'amreviews_view';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        //setPermissions for Submit items
        $permissionGroup   = 'groupsSubmit';
        $permissionName    = 'amreviews_submit';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        //setPermissions for Approve items
        $permissionGroup   = 'groupsModeration';
        $permissionName    = 'amreviews_approve';
        $permissionArray   = \Xmf\Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $id, $grouppermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $id, $permissionArray);

        /*
                    //Form amreviews_view
                    $arr_amreviews_view = \Xmf\Request::getArray('cat_gperms_read');
                    if ($id > 0) {
                        $sql
                            =
                            'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name`='amreviews_view' AND `gperm_itemid`=$id;";
                        $GLOBALS['xoopsDB']->query($sql);
                    }
                    //admin
                    $gperm = $grouppermHandler->create();
                    $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
                    $gperm->setVar('gperm_name', 'amreviews_view');
                    $gperm->setVar('gperm_modid', $mid);
                    $gperm->setVar('gperm_itemid', $id);
                    $grouppermHandler->insert($gperm);
                    unset($gperm);
                    if (is_array($arr_amreviews_view)) {
                        foreach ($arr_amreviews_view as $key => $cat_groupperm) {
                            $gperm = $grouppermHandler->create();
                            $gperm->setVar('gperm_groupid', $cat_groupperm);
                            $gperm->setVar('gperm_name', 'amreviews_view');
                            $gperm->setVar('gperm_modid', $mid);
                            $gperm->setVar('gperm_itemid', $id);
                            $grouppermHandler->insert($gperm);
                            unset($gperm);
                        }
                    } else {
                        $gperm = $grouppermHandler->create();
                        $gperm->setVar('gperm_groupid', $arr_amreviews_view);
                        $gperm->setVar('gperm_name', 'amreviews_view');
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $id);
                        $grouppermHandler->insert($gperm);
                        unset($gperm);
                    }
        */

        //===============================================================

        if ($reviewsHandler->insert($reviewsObject)) {
            redirect_header('reviews.php?op=list', 2, $lang::FORMOK);
        }

        echo $reviewsObject->getHtmlErrors();
        $form = $reviewsObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton($lang::ADD_REVIEWS, 'reviews.php?op=new', 'add');
        $adminObject->addItemButton($lang::REVIEWS_LIST, 'reviews.php', 'list');
        $adminObject->displayButton('left');
        $reviewsObject = $reviewsHandler->get(Request::getString('id', ''));
        $form          = $reviewsObject->getForm();
        $form->display();
        break;

    case 'delete':
        $reviewsObject = $reviewsHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('reviews.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($reviewsHandler->delete($reviewsObject)) {
                redirect_header('reviews.php', 3, $lang::FORMDELOK);
            } else {
                echo $reviewsObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf($lang::FORMSUREDEL, $reviewsObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('amreviews_reviews', 'id', $id_field)) {
            redirect_header('reviews.php', 3, $lang::CLONED_OK);
        } else {
            redirect_header('reviews.php', 3, $lang::CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton($lang::ADD_REVIEWS, 'reviews.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start                  = \Xmf\Request::getInt('start', 0);
        $reviewsPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($reviewsPaginationLimit);
        $criteria->setStart($start);
        $reviewsTempRows  = $reviewsHandler->getCount();
        $reviewsTempArray = $reviewsHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".$lang::FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($reviewsTempRows > $reviewsPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $reviewsTempRows, $reviewsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('reviewsRows', $reviewsTempRows);
        $reviewsArray = [];

        //    $fields = explode('|', id:int:10::NOT NULL::primary:ID:0|uid:int:10::NOT NULL:0::User:1|catid:int:10::NOT NULL:0::Category:2|weight:int:10::NOT NULL:0::Weight:3|title:varchar:100::NULL:::Title:4|subtitle:varchar:100::NULL:::Subtitle:5|image_file:varchar:100::NULL:::Image:6|image_align:enum:&#039;Left&#039;,&#039;Center&#039;,&#039;Right&#039;::NOT NULL:Left::Alignment:7|our_rating:varchar:5::NOT NULL:0::Rating:8|reviewer_ip:varchar:45::NOT NULL:::IP:9|teaser:text:0::NULL:::Teaser:10|item_details:text:0::NULL:::Details:11|review:text:0::NULL:::Review:12|keywords:text:0::NULL:::Keywords:13|date:int:11:UNSIGNED:NOT NULL:0::Posted:14|date_publish:int:11:UNSIGNED:NOT NULL:0::Published:15|date_end:int:11:UNSIGNED:NOT NULL:0::VisibilityTill:16|views:int:10::NOT NULL:0::Views:17|pagetitle:enum:&#039;None&#039;,&#039;Yes&#039;,&#039;Yes2&#039;::NOT NULL:None::Pagetitle:18|metaheaders:enum:&#039;None&#039;,&#039;Yes&#039;,&#039;Yes2&#039;::NOT NULL:None::Metaheaders:19|comments:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Comments:20|notify:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:0::Notify:21|validated:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:0::Validated:22|showme:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Showme:23|highlight:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:0::Highlight:24|nohtml:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Nohtml:25|nosmiley:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Nosmiley:26|noxcode:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Noxcode:27|noimage:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Noimage:28|nobr:enum:&#039;0&#039;,&#039;1&#039;::NOT NULL:1::Nobr:29);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($reviewsPaginationLimit);
        $criteria->setStart($start);

        $reviewsCount     = $reviewsHandler->getCount($criteria);
        $reviewsTempArray = $reviewsHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($reviewsCount > 0) {
            foreach (array_keys($reviewsTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', $lang::REVIEWS_ID);
                $reviewsArray['id'] = $reviewsTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectoruid', $lang::REVIEWS_UID);
                $reviewsArray['uid'] = strip_tags(\XoopsUser::getUnameFromId($reviewsTempArray[$i]->getVar('uid')));

                $selectorcatid = $utility::selectSorting($lang::REVIEWS_CATID, 'catid');
                $GLOBALS['xoopsTpl']->assign('selectorcatid', $selectorcatid);
                $reviewsArray['catid'] = $catHandler->get($reviewsTempArray[$i]->getVar('catid'))->getVar('title');

                $GLOBALS['xoopsTpl']->assign('selectorweight', $lang::REVIEWS_WEIGHT);
                $reviewsArray['weight'] = $reviewsTempArray[$i]->getVar('weight');

                $GLOBALS['xoopsTpl']->assign('selectortitle', $lang::REVIEWS_TITLE);
                $reviewsArray['title'] = $reviewsTempArray[$i]->getVar('title');
                $reviewsArray['title'] = $utility::truncateHtml($reviewsArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorsubtitle', $lang::REVIEWS_SUBTITLE);
                $reviewsArray['subtitle'] = $reviewsTempArray[$i]->getVar('subtitle');

                $GLOBALS['xoopsTpl']->assign('selectorimage_file', $lang::REVIEWS_IMAGE_FILE);
                $reviewsArray['image_file'] = "<img src='" . $uploadUrl . $reviewsTempArray[$i]->getVar('image_file') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";

                $GLOBALS['xoopsTpl']->assign('selectorimage_align', $lang::REVIEWS_IMAGE_ALIGN);
                $reviewsArray['image_align'] = $reviewsTempArray[$i]->getVar('image_align');

                $selectorour_rating = $utility::selectSorting($lang::REVIEWS_OUR_RATING, 'our_rating');
                $GLOBALS['xoopsTpl']->assign('selectorour_rating', $selectorour_rating);
                $reviewsArray['our_rating'] = $reviewsTempArray[$i]->getVar('our_rating');

                $GLOBALS['xoopsTpl']->assign('selectorreviewer_ip', $lang::REVIEWS_REVIEWER_IP);
                $reviewsArray['reviewer_ip'] = $reviewsTempArray[$i]->getVar('reviewer_ip');

                $GLOBALS['xoopsTpl']->assign('selectorteaser', $lang::REVIEWS_TEASER);
                $reviewsArray['teaser'] = $reviewsTempArray[$i]->getVar('teaser');
                $reviewsArray['teaser'] = $utility::truncateHtml($reviewsArray['teaser'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectoritem_details', $lang::REVIEWS_ITEM_DETAILS);
                $reviewsArray['item_details'] = $reviewsTempArray[$i]->getVar('item_details');
                $reviewsArray['item_details'] = $utility::truncateHtml($reviewsArray['item_details'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorreview', $lang::REVIEWS_REVIEW);
                $reviewsArray['review'] = $reviewsTempArray[$i]->getVar('review');
                $reviewsArray['review'] = $utility::truncateHtml($reviewsArray['review'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectorkeywords', $lang::REVIEWS_KEYWORDS);
                $reviewsArray['keywords'] = strip_tags($reviewsTempArray[$i]->getVar('keywords'));

                $selectordate = $utility::selectSorting($lang::REVIEWS_DATE, 'date');
                $GLOBALS['xoopsTpl']->assign('selectordate', $selectordate);
                $reviewsArray['date'] = formatTimestamp($reviewsTempArray[$i]->getVar('date'), 's');

                $selectordate_publish = $utility::selectSorting($lang::REVIEWS_DATE_PUBLISH, 'date_publish');
                $GLOBALS['xoopsTpl']->assign('selectordate_publish', $selectordate_publish);
                $reviewsArray['date_publish'] = formatTimestamp($reviewsTempArray[$i]->getVar('date_publish'), 's');

                $selectordate_end = $utility::selectSorting($lang::REVIEWS_DATE_END, 'date_end');
                $GLOBALS['xoopsTpl']->assign('selectordate_end', $selectordate_end);
                $reviewsArray['date_end'] = formatTimestamp($reviewsTempArray[$i]->getVar('date_end'), 's');

                $GLOBALS['xoopsTpl']->assign('selectorviews', $lang::REVIEWS_VIEWS);
                $reviewsArray['views'] = $reviewsTempArray[$i]->getVar('views');

                $GLOBALS['xoopsTpl']->assign('selectorpagetitle', $lang::REVIEWS_PAGETITLE);
                $reviewsArray['pagetitle'] = $reviewsTempArray[$i]->getVar('pagetitle');

                $GLOBALS['xoopsTpl']->assign('selectormetaheaders', $lang::REVIEWS_METAHEADERS);
                $reviewsArray['metaheaders'] = $reviewsTempArray[$i]->getVar('metaheaders');

                $GLOBALS['xoopsTpl']->assign('selectorcomments', $lang::REVIEWS_COMMENTS);
                $reviewsArray['comments'] = $reviewsTempArray[$i]->getVar('comments');

                $GLOBALS['xoopsTpl']->assign('selectornotify', $lang::REVIEWS_NOTIFY);
                $reviewsArray['notify'] = $reviewsTempArray[$i]->getVar('notify');

                $GLOBALS['xoopsTpl']->assign('selectorvalidated', $lang::REVIEWS_VALIDATED);
                $reviewsArray['validated'] = $reviewsTempArray[$i]->getVar('validated');

                $GLOBALS['xoopsTpl']->assign('selectorshowme', $lang::REVIEWS_SHOWME);
                $reviewsArray['showme'] = $reviewsTempArray[$i]->getVar('showme');

                $GLOBALS['xoopsTpl']->assign('selectorhighlight', $lang::REVIEWS_HIGHLIGHT);
                $reviewsArray['highlight'] = $reviewsTempArray[$i]->getVar('highlight');

                $GLOBALS['xoopsTpl']->assign('selectornohtml', $lang::REVIEWS_NOHTML);
                $reviewsArray['nohtml'] = $reviewsTempArray[$i]->getVar('nohtml');

                $GLOBALS['xoopsTpl']->assign('selectornosmiley', $lang::REVIEWS_NOSMILEY);
                $reviewsArray['nosmiley'] = $reviewsTempArray[$i]->getVar('nosmiley');

                $GLOBALS['xoopsTpl']->assign('selectornoxcode', $lang::REVIEWS_NOXCODE);
                $reviewsArray['noxcode'] = $reviewsTempArray[$i]->getVar('noxcode');

                $GLOBALS['xoopsTpl']->assign('selectornoimage', $lang::REVIEWS_NOIMAGE);
                $reviewsArray['noimage'] = $reviewsTempArray[$i]->getVar('noimage');

                $GLOBALS['xoopsTpl']->assign('selectornobr', $lang::REVIEWS_NOBR);
                $reviewsArray['nobr']        = $reviewsTempArray[$i]->getVar('nobr');
                $reviewsArray['edit_delete'] = "<a href='reviews.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='reviews.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='reviews.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('reviewsArrays', $reviewsArray);
                unset($reviewsArray);
            }
            unset($reviewsTempArray);
            // Display Navigation
            if ($reviewsCount > $reviewsPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $reviewsCount, $reviewsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            $GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/amreviews_admin_reviews.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
