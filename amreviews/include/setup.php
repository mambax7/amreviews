<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

//use Xoopsmodules\amreviews;

//include_once dirname(__DIR__) . '/class/psr4/setuploader.php';

/**
 * Review module for xoops
 *
 * @copyright       {@link http://sourceforge.net/projects/thmod/ The TXMod XOOPS Project}
 * @copyright       {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license         GPL 2.0 or later
 * @package         amreview
 * @author          XOOPS Module Dev Team (http://xoops.org)
 * @version         $Id: $
 */

require_once  dirname(__DIR__) . '/class/Autoloader.php';
// true param for auto-registration in spl_autoload_register() function.
$loaderPsr4 = new Xoopsmodules\amreviews\Autoloader(true);

// Register a namespace
//$loaderPsr4->registerNamespace('org\\example\\libraries', './org/example/libraries');
//new org\example\libraries\DatabaseLibrary();
$loaderPsr4->registerNamespace('Xoopsmodules\\amreviews', dirname(__DIR__) . '/class/');
//$loaderPsr4->registerNamespace('Xoopsmodules\\amreviews\\tests', dirname(dirname(__DIR__)). '/tests');
//new Xoopsmodules\amreviews\Utilities();

//$loaderPsr4->add('Xoopsmodules\alumni', dirname(__DIR__) . '/class');
//$loaderPsr4->add('Xoopsmodules\alumni\tests', dirname(__DIR__) . '/tests');
//
//$loaderPsr4->addNamespace('Xoopsmodules\Alumni', dirname(__DIR__) . '/class');
//$loaderPsr4->addNamespace('Xoopsmodules\Alumni', dirname(__DIR__) . '/tests');

// Register a new file that has no namespace
//$loaderPsr4->registerFile('NoNamespaceClass', 'org/NoNamespaceClass.php');
//new NoNamespaceClass();

// Register an entire namespace
//$loaderPsr4->registerNamespace('org', 'orgtests');
// Now we can instantiate any of the test classes in org\... namespace
//new org\example\controllers\HomeControllerTest();
//new org\example\libraries\DatabaseLibraryTest();
$loaderPsr4->registerNamespace('amreviews', dirname(__DIR__) . '/tests');
//new amreviews\example\controllers\HomeControllerTest();
//new amreviews\example\libraries\DatabaseLibraryTest();

// We can register more locations or directories for one namespace
//$loaderPsr4->registerNamespace('org', __DIR__.'/org');
// now we can instantiate HomeController
//new org\example\controllers\HomeController();
//new org\example\controllers\HomeController();

// Register a Class that has a diferent filename
//$loaderPsr4->registerFile('SomeClassName', 'index.php');
// Overwrite the last filename for "SomeClassName"
//$loaderPsr4->registerFile('SomeClassName',  __DIR__.'/otherClasses/DiferentFileNameAndClassName.php', true);
//new SomeClassName();

// Register more than one class per filename
//$loaderPsr4->registerFile('AnotherClass',  __DIR__.'/otherClasses/DiferentFileNameAndClassName.php', true);
//$loaderPsr4->registerFile('YetAnotherClass',  __DIR__.'/otherClasses/DiferentFileNameAndClassName.php', true);
// It will find it even if the file has not the same name as the class (you should NOT do this but...)
//new AnotherClass();
//new YetAnotherClass();

//$loaderPsr4->registerNamespace('Xoopsmodules\\amreviews', dirname(__DIR__));
//$helper    = new Xoopsmodules\amreviews\Helper();

require_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';

$db = & XoopsDatabaseFactory::getDatabaseConnection();
xoops_load('XoopsRequest');

if (!defined('AMREVIEW_DIRNAME')) {
    define('AMREVIEW_DIRNAME', basename(dirname(__DIR__)));//$GLOBALS['xoopsModule']->dirname());
    define('AMREVIEW_PATH', XOOPS_ROOT_PATH . '/modules/' . AMREVIEW_DIRNAME);
    define('AMREVIEW_URL', XOOPS_URL . '/modules/' . AMREVIEW_DIRNAME);
    define('AMREVIEW_ADMIN', AMREVIEW_URL . '/admin/index.php');
    define('AMREVIEW_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . AMREVIEW_DIRNAME);
    define('AMREVIEW_AUTHOR_LOGOIMG', AMREVIEW_URL . '/assets/images/xoopsproject_logo.png');
}

// Define here the place where main upload path
define('AMREVIEW_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . AMREVIEW_DIRNAME); // WITHOUT Trailing slash
define('AMREVIEW_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . AMREVIEW_DIRNAME); // WITHOUT Trailing slash

//include_once dirname(__DIR__) . '/class/helper.php';

$helper = new Xoopsmodules\amreviews\Helper();
//$helper      = & Helper::getInstance();
$mainLang    = '_MD_' . strtoupper($helper->moduleDirName);
$modinfoLang = '_MI_' . strtoupper($helper->moduleDirName);
$adminLang   = '_AM_' . strtoupper($helper->moduleDirName);
//define('MODINFO_LANG', 'MI');
//define('ADMIN_LANG', 'AM');
//define('MAIN_LANG', 'MD');

$uploadFolders = array(
    AMREVIEW_UPLOAD_PATH,
    AMREVIEW_UPLOAD_PATH . '/photos',
    AMREVIEW_UPLOAD_PATH . '/photos/thumb',
    AMREVIEW_UPLOAD_PATH . '/photos/highlight',
    AMREVIEW_PATH . '/cache',
    AMREVIEW_PATH . '/cache/tmp');

//$xoopsTpl->assign('uploadFolders', $uploadFolders);

// module information
$mod_copyright = "<a href='http://xoops.org' title='XOOPS Project' target='_blank'>
                     <img src='" . AMREVIEW_AUTHOR_LOGOIMG . " alt='XOOPS Project' /></a>";
