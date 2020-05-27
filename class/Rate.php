<?php

declare(strict_types=1);

namespace XoopsModules\Amreviews;

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
use XoopsModules\Amreviews\Form;

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Rate
 */
class Rate extends \XoopsObject
{
    public $helper, $permHelper;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        //        /** @var  Amreviews\Helper $helper */
        //        $this->helper = Amreviews\Helper::getInstance();
        $this->permHelper = new \Xmf\Module\Helper\Permission();

        $this->initVar('id', \XOBJ_DTYPE_INT);
        $this->initVar('review_id', \XOBJ_DTYPE_INT);
        $this->initVar('rating', \XOBJ_DTYPE_INT);
        $this->initVar('uid', \XOBJ_DTYPE_INT);
        $this->initVar('user_ip', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('user_browser', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('title', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('text', \XOBJ_DTYPE_OTHER);
        $this->initVar('date_created', \XOBJ_DTYPE_INT);
        $this->initVar('showme', \XOBJ_DTYPE_INT);
        $this->initVar('validated', \XOBJ_DTYPE_INT);
        $this->initVar('useful', \XOBJ_DTYPE_TXTBOX);
    }

    /**
     * Get form
     *
     * @param null
     * @return Amreviews\Form\RateForm
     */
    public function getForm()
    {
        $form = new Form\RateForm($this);
        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('id'));
    }
}

