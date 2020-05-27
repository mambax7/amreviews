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

use XoopsModules\Amreviews;
use XoopsModules\Amreviews\Helper;

/**
 * @param $options
 *
 * @return array
 */
function showAmreviewsReviews($options)
{
    // require dirname(__DIR__) . '/class/reviews.php';
    ///  $moduleDirName = basename(dirname(__DIR__));
    //$myts = \MyTextSanitizer::getInstance();

    $block        = [];
    $blockType    = $options[0];
    $reviewsCount = $options[1];
    //$titleLenght = $options[2];

    /** @var Helper $helper */
    if (!class_exists(Helper::class)) {
        return false;
    }

    $helper = Helper::getInstance();

    /** @var \XoopsPersistableObjectHandler $reviewsHandler */
    $reviewsHandler = $helper->getHandler('Reviews');
    $criteria       = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if ($blockType) {
        $criteria->add(new \Criteria('id', 0, '!='));
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($reviewsCount);
    $reviewsArray = $reviewsHandler->getAll($criteria);
    foreach (array_keys($reviewsArray) as $i) {
    }

    return $block;
}

/**
 * @param $options
 *
 * @return string
 */
function editAmreviewsReviews($options)
{
    //require dirname(__DIR__) . '/class/reviews.php';
    // $moduleDirName = basename(dirname(__DIR__));

    /** @var Helper $helper */
    $helper = Helper::getInstance();
    $lang   = $helper->getLanguage();
    
    $form = $lang::DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' >";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' >&nbsp;<br>";
    $form .= $lang::TITLELENGTH . " : <input name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' type='text' ><br><br>";


    /** @var \XoopsPersistableObjectHandler $reviewsHandler */
    $reviewsHandler = $helper->getHandler('Reviews');

    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new \Criteria('id', 0, '!='));
    $criteria->setSort('id');
    $criteria->setOrder('ASC');
    $reviewsArray = $reviewsHandler->getAll($criteria);
    $form         .= $lang::CATTODISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form         .= "<option value='0' " . (false === in_array(0, $options) ? '' : "selected='selected'") . '>' . $lang::ALLCAT . '</option>';
    foreach (array_keys($reviewsArray) as $i) {
        $id   = $reviewsArray[$i]->getVar('id');
        $form .= "<option value='" . $id . "' " . (false === in_array($id, $options) ? '' : "selected='selected'") . '>' . $reviewsArray[$i]->getVar('title') . '</option>';
    }
    $form .= '</select>';

    return $form;
}