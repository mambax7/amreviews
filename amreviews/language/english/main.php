<?php
// $Id: main.php,v 1.5 2007/01/24 19:20:20 andrew Exp $
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

// includes
//include_once("header.php");

/**
* Defines for index.php
*/
define("_MD_AMR_NAVBCTOP",	"Top"); // Navigation BreadCrumbs "Top"

/**
* index.php - reviews listing.
*/
define("_MD_AMR_REVIEWEDBY",	"Reviewed by:");
define("_MD_AMR_NOREVIEWCAP",	"There are currently no reviews in this category.");
define("_MD_AMR_NOPERMCATMSG",	"You do not have permission to view this category. Do you need to log in?");


/**
* Generic that can go anywhere and notice messages.
*/
define("_MD_AMR_GENON",		"on");
define("_MD_AMR_READCAP",	"reads");


/**
* review.php
*/
define("_MD_AMR_SUBTTLCAP",		"Subtitle:");
define("_MD_AMR_STARALTNORATE",	"Not rated.");
define("_MD_AMR_OURRATECAP",	"Our rating:");
define("_MD_AMR_USERRATECAP",	"User rating:");
define("_MD_AMR_USERRATEALT",	"Our users have rated this: %s/5 from %s votes."); // first %s replaced with vote, second with number of votes.
define("_MD_AMR_DETAILSCAP",	"Item details:");
define("_MD_AMR_BACKCAP",		"Back");
define("_MD_AMR_PRINTCAP",		"Click for printer friendly version");
define("_MD_AMR_EMAILCAP",		"Click to send to friend");
define("_MD_AMR_PDFCAP",		"Click for PDF version");
define("_MD_AMR_RSSCAP",		"RSS feed.");
define("_MD_AMR_EDITCAP",		"Click to edit");
define("_MD_AMR_DELETECAP",		"Click to delete");
define("_MD_AMR_PAGENEXT",		"next");
define("_MD_AMR_PAGEPREV",		"prev");
define("_MD_AMR_PAGENUM",		"Page");
define("_MD_AMR_PAGEOF",		"of");


/**
* rate.php
*/
define("_AM_AMREV_ALRDYVTD",	"It appears you've already voted!");
define("_MD_LOGGEDINVOTE",		"You must be logged in to vote!");
define("_AM_AMREV_VOTED",		"Thanks for your vote!");
define("_AM_AMREV_DBVOTEFAIL",	"Sorry, there was an error and your vote was not recorded.");
/*
define("_MD_AMR_RATEPGNM",			"Submit rating");
define("_MD_AMR_RATEFRMCAP",		"Rate");
define("_MD_AMR_RATETYPECAP",		"Type:");
define("_MD_AMR_RATETYPEONLY",		"Rate only");
define("_MD_AMR_RATETYPERANDC",		"Rate and comment");
define("_MD_AMR_RATETYPECOMM",		"Comment only");
define("_MD_AMR_CAPRATE",			"Rating:");
define("_MD_AMR_CAPRATESLT",		"Select a rating");
define("_MD_AMR_CAPRATE1",			"*");
define("_MD_AMR_CAPRATE2",			"* *");
define("_MD_AMR_CAPRATE3",			"* * *");
define("_MD_AMR_CAPRATE4",			"* * * *");
define("_MD_AMR_CAPRATE5",			"* * * * *");
define("_MD_AMR_FRMCAPSDTTL",		"Subject:");
define("_MD_AMR_COMMENTTXT",		"Comments:");
define("_MD_AMR_RATESUBMIT",		"Submit");
define("_MD_AMR_RATERESET",			"Reset");
*/

/**
* Print.php
*/
define("_MD_AMR_PRINTAUTHOR",	"Reviewed by:");
define("_MD_AMR_PRINTPUBBY",	"Review published on:");


// email.php
define("_MD_EMAILHEADTTL", 		"E-mail Event to friend");
define("_MD_EMAILYOURNAME",		"Your name:");
define("_MD_EMAILYOUREMAIL",	"Your e-mail:");
define("_MD_EMAILRECIPIENT",	"Recipient:");
define("_MD_EMAILMESSAGE",		"Your message:");
define("_MD_EMAILMESSAGEDESC",	"This will be included in the e-mail.");
define("_MD_EMAILSEND",			"send");
define("_MD_EMAILSET",			"reset");
define("_MD_EMAILSECNOTE",		"<strong>Please note:</strong> Some security information will be sent along with the e-mail to help trace anyone who abuses this service."); 
define("_MD_EMAILNOTON",		"This feature is not enabled.");


// makepdf.php and associated
define("_MD_PDFPOSTEDON",		"Posted on: ");
define("_MD_PDFPAGE",			"Page");



?>