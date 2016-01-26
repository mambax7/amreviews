<?php namespace Xoopsmodules\amreviews;

/**
 * Created by PhpStorm.
 * User: mamba
 * Date: 2015-07-06
 * Time: 11:26
 */
class Summary
{
    private $db;

    /**
     * @param $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $this->db = $db;
    }

    public static function getSummary()
    {
        $summaryArray = array();

        // amreview_reviews - amreview_cat - amreview_rate

        /**
         * As many of these will be "joined" at some point.
         */

        /**
         * Review count (total)
         */
        $result = $GLOBALS['xoopsDB']->query('SELECT COUNT(id) AS revcount FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . ' ');
        list($revcount) = $GLOBALS['xoopsDB']->fetchRow($result);// {

        if (!$result) {
            $summary['revcount'] = 0;
        } else {
            $summary['revcount'] = $revcount;
        }

        /**
         * Waiting validation.
         */
        $result2 = $GLOBALS['xoopsDB']->query('SELECT COUNT(id) AS waitval FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE validated='0'");
        list($waitval) = $GLOBALS['xoopsDB']->fetchRow($result2);// {

        if ($waitval < 1) {
            $summary['waitval'] = '<span style=\'font-weight: bold;\'>0</span>';
        } else {
            $summary['waitval'] = '<span style=\'font-weight: bold; color: red;\'>' . $waitval . '</span>';
        }

        /**
         * Category count (total)
         */
        $result = $GLOBALS['xoopsDB']->query('SELECT COUNT(id) AS catcount FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_cat') . ' ');
        list($catcount) = $GLOBALS['xoopsDB']->fetchRow($result);// {

        if (!$result) {
            $summary['catcount'] = 0;
        } else {
            $summary['catcount'] = $catcount;
        }
        unset($result);

        /**
         * Views count (total)
         */
        $result = $GLOBALS['xoopsDB']->query('SELECT SUM(views) AS views FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . ' ');
        list($views) = $GLOBALS['xoopsDB']->fetchRow($result);// {

        if (!$result) {
            $summary['views'] = 0;
        } else {
            $summary['views'] = $views;
        }
        unset($result);

        /**
         * Published (total)
         */
        $result = $GLOBALS['xoopsDB']->query('SELECT count(id) AS published FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE showme='1' AND validated='1'");
        list($published) = $GLOBALS['xoopsDB']->fetchRow($result);// {

        if (!$result) {
            $summary['published'] = 0;
        } else {
            $summary['published'] = $published;
        }
        unset($result);

        /**
         * Hidden (total)
         */
        $result = $GLOBALS['xoopsDB']->query('SELECT count(id) AS hidden FROM ' . $GLOBALS['xoopsDB']->prefix('amreviews_reviews') . " WHERE showme='0' OR validated='0'");
        list($hidden) = $GLOBALS['xoopsDB']->fetchRow($result);// {

        if (!$result) {
            $summary['hidden'] = 0;
        } else {
            $summary['hidden'] = $hidden;
        }
        unset($result);

        //print_r($summary);
        return $summary;
    }
}
