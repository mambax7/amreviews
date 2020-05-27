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
$uploadDir  = XOOPS_UPLOAD_PATH . '/amreviews/cat/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/amreviews/cat/';

switch ($op) {
    case 'new':
        $adminObject->addItemButton($lang::CAT_LIST, 'cat.php', 'list');
        $adminObject->displayButton('left');

        $catObject = $catHandler->create();
        $form      = $catObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('cat.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 !== \Xmf\Request::getInt('id', 0)) {
            $catObject = $catHandler->get(Request::getInt('id', 0));
        } else {
            $catObject = $catHandler->create();
        }
        // Form save fields
        $catObject->setVar('pid', Request::getVar('pid', ''));
        $catObject->setVar('title', Request::getVar('title', ''));
        $catObject->setVar('description', Request::getText('description', ''));
        $catObject->setVar('weight', Request::getVar('weight', ''));
        $catObject->setVar('showme', ((1 == \Xmf\Request::getInt('showme', 0)) ? '1' : '0'));
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

        if ($catHandler->insert($catObject)) {
            redirect_header('cat.php?op=list', 2, $lang::FORMOK);
        }

        echo $catObject->getHtmlErrors();
        $form = $catObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton($lang::ADD_CAT, 'cat.php?op=new', 'add');
        $adminObject->addItemButton($lang::CAT_LIST, 'cat.php', 'list');
        $adminObject->displayButton('left');
        $catObject = $catHandler->get(Request::getString('id', ''));
        $form      = $catObject->getForm();
        $form->display();
        break;

    case 'delete':
        $catObject = $catHandler->get(Request::getString('id', ''));
        if (1 == \Xmf\Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('cat.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($catHandler->delete($catObject)) {
                redirect_header('cat.php', 3, $lang::FORMDELOK);
            } else {
                echo $catObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete',], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf($lang::FORMSUREDEL, $catObject->getVar('title')));
        }
        break;

    case 'clone':

        $id_field = \Xmf\Request::getString('id', '');

        if ($utility::cloneRecord('amreviews_cat', 'id', $id_field)) {
            redirect_header('cat.php', 3, $lang::CLONED_OK);
        } else {
            redirect_header('cat.php', 3, $lang::CLONED_FAILED);
        }

        break;
    case 'list':
    default:
        $adminObject->addItemButton($lang::ADD_CAT, 'cat.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start              = \Xmf\Request::getInt('start', 0);
        $catPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, title');
        $criteria->setOrder('ASC');
        $criteria->setLimit($catPaginationLimit);
        $criteria->setStart($start);
        $catTempRows  = $catHandler->getCount();
        $catTempArray = $catHandler->getAll($criteria);
        /*
        //
        //
                            <th class='center width5'>".$lang::FORM_ACTION."</th>
        //                    </tr>";
        //            $class = "odd";
        */

        // Display Page Navigation
        if ($catTempRows > $catPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav(
                $catTempRows, $catPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
            );
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('catRows', $catTempRows);
        $catArray = [];

        //    $fields = explode('|', id:int:5::NOT NULL::primary:ID:0|pid:int:5::NOT NULL:0::Parent:1|title:varchar:100::NOT NULL:0::Title:2|description:text:0::NOT NULL:::Description:3|weight:int:5::NOT NULL:0::Weight:4|showme:int:1::NOT NULL:1::showme:5);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($catPaginationLimit);
        $criteria->setStart($start);

        $catCount     = $catHandler->getCount($criteria);
        $catTempArray = $catHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($catCount > 0) {
            foreach (array_keys($catTempArray) as $i) {
                //        $field = explode(':', $fields[$i]);

                $GLOBALS['xoopsTpl']->assign('selectorid', $lang::CAT_ID);
                $catArray['id'] = $catTempArray[$i]->getVar('id');

                $GLOBALS['xoopsTpl']->assign('selectorpid', $lang::CAT_PID);
                $catArray['pid'] = $catTempArray[$i]->getVar('pid');

                $GLOBALS['xoopsTpl']->assign('selectortitle', $lang::CAT_TITLE);
                $catArray['title'] = $catTempArray[$i]->getVar('title');
                $catArray['title'] = $utility::truncateHtml($catArray['title'], $helper->getConfig('truncatelength'));

                $GLOBALS['xoopsTpl']->assign('selectordescription', $lang::CAT_DESCRIPTION);
                $catArray['description'] = $catTempArray[$i]->getVar('description');
                $catArray['description'] = $utility::truncateHtml($catArray['description'], $helper->getConfig('truncatelength'));

                $selectorweight = $utility::selectSorting($lang::CAT_WEIGHT, 'weight');
                $GLOBALS['xoopsTpl']->assign('selectorweight', $selectorweight);
                $catArray['weight'] = $catTempArray[$i]->getVar('weight');

                $GLOBALS['xoopsTpl']->assign('selectorshowme', $lang::CAT_SHOWME);
                $catArray['showme']      = $catTempArray[$i]->getVar('showme');
                $catArray['edit_delete'] = "<a href='cat.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='cat.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='cat.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('catArrays', $catArray);
                unset($catArray);
            }
            unset($catTempArray);
            // Display Navigation
            if ($catCount > $catPaginationLimit) {
                xoops_load('XoopsPageNav');
                $pagenav = new \XoopsPageNav(
                    $catCount, $catPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . ''
                );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            $GLOBALS['xoopsTpl']->assign('dirname', $helper->getDirname());

            echo $GLOBALS['xoopsTpl']->fetch(
                XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/amreviews_admin_cat.tpl'
            );
        }

        break;
}
require __DIR__ . '/admin_footer.php';
