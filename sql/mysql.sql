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
  `id`              INT(5)       NOT NULL AUTO_INCREMENT,
  `cat_parentid`    INT(5)       NOT NULL DEFAULT '0',
  `cat_title`       VARCHAR(100) NOT NULL DEFAULT '0',
  `cat_description` TEXT         NOT NULL,
  `cat_weight`      INT(5)       NOT NULL DEFAULT '0',
  `cat_showme`      INT(5)       NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;

#--
#-- Dumping data for table `<prefix>_amreview_cat`
#--

INSERT INTO `amreviews_cat` VALUES (1, 0, 'Example category', 'This is an example category.', 0, 1);


#-- --------------------------------------------------------

#--
#-- Table structure for table `<prefix>_amreview_reviews`
#-- 

CREATE TABLE `amreviews_reviews` (
  `id`           INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`          INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid`        INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `weight`       INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`        VARCHAR(100)              DEFAULT NULL,
  `subtitle`     VARCHAR(100)              DEFAULT NULL,
  `image_file`   VARCHAR(100)              DEFAULT NULL,
  `image_align`  CHAR(1)          NOT NULL DEFAULT 'L',
  `our_rating`   VARCHAR(5)       NOT NULL DEFAULT '0',
  `reviewer_ip`  VARCHAR(20)      NOT NULL DEFAULT '000.000.000.000',
  `teaser`       TEXT,
  `item_details` TEXT,
  `review`       TEXT,
  `keywords`     TEXT,
  `date`         DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_publish` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `date_end`     INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `views`        INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `pagetitle`    INT(5) UNSIGNED  NOT NULL DEFAULT '0',
  `metaheaders`  INT(5) UNSIGNED  NOT NULL DEFAULT '0',
  `comments`     ENUM('0', '1')   NOT NULL DEFAULT '1',
  `notify`       ENUM('0', '1')   NOT NULL DEFAULT '0',
  `validated`    ENUM('0', '1')   NOT NULL DEFAULT '0',
  `showme`       ENUM('0', '1')   NOT NULL DEFAULT '0',
  `highlight`    ENUM('0', '1')   NOT NULL DEFAULT '0',
  `nohtml`       ENUM('0', '1')   NOT NULL DEFAULT '1',
  `nosmiley`     ENUM('0', '1')   NOT NULL DEFAULT '1',
  `noxcode`      ENUM('0', '1')   NOT NULL DEFAULT '1',
  `noimage`      ENUM('0', '1')   NOT NULL DEFAULT '1',
  `nobr`         ENUM('0', '1')   NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;


#-- --------------------------------------------------------

#-- 
#-- Table structure for table `<prefix>_amreview_rate`
#-- 

CREATE TABLE `amreviews_rate` (
  `id`                INT(5)       NOT NULL AUTO_INCREMENT,
  `rate_review_id`    INT(5)       NOT NULL DEFAULT '0',
  `rate_rating`       INT(5)       NOT NULL DEFAULT '0',
  `rate_uid`          INT(5)       NOT NULL DEFAULT '0',
  `rate_user_ip`      VARCHAR(20)  NOT NULL DEFAULT '0',
  `rate_user_browser` VARCHAR(50)  NOT NULL DEFAULT '0',
  `rate_title`        VARCHAR(100) NOT NULL DEFAULT '0',
  `rate_text`         TEXT         NOT NULL,
  `rate_datetime`     DATETIME     NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rate_showme`       INT(5)       NOT NULL DEFAULT '1',
  `rate_validated`    INT(5)       NOT NULL DEFAULT '0',
  `rate_useful`       VARCHAR(20)  NOT NULL DEFAULT '0/0',
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;

