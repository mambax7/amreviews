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

use Xmf\Module\Admin;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
require XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
if ('' != \Xmf\Request::getString('submit', '')) {
    redirect_header(XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->dirname() . '/admin/permissions.php', 1, $lang::PERMISSIONS_GPERMUPDATED);
}
// Check admin have access to this page
/*$group = $GLOBALS['xoopsUser']->getGroups ();
$groups = xoops_getModuleOption ( 'admin_groups', $thisDirname );
if (count ( array_intersect ( $group, $groups ) ) <= 0) {
    redirect_header ( 'index.php', 3, _NOPERM );
}*/
$adminObject->displayNavigation(basename(__FILE__));

$permission                = \Xmf\Request::getInt('permission', 1, 'POST');
$selected                  = ['', '', '', '',];
$selected[$permission - 1] = ' selected';

echo "
<form method='post' name='fselperm' action='permissions.php'>
    <table border=0>
        <tr>
            <td>
                <select name='permission' onChange='document.fselperm.submit()'>
                    <option value='1'" . $selected[0] . '>' . $lang::PERMISSIONS_GLOBAL . "</option>
                    <option value='2'" . $selected[1] . '>' . $lang::PERMISSIONS_APPROVE . "</option>
                    <option value='3'" . $selected[2] . '>' . $lang::PERMISSIONS_SUBMIT . "</option>
                    <option value='4'" . $selected[3] . '>' . $lang::PERMISSIONS_VIEW . '</option>
                </select>
            </td>
        </tr>
    </table>
</form>';

$module_id = $GLOBALS['xoopsModule']->getVar('mid');
switch ($permission) {
    case 1:
        $formTitle   = $lang::PERMISSIONS_GLOBAL;
        $permName    = 'amreviews_ac';
        $permDesc    = $lang::PERMISSIONS_GLOBAL_DESC;
        $globalPerms = [
            '4'  => $lang::PERMISSIONS_GLOBAL_4,
            '8'  => $lang::PERMISSIONS_GLOBAL_8,
            '16' => $lang::PERMISSIONS_GLOBAL_16,
        ];
        break;
    case 2:
        $formTitle = $lang::PERMISSIONS_APPROVE;
        $permName  = 'amreviews_approve';
        $permDesc  = $lang::PERMISSIONS_APPROVE_DESC;
        break;
    case 3:
        $formTitle = $lang::PERMISSIONS_SUBMIT;
        $permName  = 'amreviews_submit';
        $permDesc  = $lang::PERMISSIONS_SUBMIT_DESC;
        break;
    case 4:
        $formTitle = $lang::PERMISSIONS_VIEW;
        $permName  = 'amreviews_view';
        $permDesc  = $lang::PERMISSIONS_VIEW_DESC;
        break;
}

$permform = new \XoopsGroupPermForm($formTitle, $module_id, $permName, $permDesc, 'admin/permissions.php');
if (1 == $permission) {
    foreach ($globalPerms as $perm_id => $perm_name) {
        $permform->addItem($perm_id, $perm_name);
    }
    echo $permform->render();
    echo '<br><br>';
} else {
    $criteria = new \CriteriaCompo();
    $criteria->setSort('title');
    $criteria->setOrder('ASC');
    $cat_count = $catHandler->getCount($criteria);
    $catArray  = $catHandler->getObjects($criteria);
    unset($criteria);
    foreach (array_keys($catArray) as $i) {
        $permform->addItem($catArray[$i]->getVar('id'), $catArray[$i]->getVar('title'));
    }
    // Check if cat exist before rendering the form and redirect, if there aren't cat
    if ($cat_count > 0) {
        echo $permform->render();
        echo '<br><br>';
    } else {
        redirect_header('cat.php?op=new', 3, $lang::PERMISSIONS_NOPERMSSET);
        //exit ();
    }
}
unset($permform);
require __DIR__ . '/admin_footer.php';
