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
 * Class RateForm
 */
class RateForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? \sprintf($lang::RATE_ADD) : \sprintf($lang::RATE_EDIT);
        parent::__construct($title, 'form', \xoops_getenv('SCRIPT_NAME'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel($lang::RATE_ID, $this->targetObject->getVar('id'), 'id'));
        // Review_id
        //$reviewsHandler = $this->helper->getHandler('Reviews');
        //$db     = \XoopsDatabaseFactory::getDatabaseConnection();
        /** @var \XoopsPersistableObjectHandler $reviewsHandler */
        $reviewsHandler = $this->helper->getHandler('Reviews');

        $reviews_id_select = new \XoopsFormSelect($lang::RATE_REVIEW_ID, 'review_id', $this->targetObject->getVar('review_id'));
        $reviews_id_select->addOptionArray($reviewsHandler->getList());
        $this->addElement($reviews_id_select, false);
        // Rating
        $this->addElement(new \XoopsFormText($lang::RATE_RATING, 'rating', 50, 255, $this->targetObject->getVar('rating')), false);
        // Uid
        $this->addElement(new \XoopsFormSelectUser($lang::RATE_UID, 'uid', false, $this->targetObject->getVar('uid'), 1, false), false);
        // User_ip
        $this->addElement(new \XoopsFormText($lang::RATE_USER_IP, 'user_ip', 50, 255, $this->targetObject->getVar('user_ip')), false);
        // User_browser
        $this->addElement(new \XoopsFormText($lang::RATE_USER_BROWSER, 'user_browser', 50, 255, $this->targetObject->getVar('user_browser')), false);
        // Title
        $this->addElement(new \XoopsFormText($lang::RATE_TITLE, 'title', 50, 255, $this->targetObject->getVar('title')), false);
        // Text
        if (\class_exists('XoopsFormEditor')) {
            $editorOptions           = [];
            $editorOptions['name']   = 'text';
            $editorOptions['value']  = $this->targetObject->getVar('text', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('amreviews_editor', 'amreviews');
            //$this->addElement( new \XoopsFormEditor($lang::RATE_TEXT, 'text', $editorOptions), false  );
            if ($this->helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor($lang::RATE_TEXT, $this->helper->getConfig('amreviewsEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($lang::RATE_TEXT, $this->helper->getConfig('amreviewsEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($lang::RATE_TEXT, 'description', $this->targetObject->getVar('description', 'e'), 5, 50);
        }
        $this->addElement($descEditor);
        // Date_created
        $this->addElement(new \XoopsFormDateTime($lang::RATE_DATE_CREATED, 'date_created', 0, $this->targetObject->getVar('date_created')));
        // Showme
        $showme       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('showme');
        $check_showme = new \XoopsFormCheckBox($lang::RATE_SHOWME, 'showme', $showme);
        $check_showme->addOption(1, ' ');
        $this->addElement($check_showme);
        // Validated
        $validated       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('validated');
        $check_validated = new \XoopsFormCheckBox($lang::RATE_VALIDATED, 'validated', $validated);
        $check_validated->addOption(1, ' ');
        $this->addElement($check_validated);
        // Useful
        $this->addElement(new \XoopsFormText($lang::RATE_USEFUL, 'useful', 50, 255, $this->targetObject->getVar('useful')), false);

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', \_SUBMIT, 'submit'));
    }
}
