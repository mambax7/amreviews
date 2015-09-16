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
 * @copyright       {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @version         $Id: install.php 12889 2014-12-08 20:18:04Z zyspec $
 * @link            http://sourceforge.net/projects/xoops/
 * @since           2.0.0
 */

$indexFile = 'index.html';
$blankFile = $GLOBALS['xoops']->path("modules/randomquote/assets/images/icons/blank.gif");

//Creation du dossier "uploads" pour le module à la racine du site
$module_uploads = $GLOBALS['xoops']->path("uploads/randomquote");
if (!is_dir($module_uploads)) {
    mkdir($module_uploads, 0777);
}
chmod($module_uploads, 0777);
copy($indexFile, $GLOBALS['xoops']->path("uploads/randomquote/index.html"));

//Creation du fichier citas dans uploads
$module_uploads = $GLOBALS['xoops']->path("uploads/randomquote/citas");
if (!is_dir($module_uploads)) {
    mkdir($module_uploads, 0777);
}
chmod($module_uploads, 0777);
copy($indexFile, $GLOBALS['xoops']->path("uploads/randomquote/citas/index.html"));
