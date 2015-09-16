<?php
// $Id: functions.inc.php,v 1.5 2007/01/24 19:15:59 andrew Exp $
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

function amrev_adminfooter() {
global $xoopsModule;
    
    echo "<span style=\"font-size: smaller;\">";
    echo "<br />";
    //echo $xoopsModule->getVar('name') . ", version " . round($xoopsModule->getVar('version')/100 , 2) . "<br />";
    echo $xoopsModule->getVar('name') . ", version " . _AM_AMRVERSION . "<br />";
    echo "Updates are available from <a href=\"http://support.sirium.net\" target=\"_blank\">http://support.sirium.net</a>";
    echo "</span>";
       
} // end functions


//----------------------------------------------------------------------------//

/**
* Do some basic file checks and stuff.
*/
function amr_filechecks() {
global $xoopsModule, $xoopsConfig;

	echo "<fieldset>";
	echo "<legend style=\"color: #990000; font-weight: bold;\">" . _AM_AMREV_FILECHECKS . "</legend>";

	$photodir = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos";
	$photothumbdir = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos/thumb";
	$photohighdir = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos/highlight";
	$cachedir = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/cache";
	$tmpdir = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/cache/tmp";

	if(file_exists($photodir)) {
		if (!is_writable($photodir)) {
			echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $photodir . "<br />";
		} else {
			echo "<span style=\" color: green; font-weight: bold;\">OK:</span> " . $photodir . "<br />";
		}
	} else {
		echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> " . $photodir . " does NOT exist!<br />";
	}
	// photothumbdir
	if(file_exists($photothumbdir)) {
		if (!is_writable($photothumbdir)) {
			echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $photothumbdir . "<br />";
		} else {
			echo "<span style=\" color: green; font-weight: bold;\">OK:</span> " . $photothumbdir . "<br />";
		}
	} else {
		echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> " . $photothumbdir . " does NOT exist!<br />";
	}
	// photohighdir
	if(file_exists($photohighdir)) {
		if (!is_writable($photohighdir)) {
			echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $photohighdir . "<br />";
		} else {
			echo "<span style=\" color: green; font-weight: bold;\">OK:</span> " . $photohighdir . "<br />";
		}
	} else {
		echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> " . $photohighdir . " does NOT exist!<br />";
	}
	// cachedir
	if(file_exists($cachedir)) {
		if (!is_writable($cachedir)) {
			echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $cachedir . "<br />";
		} else {
			echo "<span style=\" color: green; font-weight: bold;\">OK:</span> " . $cachedir . "<br />";
		}
	} else {
		echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> " . $cachedir . " does NOT exist!<br />";
	}
	// tmpdir
	if(file_exists($tmpdir)) {
		if (!is_writable($tmpdir)) {
			echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> I am unable to write to: " . $tmpdir . "<br />";
		} else {
			echo "<span style=\" color: green; font-weight: bold;\">OK:</span> " . $tmpdir . "<br />";
		}
	} else {
		echo "<span style=\" color: red; font-weight: bold;\">Warning:</span> " . $tmpdir . " does NOT exist!<br />";
	}
	

	/**
	* Some info.
	*/
	$uploads = (ini_get('file_uploads')) ? _AM_AMREV_UPLOAD_ON : _AM_AMREV_UPLOAD_OFF;
	echo "<br />";
	echo "<ul>";
	echo "<li>" . _AM_AMREV_UPLOADMAX ."<b>". ini_get('upload_max_filesize') . "</b></li>";
	echo "<li>" . _AM_AMREV_POSTMAX ."<b>". ini_get('post_max_size') . "</b></li>";
	echo "<li>" . _AM_AMREV_UPLOADS ."<b>". $uploads . "</b></li>";

	$gdinfo = gd_info();
	if(function_exists('gd_info')) {
		echo "<li>" . _AM_AMREV_GDIMGSPPRT  ."<b>". _AM_AMREV_GDIMGON ."</b></li>";
		echo "<li>". _AM_AMREV_GDIMGVRSN ."<b>". $gdinfo['GD Version'] . "</b></li>";
	} else {
		echo "<li>" . _AM_AMREV_GDIMGSPPRT  ."<b>". _AM_AMREV_GDIMGOFF ."</b></li>";
	}
	echo "</ul>";

	//$inithingy = ini_get_all();
	//print_r($inithingy);

	echo "</fieldset>";

} // end function

//----------------------------------------------------------------------------//

