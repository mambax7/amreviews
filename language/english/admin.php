<?php
// $Id: admin.php,v 1.7 2007/01/24 19:20:20 andrew Exp $
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
use Xoopsmodules\amreviews;

// includes
//include_once('header.php');

$helper = &Xoopsmodules\amreviews\Helper::getInstance();
//$helper    = new Xoopsmodules\amreviews\Helper();
$adminLang = '_AM_' . strtoupper($helper->moduleDirName);

/**
 * Admin header menu.
 */
define($adminLang . '_GENERALSET', 'Prefs');
define($adminLang . '_GOTOMOD', 'Go to mod');
define($adminLang . '_HELP', 'Help');
define($adminLang . '_MODULEADMIN', 'Admin :');
define($adminLang . '_INDEX', 'Index');
define($adminLang . '_CAT', 'Categories');
define($adminLang . '_REVIEWS', 'Reviews');
define($adminLang . '_IMAGES', 'Images');
define($adminLang . '_PERMS', 'Permissions');
define($adminLang . '_ABOUT', 'About');

/**
 * Misc. (used on more than one page)
 */
define($adminLang . '_SERVERSTATS', 'Server Information');
define($adminLang . '_UPLOADMAX', 'Maximum upload size: ');
define($adminLang . '_POSTMAX', 'Maximum post size: ');
define($adminLang . '_UPLOADS', 'Uploads allowed: ');
define($adminLang . '_UPLOAD_ON', 'On');
define($adminLang . '_UPLOAD_OFF', 'Off');
define($adminLang . '_GDIMGSPPRT', 'GD image lib supported: ');
define($adminLang . '_GDIMGON', 'Yes');
define($adminLang . '_GDIMGOFF', 'No');
define($adminLang . '_GDIMGVRSN', 'GD image lib version: ');
define($adminLang . '_DBUPDATED', 'Database updated!');
define($adminLang . '_DBNOUPDATED', 'Database not updated!');
define($adminLang . '_DBCONFMDEL', 'Are you sure you want to delete this item?');
define($adminLang . '_DBDELETED', 'Item deleted!');
define($adminLang . '_DBNOTDELETED', 'Item not deleted!');
define($adminLang . '_CLICKEDIT', 'Click to edit.');
define($adminLang . '_CLICKDELETE', 'Click to delete.');
define($adminLang . '_STATUSSHOW', 'Status: Published.');
define($adminLang . '_STATUSHIDE', 'Status: Hidden.');
define($adminLang . '_FRMCAPNOHTML', '&nbsp;Allow HTML.');
define($adminLang . '_FRMCAPNOBR', '&nbsp;Convert line breaks (deselect when using WYSIWYG editors).');
define($adminLang . '_FRMCAPNOSMLY', '&nbsp;Allow XOOPS smiley icons.');
define($adminLang . '_FRMCAPNOXCDE', '&nbsp;Allow XOOPS codes.');
define($adminLang . '_FRMCAPNOXIMG', '&nbsp;Allow display of images with XOOPS codes.');
define($adminLang . '_IMGCONFDEL', 'Are you sure you want to delete this image?');
define($adminLang . '_IMGCONFDELIU', 'Are you sure you want to delete this image?<br />There are %d review(s) using this image!');

/**
 * index.php
 */
define($adminLang . '_SUMMARY', 'Module Stats');
define($adminLang . '_WAITVALCAP', 'Validation:');
define($adminLang . '_WAITVAL', '%s reviews are waiting to be <a href=\'validate.php\'>validated</a>.');
define($adminLang . '_REVIEWTOTCAP', 'No. reviews:');
define($adminLang . '_REVIEWTOT', '%s <a href=\'review.php\'>reviews</a>.');
define($adminLang . '_CATETOTCAP', 'No. categories:');
define($adminLang . '_CATETOT', '%s <a href=\'category.php\'>categories</a>.');
define($adminLang . '_CATTBLCAP', 'Categories');
define($adminLang . '_VIEWSCAP', 'No. views:');
define($adminLang . '_VIEWS', '%s total <a href=\'review.php\'>reviews</a> views.');
define($adminLang . '_PUBLISHEDCAP', 'Published:');
define($adminLang . '_PUBLISHED', '%s <a href=\'review.php\'>reviews</a> have been published.');
define($adminLang . '_HIDDENCAP', 'Hidden:');
define($adminLang . '_HIDDEN', '%s <a href=\'review.php\'>reviews</a> are hidden (includes unvalidated <a href=\'review.php\'>reviews</a>).');

