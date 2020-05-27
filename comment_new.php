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
use XoopsModules\Amreviews;

require dirname(dirname(__DIR__)) . '/mainfile.php';
//require XOOPS_ROOT_PATH.'/modules/amreviews/class/rate.php';
$itemid = \Xmf\Request::getInt('id', 0);
if ($itemid > 0) {
    /** @var \XoopsPersistableObjectHandler $reviewsHandler */
    $reviewsHandler = $helper->getHandler('Reviews');

    $review         = $reviewsHandler->get($itemid);
    $com_replytitle = $review->getVar('title');
    require XOOPS_ROOT_PATH . '/include/comment_new.php';
}
