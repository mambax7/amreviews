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

$moduleDirName = \basename(\dirname(__DIR__));

$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class ReviewsHandler
 */
class ReviewsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * Constructor
     * @param null|\XoopsDatabase                 $db
     * @param null|\XoopsModules\Amreviews\Helper $helper
     */

    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
        /** @var \XoopsModules\Amreviews\Helper $this ->helper */
        $this->helper = $helper;
        parent::__construct($db, 'amreviews_reviews', Reviews::class, 'id', 'title');
    }

    /**
     * @param bool $isNew
     *
     * @return \XoopsObject
     */
    public function create($isNew = true)
    {
        $obj         = parent::create($isNew);
        $obj->helper = $this->helper;

        return $obj;
    }
}
