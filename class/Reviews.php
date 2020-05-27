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
 * Class Reviews
 */
class Reviews extends \XoopsObject
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
        $this->initVar('uid', \XOBJ_DTYPE_INT);
        $this->initVar('catid', \XOBJ_DTYPE_INT);
        $this->initVar('weight', \XOBJ_DTYPE_INT);
        $this->initVar('title', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('subtitle', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('image_file', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('image_align', \XOBJ_DTYPE_ENUM);
        $this->initVar('our_rating', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('reviewer_ip', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('teaser', \XOBJ_DTYPE_OTHER);
        $this->initVar('item_details', \XOBJ_DTYPE_OTHER);
        $this->initVar('review', \XOBJ_DTYPE_OTHER);
        $this->initVar('keywords', \XOBJ_DTYPE_OTHER);
        $this->initVar('date', \XOBJ_DTYPE_INT);
        $this->initVar('date_publish', \XOBJ_DTYPE_INT);
        $this->initVar('date_end', \XOBJ_DTYPE_INT);
        $this->initVar('views', \XOBJ_DTYPE_INT);
        $this->initVar('pagetitle', \XOBJ_DTYPE_ENUM);
        $this->initVar('metaheaders', \XOBJ_DTYPE_ENUM);
        $this->initVar('comments', \XOBJ_DTYPE_ENUM);
        $this->initVar('notify', \XOBJ_DTYPE_ENUM);
        $this->initVar('validated', \XOBJ_DTYPE_ENUM);
        $this->initVar('showme', \XOBJ_DTYPE_ENUM);
        $this->initVar('highlight', \XOBJ_DTYPE_ENUM);
        $this->initVar('nohtml', \XOBJ_DTYPE_ENUM);
        $this->initVar('nosmiley', \XOBJ_DTYPE_ENUM);
        $this->initVar('noxcode', \XOBJ_DTYPE_ENUM);
        $this->initVar('noimage', \XOBJ_DTYPE_ENUM);
        $this->initVar('nobr', \XOBJ_DTYPE_ENUM);
    }

    /**
     * Get form
     *
     * @param null
     * @return Amreviews\Form\ReviewsForm
     */
    public function getForm()
    {
        $form = new Form\ReviewsForm($this);
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

