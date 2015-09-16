<?php

use Xoopsmodules\amreviews;

//include_once dirname(dirname(__DIR__)) . '/class/psr4/setuploader.php';
include_once dirname(dirname(__DIR__)) . '/include/setup.php';

// $Id: modinfo.php,v 1.4 2007/01/24 19:20:20 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//  About:  This file is part of the AM Reviews module for Xoops v2.         //
//                                                                           //
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

/**
 * xoops_version.php
 */
//include_once dirname(dirname(__DIR__)) . '/class/helper.php';
//$helper    = & Helper::getInstance();
//$moduleDirName    = basename(dirname(dirname(__DIR__)));
$helper      = new Xoopsmodules\amreviews\Helper();
$modinfoLang = '_MI_' . strtoupper($helper->moduleDirName);

//$modinfoLang = '_MI_' . strtoupper($moduleDirName);
//$adminLang   = '_AM_' . strtoupper($moduleDirName);

define($modinfoLang . '_NAME', 'AM Reviews');
define($modinfoLang . '_DESC', 'A reviews module for XOOPS v2');

/**
 * xoops_version.php - config options
 */
define($modinfoLang . '_INDXCOL', 'Category columns:');
define($modinfoLang . '_INDXCOLDSC', 'Number of columns in category.');
define($modinfoLang . '_DATEFRMT', 'Review page date format:');
define($modinfoLang . '_DATEFRMTDSC', 'Define the date format in review page. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.');
define($modinfoLang . '_DATEFRMTINDX', 'Review list date format:');
define($modinfoLang . '_DATEFRMTINDXDSC', 'Define the date format in reviews list on index. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.');
define($modinfoLang . '_DATEFRMTPRT', 'Print page date format:');
define($modinfoLang . '_DATEFRMTPRTDSC', 'Define the date format for the print version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.');
define($modinfoLang . '_DATEFRMTPDF', 'PDF page date format:');
define($modinfoLang . '_DATEFRMTPDFDSC', 'Define the date format for the PDF version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.');
define($modinfoLang . '_SHWRVWDBY', 'Show reviewer:');
define($modinfoLang . '_SHWRVWDBYDSC', ' ');
define($modinfoLang . '_DETAILTPL', 'Item details template:');
define($modinfoLang . '_DETAILTPLDSC', 'Template for items details field in review.');
define($modinfoLang . '_INCREMENTADMIN', 'Do not increment admin views:');
define($modinfoLang . '_INCREMENTADMINDSC', 'Do not increment review views/reads for admins.');
define($modinfoLang . '_DETAILTPLTXT', '<b>Part No:</b>');
define($modinfoLang . '_EDITADMIN', 'Admin editor:');
define($modinfoLang . '_EDITADMINDSC', ' ');
define($modinfoLang . '_PHOTOPATH', 'Photo location:');
define($modinfoLang . '_PHOTOPATHDSC', 'The location of review photos.');
define($modinfoLang . '_MAXUPADMIN', 'Maximum file size admin:');
define($modinfoLang . '_MAXUPADMINDSC', 'Maximum file size for photos in the admin area. In Kilobytes (Kb)');
define($modinfoLang . '_SHWPRINT', 'Printable version:');
define($modinfoLang . '_SHWPRINTDSC', 'Allow printable version.');
define($modinfoLang . '_ALLOWEMAIL', 'E-mail to friend:');
define($modinfoLang . '_ALLOWEMAILDSC', 'Allow e-mail to friend feature.');
define($modinfoLang . '_EMLLOGGEDIN', 'Log in to use e-mail to friend:');
define($modinfoLang . '_EMLLOGGEDINDSC', ' ');
define($modinfoLang . '_OPTION_EMLOWNMSG', 'Allow own message');
define($modinfoLang . '_OPTION_EMLOWNMSGDSC', 'Allow user to add their own message to e-mail.');
define($modinfoLang . '_OPTION_EMLMSGSBJCT', 'E-mail subject');
define($modinfoLang . '_OPTION_EMLMSGSBJCTDSC', 'the text that will appear in the e-mail\'s subject field.');
define($modinfoLang . '_OPTION_EMLMSGSUBJECT', 'A friend recommended this Review');
define($modinfoLang . '_OPTION_EMLMSGCHRS', 'No. characters in own message');
define($modinfoLang . '_OPTION_EMLMSGCHRSDSC', 'the maximum number of characters user is allowed to send in own message.');
define($modinfoLang . '_OPTION_EMAILTXT', 'E-mail message');
define($modinfoLang . '_OPTION_EMAILTXTSC', 'The text that will be sent in the e-mail to a friend message.');
define($modinfoLang . '_OPTION_EMAILTXTMSG', 'Hello,

A user of {SITE_NAME} feels that the following page may be of interest to you.

{ARTICLE_URL}

Their message below:

**

{USER_MESSAGE}

**

Security information:
If this e-mail has been sent inappropriately, please forward the complete e-mail to {ADMIN_EMAIL}.
User\'s IP address: {USER_IP}
User\'s Browser: {USER_BROWSER}
Time sent: {USER_TIME}

--
 {SITE_NAME}
 {SITE_URL}
');
define($modinfoLang . '_IMGHIGHWIDTH', 'Default highlight image width:');
define($modinfoLang . '_IMGHIGHWIDTHDSC', 'Set the default width of highlight images (these appear in the review listings under categories).');
define($modinfoLang . '_IMGTHUMBWIDTH', 'Default thumbnail image width:');
define($modinfoLang . '_IMGTHUMBWIDTHDSC', 'Set the default width of thumbnail images (these appear in the review article).');
define($modinfoLang . '_SHOWSUBCATS', 'Show sub categories:');
define($modinfoLang . '_SHOWSUBCATSDSC', 'This will show the first level of subcategories.');
define($modinfoLang . '_HIDENOPERMCATS', 'Hide no access categories:');
define($modinfoLang . '_HIDENOPERMCATSDSC', 'Hide categories to those who do not have access permissions.');
define($modinfoLang . '_PAGETTLDEF', 'Default page title:');
define($modinfoLang . '_PAGETTLDEFDSC', 'The default page title behaviour - can be set individually in review.');
define($modinfoLang . '_PAGETTLDEF_OPT_0', 'None: default XOOPS page title');
define($modinfoLang . '_PAGETTLDEF_OPT_1', 'Yes: &lt;module name&gt; - &lt;review title&gt;');
define($modinfoLang . '_PAGETTLDEF_OPT_2', 'Yes: &lt;review title&gt; - &lt;module name&gt;');
define($modinfoLang . '_PAGEMETADEF', 'Default page meta header:');
define($modinfoLang . '_PAGEMETADEFDSC', 'The default page meta header behaviour - can be set individually in review.');
define($modinfoLang . '_PAGEMETADEF_OPT_0', 'None: default XOOPS meta tags');
define($modinfoLang . '_PAGEMETADEF_OPT_1', 'Yes: review\'s meta tags only');
define($modinfoLang . '_PAGEMETADEF_OPT_2', 'Yes: review\'s and XOOPS meta tags');
define($modinfoLang . '_LOGGEDINVOTE', 'Logged in to vote:');
define($modinfoLang . '_LOGGEDINVOTEDSC', 'Whether or not the user has to be logged in to vote.');
define($modinfoLang . '_ALLOWPDF', 'PDF version:');
define($modinfoLang . '_ALLOWPDFDSC', 'Allow PDF page version');
define($modinfoLang . '_HILITEIMG', 'Highlight image:');
define($modinfoLang . '_HILITEIMGDSC', 'How to show highlight image.');
define($modinfoLang . '_HILITEIMG_OPT_0', 'New window');
define($modinfoLang . '_HILITEIMG_OPT_1', 'Lightbox');

/**
 * admin/menu.php
 */
define($modinfoLang . '_MENU1', 'Index');
define($modinfoLang . '_MENU2', 'Categories');
define($modinfoLang . '_MENU3', 'Reviews');
define($modinfoLang . '_MENU4', 'Images');
define($modinfoLang . '_MENU5', 'Permissions');
