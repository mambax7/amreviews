<?php namespace Xoopsmodules\amreviews;

    /**
     * XOOPS tree handler
     *
     * You may not change or alter any portion of this comment or credits
     * of supporting developers from this source code or any supporting source code
     * which is considered copyrighted (c) material of the original comment or credit authors.
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     *
     * @copyright       XOOPS Project (https://xoops.org)
     * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
     * @package         kernel
     * @since           2.0.0
     * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
     * @version         $Id: xoopstree.php 8066 2011-11-06 05:09:33Z beckmi $
     */

    //defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

/**
 * Abstract base class for forms
 *
 * @author     Kazumi Ono <onokazu@xoops.org>
 * @author     John Neill <catzwolf@xoops.org>
 * @copyright  copyright (c) XOOPS.org
 * @package    kernel
 * @subpackage XoopsTree
 * @access     public
 */
class XoopsTree extends \XoopsObject
{
    public $table; //table with parent-child structure
    public $id; //name of unique id for records in table $table
    public $pid; // name of parent id used in table $table
    public $order; //specifies the order of query results
    public $title; // name of a field in table $table which will be used when  selection box and paths are generated
    public $db;

    //constructor of class XoopsTree
    //sets the names of table, unique id, and parend id
    /**
     * @param \XoopsDatabase $db
     * @param                $table_name
     * @param                $id_name
     * @param                $pid_name
     */
    public function __construct(\XoopsDatabase $db, $table_name, $id_name, $pid_name)
    {
        //        $GLOBALS['xoopsLogger']->addDeprecated("Class '" . __CLASS__ . "' is deprecated, check 'XoopsObjectTree' in tree.php");
        $this->db = &\XoopsDatabaseFactory::getDatabaseConnection();
        //        $this->db = $db ;
        $this->table = $table_name;
        $this->id    = $id_name;
        $this->pid   = $pid_name;
    }

