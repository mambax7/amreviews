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
 * Class ReviewsForm
 */
class ReviewsForm extends \XoopsThemeForm
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

        $lang = $this->helper->getLanguage();

        $title = $this->targetObject->isNew() ? \sprintf($lang::REVIEWS_ADD) : \sprintf($lang::REVIEWS_EDIT);
        parent::__construct($title, 'form', \xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel($lang::REVIEWS_ID, $this->targetObject->getVar('id'), 'id'));
        // Uid
        $this->addElement(new \XoopsFormSelectUser($lang::REVIEWS_UID, 'uid', false, $this->targetObject->getVar('uid'), 1, false), false);
        // Catid


        $cat_id_select = new \XoopsFormSelect($lang::REVIEWS_CATID, 'catid', $this->targetObject->getVar('catid'));
        $cat_id_select->addOptionArray($catHandler->getList());
        $this->addElement($cat_id_select, false);
        // Weight
        $this->addElement(new \XoopsFormText($lang::REVIEWS_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Title
        $this->addElement(new \XoopsFormText($lang::REVIEWS_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
        // Subtitle
        $this->addElement(new \XoopsFormText($lang::REVIEWS_SUBTITLE, 'subtitle', 50, 255, $this->targetObject->getVar('subtitle')), false);
        // Image_file
        $image_file = $this->targetObject->getVar('image_file') ?: 'blank.png';

        $uploadDir   = '/uploads/amreviews/images/';
        $imgtray     = new \XoopsFormElementTray($lang::REVIEWS_IMAGE_FILE, '<br>');
        $imgpath     = \sprintf($lang::FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'image_file', $image_file);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption($image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_image_file\", \"image_file\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $image_file . "' name='image_image_file' id='image_image_file' alt='' style='max-width:300px' >"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile($lang::FORMUPLOAD, 'image_file', $this->helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Image_align
        $image_align  = new \XoopsFormSelect($lang::REVIEWS_IMAGE_ALIGN, 'image_align', $this->targetObject->getVar('image_align'));
        $optionsArray = Amreviews\Utility::enumerate('amreviews_reviews', 'image_align');
        if (!\is_array($optionsArray)) {
            throw new \RuntimeException($optionsArray . ' must be an array.');
        }
        foreach ($optionsArray as $enum) {
            $image_align->addOption($enum, (\defined($enum) ? \constant($enum) : $enum));
        }
        $this->addElement($image_align, false);
        // Our_rating
        $this->addElement(new \XoopsFormText($lang::REVIEWS_OUR_RATING, 'our_rating', 50, 255, $this->targetObject->getVar('our_rating')), false);
        // Reviewer_ip
        $this->addElement(new \XoopsFormText($lang::REVIEWS_REVIEWER_IP, 'reviewer_ip', 50, 255, $this->targetObject->getVar('reviewer_ip')), false);
        // Teaser
        if (\class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'teaser';
            $editorOptions['value']  = $this->targetObject->getVar('teaser', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('amreviews_editor', 'amreviews');
            //$this->addElement( new \XoopsFormEditor($lang::REVIEWS_TEASER, 'teaser', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_TEASER, $this->helper->getConfig('amreviewsEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_TEASER, $this->helper->getConfig('amreviewsEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($lang::REVIEWS_TEASER, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Item_details
        if (\class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'item_details';
            $editorOptions['value']  = $this->targetObject->getVar('item_details', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('amreviews_editor', 'amreviews');
            //$this->addElement( new \XoopsFormEditor($lang::REVIEWS_ITEM_DETAILS, 'item_details', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_ITEM_DETAILS, $this->helper->getConfig('amreviewsEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_ITEM_DETAILS, $this->helper->getConfig('amreviewsEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($lang::REVIEWS_ITEM_DETAILS, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Review
        if (\class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'review';
            $editorOptions['value']  = $this->targetObject->getVar('review', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('amreviews_editor', 'amreviews');
            //$this->addElement( new \XoopsFormEditor($lang::REVIEWS_REVIEW, 'review', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_REVIEW, $this->helper->getConfig('amreviewsEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($lang::REVIEWS_REVIEW, $this->helper->getConfig('amreviewsEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($lang::REVIEWS_REVIEW, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Keywords
        $this->addElement(new \XoopsFormTextArea($lang::REVIEWS_KEYWORDS, 'keywords', $this->targetObject->getVar('keywords'), 4, 47), false);
        // Date
        $this->addElement(new \XoopsFormDateTime($lang::REVIEWS_DATE, 'date', 0, $this->targetObject->getVar('date')));
        // Date_publish
        $this->addElement(new \XoopsFormDateTime($lang::REVIEWS_DATE_PUBLISH, 'date_publish', 0, $this->targetObject->getVar('date_publish')));
        // Date_end
        $this->addElement(new \XoopsFormDateTime($lang::REVIEWS_DATE_END, 'date_end', 0, $this->targetObject->getVar('date_end')));
        // Views
        $this->addElement(new \XoopsFormText($lang::REVIEWS_VIEWS, 'views', 50, 255, $this->targetObject->getVar('views')), false);
        // Pagetitle
        $pagetitle    = new \XoopsFormSelect($lang::REVIEWS_PAGETITLE, 'pagetitle', $this->targetObject->getVar('pagetitle'));
        $optionsArray = Amreviews\Utility::enumerate('amreviews_reviews', 'pagetitle');
        if (!\is_array($optionsArray)) {
            throw new \RuntimeException($optionsArray . ' must be an array.');
        }
        foreach ($optionsArray as $enum) {
            $pagetitle->addOption($enum, (\defined($enum) ? \constant($enum) : $enum));
        }
        $this->addElement($pagetitle, false);
        // Metaheaders
        $metaheaders  = new \XoopsFormSelect($lang::REVIEWS_METAHEADERS, 'metaheaders', $this->targetObject->getVar('metaheaders'));
        $optionsArray = Amreviews\Utility::enumerate('amreviews_reviews', 'metaheaders');
        if (!\is_array($optionsArray)) {
            throw new \RuntimeException($optionsArray . ' must be an array.');
        }
        foreach ($optionsArray as $enum) {
            $metaheaders->addOption($enum, (\defined($enum) ? \constant($enum) : $enum));
        }
        $this->addElement($metaheaders, false);
        // Comments
        $comments       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('comments');
        $check_comments = new \XoopsFormCheckBox($lang::REVIEWS_COMMENTS, 'comments', $comments);
        $check_comments->addOption(1, ' ');
        $this->addElement($check_comments);
        // Notify
        $notify       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('notify');
        $check_notify = new \XoopsFormCheckBox($lang::REVIEWS_NOTIFY, 'notify', $notify);
        $check_notify->addOption(1, ' ');
        $this->addElement($check_notify);
        // Validated
        $validated       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('validated');
        $check_validated = new \XoopsFormCheckBox($lang::REVIEWS_VALIDATED, 'validated', $validated);
        $check_validated->addOption(1, ' ');
        $this->addElement($check_validated);
        // Showme
        $showme       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('showme');
        $check_showme = new \XoopsFormCheckBox($lang::REVIEWS_SHOWME, 'showme', $showme);
        $check_showme->addOption(1, ' ');
        $this->addElement($check_showme);
        // Highlight
        $highlight       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('highlight');
        $check_highlight = new \XoopsFormCheckBox($lang::REVIEWS_HIGHLIGHT, 'highlight', $highlight);
        $check_highlight->addOption(1, ' ');
        $this->addElement($check_highlight);
        // Nohtml
        $nohtml       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('nohtml');
        $check_nohtml = new \XoopsFormCheckBox($lang::REVIEWS_NOHTML, 'nohtml', $nohtml);
        $check_nohtml->addOption(1, ' ');
        $this->addElement($check_nohtml);
        // Nosmiley
        $nosmiley       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('nosmiley');
        $check_nosmiley = new \XoopsFormCheckBox($lang::REVIEWS_NOSMILEY, 'nosmiley', $nosmiley);
        $check_nosmiley->addOption(1, ' ');
        $this->addElement($check_nosmiley);
        // Noxcode
        $noxcode       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('noxcode');
        $check_noxcode = new \XoopsFormCheckBox($lang::REVIEWS_NOXCODE, 'noxcode', $noxcode);
        $check_noxcode->addOption(1, ' ');
        $this->addElement($check_noxcode);
        // Noimage
        $noimage       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('noimage');
        $check_noimage = new \XoopsFormCheckBox($lang::REVIEWS_NOIMAGE, 'noimage', $noimage);
        $check_noimage->addOption(1, ' ');
        $this->addElement($check_noimage);
        // Nobr
        $nobr       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('nobr');
        $check_nobr = new \XoopsFormCheckBox($lang::REVIEWS_NOBR, 'nobr', $nobr);
        $check_nobr->addOption(1, ' ');
        $this->addElement($check_nobr);

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
