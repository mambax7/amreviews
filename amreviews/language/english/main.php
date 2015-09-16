<?php

//use Xoopsmodules\amreviews;

// $Id: main.php,v 1.5 2007/01/24 19:20:20 andrew Exp $
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

// includes
//include_once('header.php');
//include_once dirname(dirname(__DIR__)) . '/class/helper.php';
//$helper    = & Helper::getInstance();
use Xoopsmodules\amreviews;

$helper   = new Xoopsmodules\amreviews\Helper();
$mainLang = '_MD_' . strtoupper($helper->moduleDirName);

/**
 * Defines for index.php
 */
define($mainLang . '_NAVBCTOP', 'Top'); // Navigation BreadCrumbs 'Top'

/**
 * index.php - reviews listing.
 */
define($mainLang . '_REVIEWEDBY', 'Reviewed by:');
define($mainLang . '_NOREVIEWCAP', 'There are currently no reviews in this category.');
define($mainLang . '_NOPERMCATMSG', 'You do not have permission to view this category. Do you need to log in?');

/**
 * Generic that can go anywhere and notice messages.
 */
define($mainLang . '_GENON', 'on');
define($mainLang . '_READCAP', 'reads');

/**
 * review.php
 */
define($mainLang . '_SUBTTLCAP', 'Subtitle:');
define($mainLang . '_STARALTNORATE', 'Not rated.');
define($mainLang . '_OURRATECAP', 'Our rating:');
define($mainLang . '_USERRATECAP', 'User rating:');
define($mainLang . '_USERRATEALT', 'Our users have rated this: %s/5 from %s votes.'); // first %s replaced with vote, second with number of votes.
define($mainLang . '_DETAILSCAP', 'Item details:');
define($mainLang . '_BACKCAP', 'Back');
define($mainLang . '_PRINTCAP', 'Click for printer friendly version');
define($mainLang . '_EMAILCAP', 'Click to send to friend');
define($mainLang . '_PDFCAP', 'Click for PDF version');
define($mainLang . '_RSSCAP', 'RSS feed.');
define($mainLang . '_EDITCAP', 'Click to edit');
define($mainLang . '_DELETECAP', 'Click to delete');
define($mainLang . '_PAGENEXT', 'next');
define($mainLang . '_PAGEPREV', 'prev');
define($mainLang . '_PAGENUM', 'Page');
define($mainLang . '_PAGEOF', 'of');

/**
 * rate.php
 */
define($mainLang . '_AMREV_ALRDYVTD', 'It appears you\'ve already voted!');
define($mainLang . '_LOGGEDINVOTE', 'You must be logged in to vote!');
define($mainLang . '_AMREV_VOTED', 'Thanks for your vote!');
define($mainLang . '_AMREV_DBVOTEFAIL', 'Sorry, there was an error and your vote was not recorded.');
/*
define($mainLang . '_RATEPGNM',         'Submit rating');
define($mainLang . '_RATEFRMCAP',       'Rate');
define($mainLang . '_RATETYPECAP',      'Type:');
define($mainLang . '_RATETYPEONLY',     'Rate only');
define($mainLang . '_RATETYPERANDC',        'Rate and comment');
define($mainLang . '_RATETYPECOMM',     'Comment only');
define($mainLang . '_CAPRATE',          'Rating:');
define($mainLang . '_CAPRATESLT',       'Select a rating');
define($mainLang . '_CAPRATE1',         '*');
define($mainLang . '_CAPRATE2',         '* *');
define($mainLang . '_CAPRATE3',         '* * *');
define($mainLang . '_CAPRATE4',         '* * * *');
define($mainLang . '_CAPRATE5',         '* * * * *');
define($mainLang . '_FRMCAPSDTTL',      'Subject:');
define($mainLang . '_COMMENTTXT',       'Comments:');
define($mainLang . '_RATESUBMIT',       'Submit');
define($mainLang . '_RATERESET',            'Reset');
*/

/**
 * Print.php
 */
define($mainLang . '_PRINTAUTHOR', 'Reviewed by:');
define($mainLang . '_PRINTPUBBY', 'Review published on:');

// email.php
define('_MD_EMAILHEADTTL', 'E-mail Event to friend');
define('_MD_EMAILYOURNAME', 'Your name:');
define('_MD_EMAILYOUREMAIL', 'Your e-mail:');
define('_MD_EMAILRECIPIENT', 'Recipient:');
define('_MD_EMAILMESSAGE', 'Your message:');
define('_MD_EMAILMESSAGEDESC', 'This will be included in the e-mail.');
define('_MD_EMAILSEND', 'send');
define('_MD_EMAILSET', 'reset');
define('_MD_EMAILSECNOTE', '<strong>Please note:</strong> Some security information will be sent along with the e-mail to help trace anyone who abuses this service.');
define('_MD_EMAILNOTON', 'This feature is not enabled.');

// makepdf.php and associated PDF
define('_MD_PDFPOSTEDON', 'Posted on: ');
define('_MD_PDFPAGE', 'Page');

define($mainLang . '_PDF_NOT_INSTALLED', 'TCPDF for XOOPS not installed');
//define($mainLang . '_PRINTPUBBY', 'Review published on:');