function amr_summary() {
global $xoopsDB;

	// amreview_reviews - amreview_cat - amreview_rate

	$summary = array();

	/**
	* As many of these will be "joined" at some point.
	*/

	/**
	* Review count (total)
	*/
	$result = $xoopsDB->query("SELECT COUNT(id) AS revcount FROM " .$xoopsDB->prefix('amreview_reviews') . " ");
	list($revcount) = $xoopsDB->fetchRow($result);// {

		if (!$result) { $summary['revcount'] = 0; }
		else { $summary['revcount'] = $revcount; }

	/**
	* Waiting validation.
	*/
	$result2 = $xoopsDB->query("SELECT COUNT(id) AS waitval FROM " .$xoopsDB->prefix('amreview_reviews') . " WHERE validated='0'");
	list($waitval) = $xoopsDB->fetchRow($result2);// {
		
		if ($waitval < 1) { $summary['waitval'] = "<span style=\"font-weight: bold;\">0</span>"; }
		else { $summary['waitval'] = "<span style=\"font-weight: bold; color: red;\">" . $waitval . "</span>"; }

	/**
	* Category count (total)
	*/
	$result = $xoopsDB->query("SELECT COUNT(id) AS catcount FROM " .$xoopsDB->prefix('amreview_cat') . " ");
	list($catcount) = $xoopsDB->fetchRow($result);// {

		if (!$result) { $summary['catcount'] = 0; }
		else { $summary['catcount'] = $catcount; }
	unset($result);

	/**
	* Views count (total)
	*/
	$result = $xoopsDB->query("SELECT SUM(views) AS views FROM " .$xoopsDB->prefix('amreview_reviews') . " ");
	list($views) = $xoopsDB->fetchRow($result);// {

		if (!$result) { $summary['views'] = 0; }
		else { $summary['views'] = $views; }
	unset($result);
	
	/**
	* Published (total)
	*/
	$result = $xoopsDB->query("SELECT count(id) AS published FROM " .$xoopsDB->prefix('amreview_reviews') . " WHERE showme='1' AND validated='1'");
	list($published) = $xoopsDB->fetchRow($result);// {

		if (!$result) { $summary['published'] = 0; }
		else { $summary['published'] = $published; }
	unset($result);
	
	/**
	* Hidden (total)
	*/
	$result = $xoopsDB->query("SELECT count(id) AS hidden FROM " .$xoopsDB->prefix('amreview_reviews') . " WHERE showme='0' OR validated='0'");
	list($hidden) = $xoopsDB->fetchRow($result);// {

		if (!$result) { $summary['hidden'] = 0; }
		else { $summary['hidden'] = $hidden; }
	unset($result);
	

	//print_r($summary);
	return $summary;

} // end function

//----------------------------------------------------------------------------//

################################################################################
# Get form wysiwyg editor - based on function in news 1.4(?), and sampleform.inc.php.
# Width & height passed through are for 2.0.* version.
function amreviews_getwysiwygform($caption, $name, $value = "", $width = "100%", $height = '400px', $formrows = "20", $formcols = "50", $config = "") {
global $xoopsModuleConfig;
	
	$editor = false;
	$x22=false;
	$xv=str_replace('XOOPS ','',XOOPS_VERSION);
	if(substr($xv,2,1)=='2') {
		$x22=true;
	}

	// options for the editor
	//required configs
	$editor_options['name']		= $name;
	$editor_options['value']	= $value;
	//optional configs
		$editor_options['rows']		= $formrows; // default value = 5
		$editor_options['cols']		= $formcols; // default value = 50
		$editor_options['width']	= $width; // default value = 100%
		$editor_options['height']	= $height; // default value = 400px	
	
	// Want to choose which editor config to use, depending on whether user or admin side.
	if ($config == "user") { $whichconfig = $xoopsModuleConfig['articleedituser']; }
	else { $whichconfig = $xoopsModuleConfig['amrevieweditadmin']; }
	
	switch($whichconfig){
	case "0": // xoops' default dhtml
		if(!$x22) {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['cols']);
			#}
		} else {
			$editor = new XoopsFormEditor($caption, "dhtml", $editor_options);
		}
		break;
	case "1": // spaw
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/spaw/formspaw.php")) {
				include_once XOOPS_ROOT_PATH . "/class/spaw/formspaw.php";
				$editor = new XoopsFormSpaw($caption, $name, $value, $width, $height);
			} else {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
			}
		} else {
			$editor = new XoopsFormEditor($caption, "spaw", $editor_options);
		}
		break;
	case "2": // fck editor
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/fckeditor/formfckeditor.php")) {
				include_once(XOOPS_ROOT_PATH . "/class/fckeditor/formfckeditor.php");
				$editor = new XoopsFormFckeditor($caption, $name, $value, $width, $height);
			} else {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
			}
		}
		else {
			$editor = new XoopsFormEditor($caption, "fckeditor", $editor_options);
		}
		break;
	case "3": // htmlarea
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php")) {
				include_once(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php");
				$editor = new XoopsFormHtmlarea($caption, $name, $value, $width, $height);
			} else {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
			}
		}
		else {
			$editor = new XoopsFormEditor($caption, "htmlarea", $editor_options);
		}
		break;
	case "4": // koivi (edkoivipath)
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/koivi/formwysiwygtextarea.php")) {
				include_once(XOOPS_ROOT_PATH . "/class/koivi/formwysiwygtextarea.php");
				$editor = new XoopsFormWysiwygTextArea($caption, $name, $value, $width, $height);
			} else {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
			}
		}
		else {
			$editor = new XoopsFormEditor($caption, "koivi", $editor_options);
		}
		break;
	case "5": // xoops compact/textarea
		if(!$x22) {
			$editor = new XoopsFormTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
		}
		else {
			$editor = new XoopsFormTextArea($caption, $name, $editor_options);
		}
		break;
	} // end switch
	
	return $editor;
	
} // end


//----------------------------------------------------------------------------//

/**
* See if an image file is in use by a review.
*/
function amr_checkImageInUse($image_file = "") {
global $xoopsDB;

	$sql = ("SELECT COUNT(image_file) AS count FROM " .$xoopsDB->prefix('amreview_reviews') . 
	" WHERE image_file='". $image_file ."'");
	$result=$xoopsDB->query($sql);
	
		if ($xoopsDB->getRowsNum($result) > 0) {
			while($myrow = $xoopsDB->fetchArray($result)) {
				$count = $myrow['count'];
			}
		}
		else {
			$count = 0;
		}
		return $count;


} // end function








?>