/**
 * category.php
 */
define($adminLang . '_CATCAPTION', 'Add a category:');
define($adminLang . '_CATCAPSAVE', 'Save');
define($adminLang . '_CATCAPTIONED', 'Edit a category:');
define($adminLang . '_CATCAPSAVEED', 'Save changes');

/**
 * catform.inc.php
 */
define($adminLang . '_CATCAPTTL', 'Category title:');
define($adminLang . '_CATCAPDESC', 'Description:');
define($adminLang . '_CATCAPPAR', 'Parent category:');
define($adminLang . '_CATCAPPARSLT', 'Select parent as required:');
define($adminLang . '_CATCAPSRT', 'Weight:');
define($adminLang . '_CATCAPDSPLY', 'Publish:');
define($adminLang . '_CATCAPDSPLYTXT', '&nbsp;Select to show this category.');

/**
 * review.php
 */
define($adminLang . '_REVIEWTBLCAP', 'Reviews:');
define($adminLang . '_REVCAPID', 'ID');
define($adminLang . '_REVCAPTTL', 'Title');
define($adminLang . '_FRMCAPLNKPRVW', 'Click to preview');
define($adminLang . '_REVCAPTION', 'Add a review:');
define($adminLang . '_REVCAPSAVE', 'Save');
define($adminLang . '_REVCAPEDIT', 'Edit review:');

/**
 * reviewform.inc.php
 */
//define($adminLang . '_REVCAPTTL', 'Review title:');
define($adminLang . '_REVCAPSUBTTL', 'Subtitle:');
define($adminLang . '_CAPSAUTHOR', 'Author:');
define($adminLang . '_CAPSDETAILS', 'Item details:');
define($adminLang . '_CAPSTEASER', 'Teaser:');
define($adminLang . '_CAPSMAINREVIEW', 'Main review:');
define($adminLang . '_CAPSKEYWORDS', 'Keywords:');
define($adminLang . '_CAPSKEYWORDSDSC', 'Add comma separated list of keywords for meta headers and site search.<br /> Example: &quot;key, word, for, search, meta tags&quot;');
define($adminLang . '_CATCAP', 'Category:');
define($adminLang . '_CATCAPSLT', 'Select a category');
define($adminLang . '_CAPDSPLYREV', 'Publish:');
define($adminLang . '_CAPDSPLYREVTXT', 'display this review.');
define($adminLang . '_CAPSDDATE', 'Published date:');
define($adminLang . '_CAPSSTARTDATE', 'Start date:');
define($adminLang . '_CAPSSTARTDTBX', 'Set when to start display of review (de-select to remove display restriction).<br />');
define($adminLang . '_CAPSSTARTDTYN', '<br />Remove start date: ');
define($adminLang . '_CAPSENDDATE', 'End date:');
define($adminLang . '_CAPSENDDTBX', 'Set when to end display of review (de-select to remove display restriction).<br />');
define($adminLang . '_CAPSENDDTYN', '<br />Remove expiry date: ');
define($adminLang . '_CAPRATE', 'Review rating:');
define($adminLang . '_CAPRATESLT', 'Select a rating:');
define($adminLang . '_CAPRATE1', '*');
define($adminLang . '_CAPRATE2', '**');
define($adminLang . '_CAPRATE3', '***');
define($adminLang . '_CAPRATE4', '****');
define($adminLang . '_CAPRATE5', '*****');
define($adminLang . '_PAGETTL', 'Review title as page title:');
//define($adminLang . '_PAGETTLDSC',    'The default page title behaviour - can be set individually in review.');
define($adminLang . '_PAGETTL_OPT_0', 'None: default XOOPS page title');
define($adminLang . '_PAGETTL_OPT_1', 'Yes: &lt;module name&gt; - &lt;review title&gt;');
define($adminLang . '_PAGETTL_OPT_2', 'Yes: &lt;review title&gt; - &lt;module name&gt;');
define($adminLang . '_KEYWORD', 'Keyword meta header options:');
define($adminLang . '_KEYWORD_OPT_0', 'None: default XOOPS meta tags');
define($adminLang . '_KEYWORD_OPT_1', 'Yes: review\s meta tags only');
define($adminLang . '_KEYWORD_OPT_2', 'Yes: review\'s and XOOPS meta tags');
define($adminLang . '_CAPCOMMENTS', 'Allow comments:');
define($adminLang . '_CAPCOMMENTSTXT', '&nbsp;Allow comments for this review.');

