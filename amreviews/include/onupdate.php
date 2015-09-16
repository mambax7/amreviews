<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: RandomQuote
 *
 * @category        Module
 * @package         randomquote
 * @author          XOOPS Module Development Team
 * @author          Mamba
 * @author          Herve Thouzard
 * @copyright       Herve Thouzard
 * @copyright       {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @version         $Id: update.php 12889 2014-12-08 20:18:04Z zyspec $
 * @link            http://sourceforge.net/projects/xoops/
 * @since           2.0.0
 */

/**
 * @internal {Make sure you PROTECT THIS FILE
 *
 * This code has the potential to be extremely dangerous!!}
 */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof XoopsUser) || !($GLOBALS['xoopsUser']->IsAdmin())) {
    exit("Restricted access" . PHP_EOL);
}

/**
 * @param string $tablename
 *
 * @return bool
 */
function tableExists($tablename)
{
    $result = $GLOBALS['xoopsDB']->queryF("SHOW TABLES LIKE '$tablename'");

    return ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) ? true : false;
}

/**
 * @param       $module
 * @param  null $oldversion
 * @return bool
 */
function xoops_module_update_randomquote(&$module, $oldversion = null)
{
    $errors = 0;
    if (tableExists($GLOBALS['xoopsDB']->prefix('citas'))) {
        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('citas') . ' CHANGE `citas` `quote` TEXT');
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED0);
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('citas') . " ADD COLUMN `quote_status` int (10) NOT NULL default '0'," . " ADD COLUMN `quote_waiting` int (10) NOT NULL default '0'," . " ADD COLUMN `quote_online` int (10) NOT NULL default '0';");
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('citas') . ' RENAME ' . $GLOBALS['xoopsDB']->prefix('quotes'));
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED2);
            ++$errors;
        }
    } elseif (tableExists($GLOBALS['xoopsDB']->prefix('randomquote_quotes'))) {

        // change status to indicate quote waiting approval
        $sql    = "UPDATE " . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . " SET quote_status=2 WHERE `quote_waiting` > 0";
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        // change status to indicate quote online
        $sql    = "UPDATE " . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . " SET quote_status=1 WHERE `quote_online` > 0";
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        // drop the waiting and online columns
        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . " DROP COLUMN `quote_waiting`," . " DROP COLUMN `quote_online`;");
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED1);
            ++$errors;
        }

        // change the table name (drops the module name prefix)
        $sql    = sprintf('ALTER TABLE ' . $GLOBALS['xoopsDB']->prefix('randomquote_quotes') . ' RENAME ' . $GLOBALS['xoopsDB']->prefix('quotes'));
        $result = $GLOBALS['xoopsDB']->queryF($sql);
        if (!$result) {
            $module->setErrors(_AM_RANDOMQUOTE_UPGRADEFAILED2);
            ++$errors;
        }
    }

    if ($installedVersion < 233) {
        /* add column for poll anonymous which was created in versions prior
         * to 1.40 of xoopspoll but not automatically created
         */
        $result    = $db->queryF("SHOW COLUMNS FROM " . $db->prefix('quotes') . " LIKE 'create_date'");
        $foundAnon = $db->getRowsNum($result);
        if (empty($foundAnon)) {
            // column doesn't exist, so try and add it
            $success = $db->queryF("ALTER TABLE " . $db->prefix('quotes') . " ADD create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER quote_status");
            if (!$success) {
                $module->setErrors(sprintf(_AM_RANDOMQUOTE_ERROR_COLUMN, 'create_date'));
                ++$errors;
            }
        }
    }

    return ($errors) ? false : true;
}
