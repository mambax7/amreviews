<?php namespace Xoopsmodules\amreviews;

/**
 * Created by PhpStorm.
 * User: Mamba
 * Date: 2014-11-19
 * Time: 3:05
 */
class Utilities
{
    protected $db;

    /**
     * @param $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $this->db = $db;
    }

    public function adminfooter()
    {
        global $xoopsModule;

        echo "<span style=\"font-size: smaller;\">";
        echo '<br />';
        //echo $xoopsModule->getVar('name') . ", version " . round($xoopsModule->getVar('version')/100 , 2) . "<br />";
        echo $xoopsModule->getVar('name') . ', version ' . round($GLOBALS['xoopsModule']->getInfo('version'), 2) . '<br />';
        echo 'Updates are available from <a href=\'http://www.xoops.org\' target=\'_blank\'>http://http://www.xoops.org</a>';
        echo '</span>';
    }

    /**
     * Function responsible for checking if a directory exists, we can also write in and create an index.html file
     *
     * @param string $folder
     *
     * @return void
     */

    public static function prepareFolder($folder)
    {
        if (!is_dir($folder)) {
            mkdir($folder);
            file_put_contents($folder . '/index.html', '<script>history.go(-1);</script>');
        }
    }

    /**
     * See if an image file is in use by a review.
     * @param  string $imageFile
     * @return int
     */
    /*
        public function checkImageInUse($imageFile = '')
        {
            $count  = 0;
            $sql    = ('SELECT COUNT(image_file) AS count FROM ' . $this->db->prefix('amreviews_reviews') . " WHERE image_file='" . $imageFile . "'");
            $result = $this->db->query($sql);

            if ($this->db->getRowsNum($result) > 0) {
                while ($myrow = $this->db->fetchArray($result)) {
                    $count = $myrow['count'];
                }
            } else {
                $count = 0;
            }

            return $count;
        } // end function
    */
    /**
     * Do some basic file checks and stuff.
     */
    public function getServerStats()
    {
        //    global $xoopsModule;

        //        include_once dirname(__DIR__) . '/class/helper.php';
        //        $helper      = & Xoopsmodules\amreviews\Helper::getInstance();
        $helper = new Helper();
        //    $mainLang    = '_MD_' . strtoupper($helper->moduleDirName);
        //    $modinfoLang = '_MI_' . strtoupper($helper->moduleDirName);
        $adminLang = '_AM_' . strtoupper($helper->moduleDirName);

        echo '<fieldset>';
        echo '<legend style=\'color: #990000; font-weight: bold;\'>' . constant($adminLang . '_SERVERSTATS') . '</legend>';
        /*
            $photodir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos';
            $photothumbdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos/thumb';
            $photohighdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos/highlight';
            $cachedir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/cache';
            $tmpdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/cache/tmp';

            if (file_exists($photodir)) {
                if (!is_writable($photodir)) {
                    echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> I am unable to write to: ' . $photodir . '<br />';
                } else {
                    echo '<span style=\' color: green; font-weight: bold;\'>OK:</span> ' . $photodir . '<br />';
                }
            } else {
                echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> ' . $photodir . ' does NOT exist!<br />';
            }
            // photothumbdir
            if (file_exists($photothumbdir)) {
                if (!is_writable($photothumbdir)) {
                    echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $photothumbdir . '<br />';
                } else {
                    echo '<span style=\' color: green; font-weight: bold;\'>OK:</span> ' . $photothumbdir . '<br />';
                }
            } else {
                echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> ' . $photothumbdir . ' does NOT exist!<br />';
            }
            // photohighdir
            if (file_exists($photohighdir)) {
                if (!is_writable($photohighdir)) {
                    echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> I am unable to write to: ' . $photohighdir . '<br />';
                } else {
                    echo '<span style=\' color: green; font-weight: bold;\'>OK:</span> ' . $photohighdir . '<br />';
                }
            } else {
                echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> ' . $photohighdir . ' does NOT exist!<br />';
            }
            // cachedir
            if (file_exists($cachedir)) {
                if (!is_writable($cachedir)) {
                    echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> I am unable to write to: ' . $cachedir . '<br />';
                } else {
                    echo '<span style=\' color: green; font-weight: bold;\'>OK:</span> ' . $cachedir . '<br />';
                }
            } else {
                echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> ' . $cachedir . ' does NOT exist!<br />';
            }
            // tmpdir
            if (file_exists($tmpdir)) {
                if (!is_writable($tmpdir)) {
                    echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> I am unable to write to: ' . $tmpdir . '<br />';
                } else {
                    echo '<span style=\' color: green; font-weight: bold;\'>OK:</span> ' . $tmpdir . '<br />';
                }
            } else {
                echo '<span style=\' color: red; font-weight: bold;\'>Warning:</span> ' . $tmpdir . ' does NOT exist!<br />';
            }
        */

        /**
         * Some Upload info
         */
        $uploads = (ini_get('file_uploads')) ? constant($adminLang . '_UPLOAD_ON') : constant($adminLang . '_UPLOAD_OFF');
        //    echo '<br />';
        echo '<ul>';
        echo '<li>' . constant($adminLang . '_UPLOADMAX') . '<b>' . ini_get('upload_max_filesize') . '</b></li>';
        echo '<li>' . constant($adminLang . '_POSTMAX') . '<b>' . ini_get('post_max_size') . '</b></li>';
        echo '<li>' . constant($adminLang . '_UPLOADS') . '<b>' . $uploads . '</b></li>';

        $gdinfo = gd_info();
        if (function_exists('gd_info')) {
            echo '<li>' . constant($adminLang . '_GDIMGSPPRT') . '<b>' . constant($adminLang . '_GDIMGON') . '</b></li>';
            echo '<li>' . constant($adminLang . '_GDIMGVRSN') . '<b>' . $gdinfo['GD Version'] . '</b></li>';
        } else {
            echo '<li>' . constant($adminLang . '_GDIMGSPPRT') . '<b>' . constant($adminLang . '_GDIMGOFF') . '</b></li>';
        }
        echo '</ul>';

        //$inithingy = ini_get_all();
        //print_r($inithingy);

        echo '</fieldset>';
    } // end function