/**
 * Image.php
 */
define($adminLang . '_IMGUPLOAD', 'Upload images:');
define($adminLang . '_IMGUPFILE', 'Select image:');
define($adminLang . '_IMGUPBUTTON', 'Upload');
define($adminLang . '_IMGUPLOADFNL', '<b>Final upload path:</b> ');
define($adminLang . '_IMGUPLOADTMP', '<b>Temp upload path:</b> ');
define($adminLang . '_IMGUPLOADMAX', '<b>Max. file size:</b> ');
define($adminLang . '_IMGUPLOADFN', '&nbsp;Select to keep original filename.');
define($adminLang . '_IMGUPLOADED', 'Image uploaded successfully');
define($adminLang . '_DELETEIMGCAP', 'Delete an image:');
define($adminLang . '_SELECTIMGCAP', 'Select image:');
define($adminLang . '_HIWIDTH', 'Default highlight width:');
define($adminLang . '_THUMBWIDTH', 'Default thumbnail width:');
define($adminLang . '_DELTHUMBS', 'Delete thumbnails:');
define($adminLang . '_DELTHUMBSCAP', '');
define($adminLang . '_DELIMAGEBUT', 'Delete');
define($adminLang . '_DELIMG', 'Delete image:');
define($adminLang . '_IMGMAINDEL', 'Main image........');
define($adminLang . '_IMGHIGHDEL', 'Highlight image...');
define($adminLang . '_IMGTHUMBDEL', 'Thumbnail image...');
define($adminLang . '_IMGDELERR', '<b>Please note:</b> One or more of the images could not be deleted. Either the file(s) do not exist, or I do not have sufficient permissions.');
define($adminLang . '_IMGRETURN', 'Return to image admin');
define($adminLang . '_IMGDELETING', 'Deleting:');

/**
 * perms.php
 */
define($adminLang . '_CATPERMTTL', 'Category permissions');
define($adminLang . '_CATPERMDSC', 'Select who can view which category:');

// 0.1 Alpha 2

define($adminLang . '_REVCAP_VISIBLE', 'Visible:');
define($adminLang . '_REVCAP_ACTIONS', 'Actions:');

define($adminLang . '_THUMBNAIL_INFO', 'This will also create thumbnail and highlight images');
define($adminLang . '_ERROR_UNSUPPORTED_TYPE', 'This will also create thumbnail and highlight images');

define($adminLang . '_ERROR_PHOTO_NOT_UPLOADED', 'Error: photo not uploaded');
define($adminLang . '_ERROR_NOT_MOVED_TO_TEMP', 'File could not be moved to local temp dir');
define($adminLang . '_ERROR_PERMISSIONS_NOT_CHANGED', 'I was unable to change the temp file\'s permissions');
define($adminLang . '_ERROR_FILE_NOT_COPIED', 'Sorry, I was unable to copy the uploaded file from:');
define($adminLang . '_ERROR_TEMP_NOT_DELETED', 'I was unable to delete the temp copy of the uploaded file:');
define($adminLang . '_ERROR_FILE_EXISTS_RENAMED', 'already exists in the photo directory, so I have renamed it to');




