# $Id: mysql.sql,v 1.3 2007/01/24 19:21:07 andrew Exp $

#//  ------------------------------------------------------------------------ //
#//  Author: Andrew Mills                                                     //
#//  Email:  ajmills@sirium.net                                               //
#//	 About:  This file is part of the AM Reviews module for Xoops v2.         //
#//                                                                           //
#//  ------------------------------------------------------------------------ //
#//                XOOPS - PHP Content Management System                      //
#//                    Copyright (c) 2000 XOOPS.org                           //
#//                       <http://www.xoops.org/>                             //
#//  ------------------------------------------------------------------------ //
#//  This program is free software; you can redistribute it and/or modify     //
#//  it under the terms of the GNU General Public License as published by     //
#//  the Free Software Foundation; either version 2 of the License, or        //
#//  (at your option) any later version.                                      //
#//                                                                           //
#//  You may not change or alter any portion of this comment or credits       //
#//  of supporting developers from this source code or any supporting         //
#//  source code which is considered copyrighted (c) material of the          //
#//  original comment or credit authors.                                      //
#//                                                                           //
#//  This program is distributed in the hope that it will be useful,          //
#//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
#//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
#//  GNU General Public License for more details.                             //
#//                                                                           //
#//  You should have received a copy of the GNU General Public License        //
#//  along with this program; if not, write to the Free Software              //
#//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
#//  ------------------------------------------------------------------------ //


#--
#-- Table structure for table `<prefix>_amreview_cat`
#--

CREATE TABLE `amreviews_cat` (
  `id` int(5) NOT NULL auto_increment,
  `cat_parentid` int(5) NOT NULL default '0',
  `cat_title` varchar(100) NOT NULL default '0',
  `cat_description` text NOT NULL,
  `cat_weight` int(5) NOT NULL default '0',
  `cat_showme` int(5) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

#--
#-- Dumping data for table `<prefix>_amreview_cat`
#--

INSERT INTO `amreviews_cat` VALUES (1, 0, 'Example category', 'This is an example category.', 0, 1);


#-- --------------------------------------------------------

#--
#-- Table structure for table `<prefix>_amreview_reviews`
#-- 

CREATE TABLE `amreviews_reviews` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL default '0',
  `catid` int(10) unsigned NOT NULL default '0',
  `weight` int(10) unsigned NOT NULL default '0',
  `title` varchar(100) default NULL,
  `subtitle` varchar(100) default NULL,
  `image_file` varchar(100) default NULL,
  `image_align` char(1) NOT NULL default 'L',
  `our_rating` varchar(5) NOT NULL default '0',
  `reviewer_ip` varchar(20) NOT NULL default '000.000.000.000',
  `teaser` text,
  `item_details` text,
  `review` text,
  `keywords` text,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_publish` int(11) unsigned NOT NULL default '0',
  `date_end` int(11) unsigned NOT NULL default '0',
  `views` int(10) unsigned NOT NULL default '0',
  `pagetitle` int(5) unsigned NOT NULL default '0',
  `metaheaders` int(5) unsigned NOT NULL default '0',
  `comments` enum('0','1') NOT NULL default '1',
  `notify` enum('0','1') NOT NULL default '0',
  `validated` enum('0','1') NOT NULL default '0',
  `showme` enum('0','1') NOT NULL default '0',
  `highlight` enum('0','1') NOT NULL default '0',
  `nohtml` enum('0','1') NOT NULL default '1',
  `nosmiley` enum('0','1') NOT NULL default '1',
  `noxcode` enum('0','1') NOT NULL default '1',
  `noimage` enum('0','1') NOT NULL default '1',
  `nobr` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;


#-- --------------------------------------------------------

#-- 
#-- Table structure for table `<prefix>_amreview_rate`
#-- 

CREATE TABLE `amreviews_rate` (
  `id` int(5) NOT NULL auto_increment,
  `rate_review_id` int(5) NOT NULL default '0',
  `rate_rating` int(5) NOT NULL default '0',
  `rate_uid` int(5) NOT NULL default '0',
  `rate_user_ip` varchar(20) NOT NULL default '0',
  `rate_user_browser` varchar(50) NOT NULL default '0',
  `rate_title` varchar(100) NOT NULL default '0',
  `rate_text` text NOT NULL,
  `rate_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `rate_showme` int(5) NOT NULL default '1',
  `rate_validated` int(5) NOT NULL default '0',
  `rate_useful` varchar(20) NOT NULL default '0/0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