    //----------------------------------------------------------------------------//

    /**
     * @return array
     */
    public function getModuleStats()
    {
        // amreview_reviews - amreview_cat - amreview_rate

        $summary = array();

        /**
         * As many of these will be "joined" at some point.
         */

        /**
         * Review count (total)
         */
        $result = $this->db->query('SELECT COUNT(id) AS revcount FROM ' . $this->db->prefix('amreviews_reviews') . ' ');
        list($revcount) = $this->db->fetchRow($result);// {

        if (!$result) {
            $summary['revcount'] = 0;
        } else {
            $summary['revcount'] = $revcount;
        }

        /**
         * Waiting validation.
         */
        $result2 = $this->db->query('SELECT COUNT(id) AS waitval FROM ' . $this->db->prefix('amreviews_reviews') . " WHERE validated='0'");
        list($waitval) = $this->db->fetchRow($result2);// {

        if ($waitval < 1) {
            $summary['waitval'] = '<span style=\'font-weight: bold;\'>0</span>';
        } else {
            $summary['waitval'] = '<span style=\'font-weight: bold; color: red;\'>' . $waitval . '</span>';
        }

        /**
         * Category count (total)
         */
        $result = $this->db->query('SELECT COUNT(id) AS catcount FROM ' . $this->db->prefix('amreviews_cat') . ' ');
        list($catcount) = $this->db->fetchRow($result);// {

        if (!$result) {
            $summary['catcount'] = 0;
        } else {
            $summary['catcount'] = $catcount;
        }
        unset($result);

        /**
         * Views count (total)
         */
        $result = $this->db->query('SELECT SUM(views) AS views FROM ' . $this->db->prefix('amreviews_reviews') . ' ');
        list($views) = $this->db->fetchRow($result);// {

        if (!$result) {
            $summary['views'] = 0;
        } else {
            $summary['views'] = $views;
        }
        unset($result);

        /**
         * Published (total)
         */
        $result = $this->db->query('SELECT count(id) AS published FROM ' . $this->db->prefix('amreviews_reviews') . " WHERE showme='1' AND validated='1'");
        list($published) = $this->db->fetchRow($result);// {

        if (!$result) {
            $summary['published'] = 0;
        } else {
            $summary['published'] = $published;
        }
        unset($result);

        /**
         * Hidden (total)
         */
        $result = $this->db->query('SELECT count(id) AS hidden FROM ' . $this->db->prefix('amreviews_reviews') . " WHERE showme='0' OR validated='0'");
        list($hidden) = $this->db->fetchRow($result);// {

        if (!$result) {
            $summary['hidden'] = 0;
        } else {
            $summary['hidden'] = $hidden;
        }
        unset($result);

        //print_r($summary);
        return $summary;
    } // end function

    /**
     * @param \XoopsDatabase $db
     * @param string         $id
     */
    public function getRatings(\XoopsDatabase $db, $id = '0')
    {
        $sql    = ("SELECT * FROM " . $db->prefix('amreviews_cat') . ' ');
        $result = $db->query($sql);
    }

    //-------------------------------------

