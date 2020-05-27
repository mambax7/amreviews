<?php

declare(strict_types=1);

namespace XoopsModules\Amreviews\Form;

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
use XoopsModules\Amreviews;

require_once \dirname(\dirname(__DIR__)) . '/include/common.php';

$moduleDirName = \basename(\dirname(\dirname(__DIR__)));
//$helper = Amreviews\Helper::getInstance();
$permHelper = new \Xmf\Module\Helper\Permission();

\xoops_load('XoopsFormLoader');

/**
 * Class CatForm
 */
class CatForm extends \XoopsThemeForm
{
    public $targetObject;
    public $helper;

    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
        $this->helper       = $target->helper;
        $this->targetObject = $target;
        $lang               = $this->helper->getLanguage();

        $title = $this->targetObject->isNew() ? \sprintf($lang::CAT_ADD) : \sprintf($lang::CAT_EDIT);
        parent::__construct($title, 'form', \xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel($lang::CAT_ID, $this->targetObject->getVar('id'), 'id'));
        // Pid
        require_once XOOPS_ROOT_PATH . '/class/tree.php';
        //$catHandler = xoops_getModuleHandler('cat', 'amreviews' );
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $catHandler */
        $catHandler = $this->helper->getHandler('Cat');

        $criteria      = new \CriteriaCompo();
        $categoryArray = $catHandler->getObjects($criteria);
        if (!empty($categoryArray)) {
            $categoryTree = new \XoopsObjectTree($categoryArray, 'id', 'pid');

            // if (Amreviews\Utility::checkVerXoops($GLOBALS['xoopsModule'], '2.5.9')) {
            $catPid = $categoryTree->makeSelectElement('pid', 'title', '--', $this->targetObject->getVar('pid'), true, 0, '', $lang::CAT_PID);
            $this->addElement($catPid);
            //  } else {
            //      $catPid = $categoryTree->makeSelBox( 'pid', 'title','--', $this->targetObject->getVar('pid', 'e' ), true );
            //      $this->addElement( new \XoopsFormLabel ( $lang::CAT_PID, $catPid ) );
            //  }

        }
        // Title
        $this->addElement(new \XoopsFormText($lang::CAT_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
        // Description
        if (\class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'description';
            $editorOptions['value']  = $this->targetObject->getVar('description', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('amreviews_editor', 'amreviews');
            //$this->addElement( new \XoopsFormEditor($lang::CAT_DESCRIPTION, 'description', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor($lang::CAT_DESCRIPTION, $this->helper->getConfig('amreviewsEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($lang::CAT_DESCRIPTION, $this->helper->getConfig('amreviewsEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($lang::CAT_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Weight
        $this->addElement(new \XoopsFormText($lang::CAT_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Showme
        $showme       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('showme');
        $check_showme = new \XoopsFormCheckBox($lang::CAT_SHOWME, 'showme', $showme);
        $check_showme->addOption(1, ' ');
        $this->addElement($check_showme);

        //permissions
        /** @var \XoopsMemberHandler $memberHandler */
        $memberHandler = \xoops_getHandler('member');
        $groupList     = $memberHandler->getGroupList();
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = \xoops_getHandler('groupperm');
        //$fullList = array_keys ($groupList);

        //========================================================================

        $mid            = $GLOBALS['xoopsModule']->mid();
        $groupIdAdmin   = 0;
        $groupNameAdmin = '';

        // create admin checkbox
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN == $groupId) {
                $groupIdAdmin   = $groupId;
                $groupNameAdmin = $groupName;
            }
        }

        $selectPermAdmin = new \XoopsFormCheckBox('', 'admin', XOOPS_GROUP_ADMIN);
        $selectPermAdmin->addOption($groupIdAdmin, $groupNameAdmin);
        $selectPermAdmin->setExtra("disabled='disabled'"); //comment it out, if you want to allow to remove permissions for the admin

        // ********************************************************
        // permission view items
        $cat_gperms_read     = $grouppermHandler->getGroupIds('amreviews_view', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_read = $this->targetObject->isNew() ? '0' : $cat_gperms_read;

        $permsTray = new \XoopsFormElementTray($lang::PERMISSIONS_VIEW, '');

        $selectAllReadCheckbox = new \XoopsFormCheckBox('', 'adminbox1', 1);
        $selectAllReadCheckbox->addOption('allbox', \_AM_SYSTEM_ALL);
        $selectAllReadCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox1\" , \"groupsRead[]\");' ");
        $selectAllReadCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllReadCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_read', $arr_cat_gperms_read);
        //$selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $this->targetObject->getGroupsRead());
        $selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $arr_cat_gperms_read);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission submit item
        $cat_gperms_create     = $grouppermHandler->getGroupIds('amreviews_submit', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_create = $this->targetObject->isNew() ? '0' : $cat_gperms_create;

        $permsTray = new \XoopsFormElementTray($lang::PERMISSIONS_SUBMIT, '');

        $selectAllSubmitCheckbox = new \XoopsFormCheckBox('', 'adminbox2', 1);
        $selectAllSubmitCheckbox->addOption('allbox', \_AM_SYSTEM_ALL);
        $selectAllSubmitCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox2\" , \"groupsSubmit[]\");' ");
        $selectAllSubmitCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllSubmitCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_create', $arr_cat_gperms_create);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsSubmit[]', $arr_cat_gperms_create);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission approve items
        $cat_gperms_admin     = $grouppermHandler->getGroupIds('amreviews_approve', $this->targetObject->getVar('id'), $mid);
        $arr_cat_gperms_admin = $this->targetObject->isNew() ? '0' : $cat_gperms_admin;

        $permsTray = new \XoopsFormElementTray($lang::PERMISSIONS_APPROVE, '');

        $selectAllModerateCheckbox = new \XoopsFormCheckBox('', 'adminbox3', 1);
        $selectAllModerateCheckbox->addOption('allbox', \_AM_SYSTEM_ALL);
        $selectAllModerateCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox3\" , \"groupsModeration[]\");' ");
        $selectAllModerateCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllModerateCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_admin', $arr_cat_gperms_admin);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsModeration[]', $arr_cat_gperms_admin);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId && XOOPS_GROUP_ANONYMOUS != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        //=========================================================================
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', \_SUBMIT, 'submit'));
    }
}