    // returns an array of first child objects for a given id($selId)
    /**
     * @param        $selId
     * @param string $order
     *
     * @return array
     */
    public function getFirstChild($selId, $order = '')
    {
        $selId = (int)($selId);
        $arr   = array();
        $sql   = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->pid . '=' . $selId . '';
        if ($order !== '') {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        $count  = $this->db->getRowsNum($result);
        if ($count === 0) {
            return $arr;
        }
        while ($myrow = $this->db->fetchArray($result)) {
            $arr[] = $myrow;
        }

        return $arr;
    }

    // returns an array of all FIRST child ids of a given id($selId)
    /**
     * @param $selId
     *
     * @return array
     */
    public function getFirstChildId($selId)
    {
        $selId   = (int)($selId);
        $idArray = array();
        $result  = $this->db->query('SELECT ' . $this->id . ' FROM ' . $this->table . ' WHERE ' . $this->pid . '=' . $selId . '');
        $count   = $this->db->getRowsNum($result);
        if ($count === 0) {
            return $idArray;
        }
        while (list($id) = $this->db->fetchRow($result)) {
            $idArray[] = $id;
        }

        return $idArray;
    }

    //returns an array of ALL child ids for a given id($selId)
    /**
     * @param        $selId
     * @param string $order
     * @param array  $idArray
     *
     * @return array
     */
    public function getAllChildId($selId, $order = '', $idArray = array())
    {
        $selId = (int)($selId);
        $sql   = 'SELECT ' . $this->id . ' FROM ' . $this->table . ' WHERE ' . $this->pid . '=' . $selId . '';
        if ($order !== '') {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        $count  = $this->db->getRowsNum($result);
        if ($count === 0) {
            return $idArray;
        }
        while (list($resultId) = $this->db->fetchRow($result)) {
            $idArray[] = $resultId;
            $idArray   = $this->getAllChildId($resultId, $order, $idArray);
        }

        return $idArray;
    }

    //returns an array of ALL parent ids for a given id($selId)
    /**
     * @param        $selId
     * @param string $order
     * @param array  $idArray
     *
     * @return array
     */
    public function getAllParentId($selId, $order = '', $idArray = array())
    {
        $selId = (int)($selId);
        $sql   = 'SELECT ' . $this->pid . ' FROM ' . $this->table . ' WHERE ' . $this->id . '=' . $selId . '';
        if ($order !== '') {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        list($resultId) = $this->db->fetchRow($result);
        if ($resultId === 0) {
            return $idArray;
        }
        $idArray[] = $resultId;
        $idArray   = $this->getAllParentId($resultId, $order, $idArray);

        return $idArray;
    }

    //generates path from the root id to a given id($selId)
    // the path is delimetered with "/"
    /**
     * @param        $selId
     * @param        $title
     * @param string $path
     *
     * @return string
     */
    public function getPathFromId($selId, $title, $path = '')
    {
        $selId  = (int)($selId);
        $result = $this->db->query('SELECT ' . $this->pid . ', ' . $title . ' FROM ' . $this->table . ' WHERE ' . $this->id . "=$selId");
        if ($this->db->getRowsNum($result) === 0) {
            return $path;
        }
        list($parentid, $name) = $this->db->fetchRow($result);
        $myts = &MyTextSanitizer::getInstance();
        $name = $myts->htmlspecialchars($name);
        $path = '/' . $name . $path . '';
        if ($parentid === 0) {
            return $path;
        }
        $path = $this->getPathFromId($parentid, $title, $path);

        return $path;
    }

    //makes a nicely ordered selection box
    //$presetId is used to specify a preselected item
    //set $none to 1 to add a option with value 0
    /**
     * @param        $title
     * @param string $order
     * @param int    $presetId
     * @param int    $none
     * @param string $selName
     * @param string $onchange
     */
    public function makeMySelBox($title, $order = '', $presetId = 0, $none = 0, $selName = '', $onchange = '')
    {
        if ($selName === "") {
            $selName = $this->id;
        }
        $myts = &MyTextSanitizer::getInstance();
        echo "<select name='" . $selName . "'";
        if ($onchange !== "") {
            echo " onchange='" . $onchange . "'";
        }
        echo ">\n";
        $sql = 'SELECT ' . $this->id . ', ' . $title . ' FROM ' . $this->table . ' WHERE ' . $this->pid . '=0';
        if ($order !== "") {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        if ($none) {
            echo "<option value='0'>----</option>\n";
        }
        while (list($catid, $name) = $this->db->fetchRow($result)) {
            $sel = "";
            if ($catid === $presetId) {
                $sel = " selected='selected'";
            }
            echo "<option value='$catid'$sel>$name</option>\n";
            $sel = "";
            $arr = $this->getChildTreeArray($catid, $order);
            foreach ($arr as $option) {
                $option['prefix'] = str_replace('.', '--', $option['prefix']);
                $catpath          = $option['prefix'] . '&nbsp;' . $myts->htmlspecialchars($option[$title]);
                if ($option[$this->id] === $presetId) {
                    $sel = " selected='selected'";
                }
                echo "<option value='" . $option[$this->id] . "'" . $sel . ">" . $catpath . "</option>\n";
                $sel = '';
            }
        }
        echo "</select>\n";
    }

    //generates nicely formatted linked path from the root id to a given id
    /**
     * @param        $selId
     * @param        $title
     * @param        $funcURL
     * @param string $path
     *
     * @return string
     */
    public function getNicePathFromId($selId, $title, $funcURL, $path = '')
    {
        $path   = !empty($path) ? '&nbsp;:&nbsp;' . $path : $path;
        $selId  = (int)($selId);
        $sql    = 'SELECT ' . $this->pid . ', ' . $title . ' FROM ' . $this->table . ' WHERE ' . $this->id . '=' . $selId;
        $result = $this->db->query($sql);
        if ($this->db->getRowsNum($result) === 0) {
            return $path;
        }
        list($parentid, $name) = $this->db->fetchRow($result);
        $myts = &\MyTextSanitizer::getInstance();
        $name = $myts->htmlspecialchars($name);
        $path = "<a href='" . $funcURL . '&amp;' . $this->id . '=' . $selId . "'>" . $name . '</a>' . $path . '';
        if ($parentid === 0) {
            return $path;
        }
        $path = $this->getNicePathFromId($parentid, $title, $funcURL, $path);

        return $path;
    }

    //generates id path from the root id to a given id
    // the path is delimetered with "/"
    /**
     * @param        $selId
     * @param string $path
     *
     * @return string
     */
    public function getIdPathFromId($selId, $path = "")
    {
        $selId  = (int)($selId);
        $result = $this->db->query('SELECT ' . $this->pid . ' FROM ' . $this->table . ' WHERE ' . $this->id . '=' . $selId);
        if ($this->db->getRowsNum($result) === 0) {
            return $path;
        }
        list($parentid) = $this->db->fetchRow($result);
        $path = '/' . $selId . $path . '';
        if ($parentid === 0) {
            return $path;
        }
        $path = $this->getIdPathFromId($parentid, $path);

        return $path;
    }

    /**
     * Enter description here...
     *
     * @param integer|\unknown_type    $selId
     * @param string|\unknown_type $order
     * @param array|\unknown_type  $pArray
     *
     * @return unknown
     */
    public function getAllChild($selId = 0, $order = '', $pArray = array())
    {
        $selId = (int)($selId);
        $sql   = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->pid . '=' . $selId . '';
        if ($order !== '') {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        $count  = $this->db->getRowsNum($result);
        if ($count === 0) {
            return $pArray;
        }
        while ($row = $this->db->fetchArray($result)) {
            $pArray[] = $row;
            $pArray   = $this->getAllChild($row[$this->id], $order, $pArray);
        }

        return $pArray;
    }

    /**
     * Enter description here...
     *
     * @param integer|\unknown_type    $selId
     * @param string|\unknown_type $order
     * @param array|\unknown_type  $pArray
     * @param string|\unknown_type $r_prefix
     *
     * @return unknown
     */
    public function getChildTreeArray($selId = 0, $order = '', $pArray = array(), $r_prefix = '')
    {
        $selId = (int)($selId);
        $sql   = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->pid . '=' . $selId . '';
        if ($order !== '') {
            $sql .= ' ORDER BY ' . $order;
        }
        $result = $this->db->query($sql);
        $count  = $this->db->getRowsNum($result);
        if ($count === 0) {
            return $pArray;
        }
        while ($row = $this->db->fetchArray($result)) {
            $row['prefix'] = $r_prefix . '.';
            $pArray[]      = $row;
            $pArray        = $this->getChildTreeArray($row[$this->id], $order, $pArray, $row['prefix']);
        }

        return $pArray;
    }
}