    /**
     * Xoopstree thingy
     * getCategoryPath("Top/index caption", $catid, column name, path, separator, table name, cat ID tbl name, cat parent id name)
     * @param  string       $topcap
     * @param  string       $catid
     * @param  string       $columnname
     * @param               $path
     * @param  string       $delim
     * @param               $table
     * @param               $itemID
     * @param               $parID
     * @return mixed|string
     */
    public function getCategoryPath($topcap = 'Top', $catid = '0', $columnname = '', $path, $delim = ':', $table, $itemID, $parID)
    {
        //    include_once(dirname(__DIR__) . '/class/xoopstree.php');
        //$mytree = new XoopsTree($this->db->prefix("amreview_cat"),"id","cat_parentid");
        $mytree = new XoopsTree($this->db, $this->db->prefix("$table"), "$itemID", "$parID");

        $catPath = "<a href=\"index.php\">" . $topcap . "</a>&nbsp;:&nbsp;"; // $xoopsModule->getVar('name') - _MD_AMR_NAVBCTOP
        $catPath .= $mytree->getNicePathFromId($catid, $columnname, $path);

        // Replace link/level separator
        $catPath = str_replace(":", $delim, $catPath);

        return $catPath;
    } // end function

    //----------------------------------------------------------------------------//

    /**
     * Get review count for category (not recursive)
     * @param string $catid
     * @return
     */

    /*
        public function getReviewCount($catid = '0')
        {
            $count  = 0;
            $sql    = ('SELECT COUNT(id) AS count FROM ' . $this->db->prefix('amreviews_reviews') . " WHERE catid='" . $catid . "'");
            $result = $this->db->query($sql);

            if ($this->db->getRowsNum($result) > 0) {
                while ($myrow = $this->db->fetchArray($result)) {
                    $count = $myrow['count'];
                }
            }

            return $count;
        } // end function
    */
    //----------------------------------------------------------------------------//

    /**
     * Get count on a field in DB (not recursive)
     * @param string     $aTable
     * @param string     $idField
     * @param string     $checkField
     * @param string     $checkFieldType
     * @param string|int $checkValue
     * @return int
     */
    public function getRowCount($aTable, $idField, $checkField, $checkFieldType, $checkValue)
    {
        if (!isset($aTable) || !isset($idField) || !isset($checkField) || !isset($checkFieldType) || !isset($checkValue)) {
            redirect_header('javascript:history.go(-1)', 1, 'missing field values');
        }

        $count  = 0;
        $sql    = ('SELECT COUNT(' . $idField . ') AS count FROM ' . $this->db->prefix($aTable) . " WHERE " . $checkField . "='" . $checkValue . "'");
        $result = $this->db->query($sql);

        if ($this->db->getRowsNum($result) > 0) {
            while ($myrow = $this->db->fetchArray($result)) {
                $count = $myrow['count'];
            }
        }

        return $count;
    } // end function

    /**
     * Increment review views/reads
     * @param $id
     */
    public function incrementViews($id)
    {
        $sql = ('UPDATE ' . $this->db->prefix('amreview_reviews') . " SET views=views+1 WHERE id='" . (int)($id) . "'");
        $this->db->queryF($sql);
    } // end function

    //----------------------------------------------------------------------------//

    /**
     * Get review count for category (not recursive)
     * @param  string $catid
     * @return string
     */
    public function getSubcats($catid = '0')
    {
        $sql    = ('SELECT * FROM ' . $this->db->prefix('amreviews_cat') . " WHERE cat_parentid='" . $catid . "' ORDER BY cat_title ASC");
        $result = $this->db->query($sql);

        $catlist = '';
        if ($this->db->getRowsNum($result) > 0) {
            while ($myrow = $this->db->fetchArray($result)) {
                //$count = $myrow['count'];
                $catlist .= "<a href=\"index.php?id=" . $myrow['id'] . "\">" . $myrow['cat_title'] . '</a><br />';
            }
        }

        return $catlist;
    } // end function

    //----------------------------------------------------------------------------//
    /**
     * Return user rating for review.
     * @param \XoopsDatabase $db
     * @param string         $id
     * @return
     */
    public function getUserRating(\XoopsDatabase $db, $id = '0')
    {
        //    global $xoopsDB;

        $result = $db->query("SELECT AVG(rate_rating) AS rate, COUNT(rate_rating) AS votes FROM " . $db->prefix('amreviews_rate') . " WHERE rate_review_id='" . (int)($id) . "'");
        list($rate, $votes) = $db->fetchRow($result);// {

        if (!$result || $rate < 0.01) {
            $summary['rate']  = 0;
            $summary['votes'] = 0;
        } else {
            $summary['rate']  = @number_format($rate, 1); // @number_format($current_rating/$count,2)
            $summary['votes'] = $votes;
        }
        unset($result);

        return ($summary);
    } // end function

}
