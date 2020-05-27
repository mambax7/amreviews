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

use XoopsModules\Amreviews\Helper;

/**
 * CommentsUpdate
 *
 * @param mixed $itemId
 * @param mixed $commentCount
 * @return bool
 */
function amreviewsCommentsUpdate($itemId, $commentCount)
{
    /** @var Helper $helper */
    $helper = Helper::getInstance();
    /** @var \XoopsPersistableObjectHandler $helper ->getHandler('Rate') */
    if (!$helper->getHandler('Rate')->updateAll('comments', (int)$commentCount, new \Criteria('lid', (int)$itemId))) {
        return false;
    }
    return true;
}

/**
 * CommentsApprove
 *
 * @param string $comment
 * @return bool
 */
function amreviewsCommentsApprove($comment)
{
    // Notification event
    // Get instance of module
    $helper = Helper::getInstance();
    $reviewsHandler = $helper->getHandler('Reviews');
    $id             = $comment->getVar('id');
    $reviewsObj     = $reviewsHandler->get($id);
    $title          = $reviewsObj->getVar('title');

    $tags              = [];
    $tags['ITEM_NAME'] = $title;
    //    $tags['ITEM_URL']    = XOOPS_URL . '/modules/amreviews/review.php?op=view&id=' . $id;
    $tags['ITEM_URL']    = XOOPS_URL . '/modules/amreviews/review.php?id=' . $id;
    $notificationHandler = xoops_getHandler('notification');
    // Event modify notification
    $notificationHandler->triggerEvent('global', 0, 'global_comment', $tags);
    $notificationHandler->triggerEvent('review', $id, 'review_comment', $tags);
    return true;
}
