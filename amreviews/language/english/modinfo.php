<?php
// $Id: modinfo.php,v 1.4 2007/01/24 19:20:20 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//	About:  This file is part of the AM Reviews module for Xoops v2.         //
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
define("_MI_AM_REVIEW_NAME",	"AM Reviews");
define("_MI_AM_REVIEW_DESC",	"A reviews module for XOOPS v2");


/**
* xoops_version.php - config options
*/
define("_MI_AMR_INDXCOL",			"Category columns:");
define("_MI_AMR_INDXCOLDSC",		"Number of columns in category.");
define("_MI_AMR_DATEFRMT",			"Review page date format:");
define("_MI_AMR_DATEFRMTDSC",		"Define the date format in review page. See PHP's <a href=\"http://www.php.net/date\" target=\"_blank\">date format page</a> for the different date format characters you can use.");
define("_MI_AMR_DATEFRMTINDX",		"Review list date format:");
define("_MI_AMR_DATEFRMTINDXDSC",	"Define the date format in reviews list on index. See PHP's <a href=\"http://www.php.net/date\" target=\"_blank\">date format page</a> for the different date format characters you can use.");
define("_MI_AMR_DATEFRMTPRT",		"Print page date format:");
define("_MI_AMR_DATEFRMTPRTDSC",	"Define the date format for the print version. See PHP's <a href=\"http://www.php.net/date\" target=\"_blank\">date format page</a> for the different date format characters you can use.");
define("_MI_AMR_DATEFRMTPDF",		"PDF page date format:");
define("_MI_AMR_DATEFRMTPDFDSC",	"Define the date format for the PDF version. See PHP's <a href=\"http://www.php.net/date\" target=\"_blank\">date format page</a> for the different date format characters you can use.");
define("_MI_AMR_SHWRVWDBY",			"Show reviewer:");
define("_MI_AMR_SHWRVWDBYDSC",		" ");
define("_MI_AMR_DETAILTPL",			"Item details template:");
define("_MI_AMR_DETAILTPLDSC",		"Template for items details field in review.");
define("_MI_AMR_INCREMENTADMIN",	"Do not increment admin views:");
define("_MI_AMR_INCREMENTADMINDSC",	"Do not increment review views/reads for admins.");
define("_MI_AMR_DETAILTPLTXT",		"<b>Part No:</b>");
define("_MI_AMR_EDITADMIN",				"Admin editor:");
define("_MI_AMR_EDITADMINDSC",			" ");
define("_MI_AMR_PHOTOPATH",				"Photo location:");
define("_MI_AMR_PHOTOPATHDSC",			"The location of review photos.");
define("_MI_AMR_MAXUPADMIN",			"Maximum file size admin:");
define("_MI_AMR_MAXUPADMINDSC",			"Maximum file size for photos in the admin area. In Kilobytes (Kb)");
define("_MI_AMR_SHWPRINT",				"Printable version:");
define("_MI_AMR_SHWPRINTDSC",			"Allow printable version.");
define("_MI_AMR_ALLOWEMAIL",			"E-mail to friend:");
define("_MI_AMR_ALLOWEMAILDSC",			"Allow e-mail to friend feature.");
define("_MI_AMR_EMLLOGGEDIN",			"Log in to use e-mail to friend:");
define("_MI_AMR_EMLLOGGEDINDSC",		" ");
define("_MI_AMR_OPTION_EMLOWNMSG",		"Allow own message");
define("_MI_AMR_OPTION_EMLOWNMSGDSC",	"Allow user to add their own message to e-mail.");
define("_MI_AMR_OPTION_EMLMSGSBJCT",	"E-mail subject");
define("_MI_AMR_OPTION_EMLMSGSBJCTDSC",	"the text that will appear in the e-mail's subject field.");
define("_MI_AMR_OPTION_EMLMSGSUBJECT",	"A friend recommended this Review");
define("_MI_AMR_OPTION_EMLMSGCHRS",		"No. characters in own message");
define("_MI_AMR_OPTION_EMLMSGCHRSDSC",	"the maximum number of characters user is allowed to send in own message.");
define("_MI_AMR_OPTION_EMAILTXT",		"E-mail message");
define("_MI_AMR_OPTION_EMAILTXTSC",		"The text that will be sent in the e-mail to a friend message.");
define("_MI_AMR_OPTION_EMAILTXTMSG",	"Hello,

A user of {SITE_NAME} feels that the following page may be of interest to you.

{ARTICLE_URL}

Their message below:

**

{USER_MESSAGE}

**

Security information:
If this e-mail has been sent inappropriately, please forward the complete e-mail to {ADMIN_EMAIL}.
User's IP address: {USER_IP}
User's Browser: {USER_BROWSER}
Time sent: {USER_TIME}

-- 
 {SITE_NAME}
 {SITE_URL}
");
define("_MI_AMR_IMGHIGHWIDTH",			"Default highlight image width:");
define("_MI_AMR_IMGHIGHWIDTHDSC",		"Set the default width of highlight images (these appear in the review listings under categories).");
define("_MI_AMR_IMGTHUMBWIDTH",			"Default thumbnail image width:");
define("_MI_AMR_IMGTHUMBWIDTHDSC",		"Set the default width of thumbnail images (these appear in the review article).");
define("_MI_AMR_SHOWSUBCATS",			"Show sub categories:");
define("_MI_AMR_SHOWSUBCATSDSC",		"This will show the first level of subcategories.");
define("_MI_AMR_HIDENOPERMCATS",		"Hide no access categories:");
define("_MI_AMR_HIDENOPERMCATSDSC",		"Hide categories to those who do not have access permissions.");
define("_MI_AMR_PAGETTLDEF",			"Default page title:");
define("_MI_AMR_PAGETTLDEFDSC",			"The default page title behaviour - can be set individually in review.");
define("_MI_AMR_PAGETTLDEF_OPT_0",		"None: default XOOPS page title");
define("_MI_AMR_PAGETTLDEF_OPT_1",		"Yes: &lt;module name&gt; - &lt;review title&gt;");
define("_MI_AMR_PAGETTLDEF_OPT_2",		"Yes: &lt;review title&gt; - &lt;module name&gt;");
define("_MI_AMR_PAGEMETADEF",			"Default page meta header:");
define("_MI_AMR_PAGEMETADEFDSC",		"The default page meta header behaviour - can be set individually in review.");
define("_MI_AMR_PAGEMETADEF_OPT_0",		"None: default XOOPS meta tags");
define("_MI_AMR_PAGEMETADEF_OPT_1",		"Yes: review's meta tags only");
define("_MI_AMR_PAGEMETADEF_OPT_2",		"Yes: review's and XOOPS meta tags");
define("_MI_AMR_LOGGEDINVOTE",			"Logged in to vote:");
define("_MI_AMR_LOGGEDINVOTEDSC",		"Whether or not the user has to be logged in to vote.");
define("_MI_AMR_ALLOWPDF",				"PDF version:");
define("_MI_AMR_ALLOWPDFDSC",			"Allow PDF page version");
define("_MI_AMR_HILITEIMG",				"Highlight image:");
define("_MI_AMR_HILITEIMGDSC",			"How to show highlight image.");
define("_MI_AMR_HILITEIMG_OPT_0",		"New window");
define("_MI_AMR_HILITEIMG_OPT_1",		"Lightbox");


/**
* admin/menu.php
*/
define("_MI_AMREVIEW_MENU1",	"Index");
define("_MI_AMREVIEW_MENU2",	"Categories");
define("_MI_AMREVIEW_MENU3",	"Reviews");
define("_MI_AMREVIEW_MENU4",	"Images");
define("_MI_AMREVIEW_MENU5",	"Permissions");



?>