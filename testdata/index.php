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
use XoopsModules\Amreviews\Common;
use XoopsModules\Amreviews\Utility;

require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require dirname(__DIR__) . '/preloads/autoloader.php';

$op = \Xmf\Request::getCmd('op', '');

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$helper = Helper::getInstance();
// Load language files
$lang = $helper->getLanguage();

switch ($op) {
    case 'load':
        if (\Xmf\Request::hasVar('ok', 'REQUEST') && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header($helper->url('admin/index.php'), 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            loadSampleData();
        } else {
            xoops_cp_header();
            xoops_confirm(['ok' => 1, 'op' => 'load'], 'index.php', sprintf($lang::ADD_SAMPLEDATA_OK), $lang::CONFIRM, true);
            xoops_cp_footer();
        }
        break;
    case 'save':
        saveSampleData();
        break;
}

// XMF TableLoad for SAMPLE data

function loadSampleData()
{
    global $xoopsConfig;

    $moduleDirName      = basename(dirname(__DIR__));
    $moduleDirNameUpper = mb_strtoupper($moduleDirName);

    $utility      = new Utility();
    $configurator = new Common\Configurator();
    $helper       = Helper::getInstance();
    $lang         = $helper->getLanguage();

    //        $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');
    $tables = $helper->getModule()->getInfo('tables');

    $language = 'english/';
    if (is_dir(__DIR__ . '/' . $xoopsConfig['language'])) {
        $language = $xoopsConfig['language'] . '/';
    }

    foreach ($tables as $table) {
        $tabledata = \Xmf\Yaml::readWrapped($language . $table . '.yml');
        if (is_array($tabledata)) {
            \Xmf\Database\TableLoad::truncateTable($table);
            \Xmf\Database\TableLoad::loadTableFromArray($table, $tabledata);
        }
    }

    //  ---  COPY test folder files ---------------
    if (is_array($configurator->copyTestFolders) && count($configurator->copyTestFolders) > 0) {
        //        $file = dirname(__DIR__) . '/testdata/images/';
        foreach (array_keys($configurator->copyTestFolders) as $i) {
            $src  = $configurator->copyTestFolders[$i][0];
            $dest = $configurator->copyTestFolders[$i][1];
            $utility::rcopy($src, $dest);
        }
    }
    redirect_header($helper->url('admin/index.php'), 1, $lang::SAMPLEDATA_SUCCESS);
}

function saveSampleData()
{
    global $xoopsConfig;

    $moduleDirName      = basename(dirname(__DIR__));
    $moduleDirNameUpper = mb_strtoupper($moduleDirName);
    $helper             = Helper::getInstance();
    $lang               = $helper->getLanguage();

    //    $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');
    $tables = $helper->getModule()->getInfo('tables');

    $language = 'english/';
    if (is_dir(__DIR__ . '/' . $xoopsConfig['language'])) {
        $language = $xoopsConfig['language'] . '/';
    }

    $languageFolder = __DIR__ . '/' . $language;
    if (!file_exists($languageFolder . '/')) {
        Utility::createFolder($languageFolder . '/');
    }

    $exportFolder = $languageFolder . '/Exports-' . date('Y-m-d-H-i-s') . '/';
    Utility::createFolder($exportFolder);

    foreach ($tables as $table) {
        \Xmf\Database\TableLoad::saveTableToYamlFile($table, $exportFolder . $table . '.yml');
    }

    redirect_header($helper->url('admin/index.php'), 1, $lang::SAMPLEDATA_SUCCESS);
}

function exportSchema()
{
    $moduleDirName      = basename(dirname(__DIR__));
    $moduleDirNameUpper = mb_strtoupper($moduleDirName);
    $helper             = Helper::getInstance();
    $lang               = $helper->getLanguage();

    try {
        // TODO set exportSchema
        //        $migrate = new Amreviews\Migrate($moduleDirName);
        //        $migrate->saveCurrentSchema();
        //
        //        redirect_header($helper->url('admin/index.php'), 1, $lang::EXPORT_SCHEMA_SUCCESS);
    } catch (\Exception $e) {
        exit($lang::EXPORT_SCHEMA_ERROR);
    }
}
