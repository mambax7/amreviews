<?php
// $Id: image.php,v 1.5 2007/01/24 19:15:59 andrew Exp $
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
include_once 'admin_header.php';

include_once("functions.inc.php");
include_once("../include/config.inc.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopstree.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopslists.php");
include_once (XOOPS_ROOT_PATH . "/class/xoopsformloader.php");
include_once ("../class/image_resizerGD.class.php");

$myts =& MyTextSanitizer::getInstance(); 
$thumbnail = new thumbnails();

//----------------------------------------------------------------------------//

if (!isset($_REQUEST['op'])) {

xoops_cp_header();

//echo XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . $destfilename;
//echo XOOPS_ROOT_PATH ."/modules/".  _AM_AMRMODDIR . "/cache/";

/**
* Image upload.
*/

/**
* Initialise form.
*/
$imageform = new XoopsThemeForm(_AM_AMREV_IMGUPLOAD, "imageform", xoops_getenv('PHP_SELF'), 'post');
$imageform->setExtra('enctype="multipart/form-data"');


/**
* File requester.
*/ //
//$uploadreq = new XoopsFormFile('', 'uploadfile', $xoopsModuleConfig['maxuploadadmin']*1024);
$uploadreq = new XoopsFormFile('', 'uploadfile', 0);
$uploadFN = new XoopsFormCheckBox("", 'formdata[filename]', 1);
$uploadFN->addOption(1, _AM_AMREV_IMGUPLOADFN);
$uploadlab1 = new XoopsFormLabel(_AM_AMREV_IMGUPLOADFNL, $xoopsModuleConfig['photopath']);
$uploadlab2 = new XoopsFormLabel(_AM_AMREV_IMGUPLOADTMP, "/modules/".  _AM_AMRMODDIR . "/cache/tmp/");
$uploadmax =  new XoopsFormLabel(_AM_AMREV_IMGUPLOADMAX, $xoopsModuleConfig['maxuploadadmin']."Kb");
$uploadnote =  new XoopsFormLabel('', 'This will also create thumbnail and highlight images');
$uptray = new XoopsFormElementTray(_AM_AMREV_IMGUPFILE, '<br />');
$uptray->addElement($uploadreq);
$uptray->addElement($uploadFN);
$uptray->addElement($uploadlab2);
$uptray->addElement($uploadlab1);
$uptray->addElement($uploadmax);
$uptray->addElement($uploadnote);
$imageform->addElement($uptray);
unset($uploadreq);

/**
* Default highlight width
*/
$hiwidth = new XoopsFormText('', 'formdata[hiwidth]', 4, 4, $xoopsModuleConfig['imghighwdith']);
$hiwidthlab1 = new XoopsFormLabel('', '');
$hitray = new XoopsFormElementTray(_AM_AMREV_HIWIDTH, '<br />');
$hitray->addElement($hiwidth);
$hitray->addElement($hiwidthlab1);
$imageform->addElement($hitray);


/**
* Default thumbnail width
*/
$thumbwidth = new XoopsFormText(_AM_AMREV_THUMBWIDTH, 'formdata[thumbwidth]', 4, 4, $xoopsModuleConfig['imgthumbwdith']);
$imageform->addElement($thumbwidth);


/**
* Hidden elements
*/
$imageform->addElement(new XoopsFormHidden('op', 'upload'));


/**
* Add/submit category button
*/
$button_sub = new XoopsFormButton('', 'but_save', _AM_AMREV_IMGUPBUTTON, 'submit');
$button_tray = new XoopsFormElementTray('');
$button_tray->addElement($button_sub);
$imageform->addElement($button_tray);

/**
* End - Display form
*/
$imageform->display();

echo "<br />";

//----------------------------------------------------------------------------//

/**
* Image edit
*
*/


/**
* Show images to delete
*/

$imgdelform = new XoopsThemeForm(_AM_AMREV_DELIMG, "imgform", xoops_getenv('PHP_SELF'), 'post');

#if (isset($image_file)) { $image_file = $image_file;  }
#	else { $image_file = ""; }
$image_array =& XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/thumb/");
$image_select = new XoopsFormSelect('', 'formdata[image_file]', "");
$image_select->addOption ('-1', '---------------');
$image_select->addOptionArray($image_array);
$image_select->setExtra("onchange='showImgSelected(\"photo\", \"formdata[image_file]\", \"modules/amreviews/photos/thumb/\", \"\", \"".XOOPS_URL."\")'");
$image_label = new XoopsFormLabel("", "<img src='images/avatar/blank.gif' name='photo' id='photo' alt='' />");

$image_tray = new XoopsFormElementTray(_AM_AMREV_SELECTIMGCAP, "<br /><br />");
$image_tray->addElement($image_select);
$image_tray->addElement($image_label);
$imgdelform -> addElement($image_tray);
/**
* Hidden elements
*/
$imgdelform->addElement(new XoopsFormHidden('op', 'delimage'));

/**
* submit button
*/
$delbutton_sub = new XoopsFormButton('', 'but_save', _AM_AMREV_DELIMAGEBUT, 'submit');
$deltray = new XoopsFormElementTray('');
$deltray->addElement($delbutton_sub);
$imgdelform->addElement($deltray);

/**
* End - Display form
*/
$imgdelform->display();


amrev_adminfooter();
include_once 'admin_footer.php';
} // end if


//----------------------------------------------------------------------------//

if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "upload") {

xoops_cp_header();

	#if (isset($_REQUEST['uploadfile'])) { $uploadfile = $_REQUEST['uploadfile']; }
	#	else { $uploadfile = ""; }
	
	if (isset($_POST['formdata'])) { $formdata = $_POST['formdata']; }
		else { $formdata = ""; }

	//echo "<pre>";
	//print_r($uploadfile);
	//print_r($_FILES['uploadfile']);
	//print_r($_FILES);
	print_r($formdata);
	//exit;
	//echo "</pre>";
	
	//echo XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . $destfilename;
	
	$sourcefile = $_FILES['uploadfile']['tmp_name'];
	$destTempFile = "";
	
		if (($sourcefile != 'none') && ($sourcefile != '' )) {
			$imagesize = getimagesize($sourcefile);
			//echo "ok so far<br>";
			//print_r($imagesize);
			
			switch ( $imagesize[2] ) { 
				case 0: 
					echo "<p id=\"addmessage\">Error: Unsupported file type.</p>"; 
					$fileerror = 1;
				break; 
				case 1: 
					//echo '<BR> Image is a GIF <BR>'; 
					if (isset($formdata['filename'])) {
						$destfilename = $_FILES['uploadfile']['name'];
						//$destinationfile = GALLERY_UPLOAD_PATH . $filename;
					} else {
						$destfilename = uniqid('img').'.gif';
						//$destinationfile = GALLERY_UPLOAD_PATH . uniqid('img').'.gif';
					}
					//$destinationfile = XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/" . $destfilename;
				break; 
				case 2: 
					//echo '<BR> Image is a JPG <BR>';
					if (isset($formdata['filename'])) {
						$destfilename = $_FILES['uploadfile']['name'];
						//$destinationfile = GALLERY_UPLOAD_PATH . $filename;
					} else {
						$destfilename = uniqid('img').'.jpg';
						//$destinationfile = GALLERY_UPLOAD_PATH . uniqid('img').'.jpg';
					}
					//$destinationfile = XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/" . $destfilename;
				break; 
				case 3: 
					//echo '<BR> Image is a PNG <BR>'; 
					//$destinationfile = GALLERY_UPLOAD_PATH.uniqid('img').'.png'; 
					if (isset($formdata['filename'])) {
						$destfilename = $_FILES['uploadfile']['name'];
						//$destinationfile = GALLERY_UPLOAD_PATH . $filename;
					} else {
						$destfilename = uniqid('img').'.png';
						//$destinationfile = GALLERY_UPLOAD_PATH . uniqid('img').'.png';
					}
					//$destinationfile = XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/" . $destfilename;
				break; 
        } // switch

        
        /**
        * Create local path and filename for local temp.
        */
        $destTempFile = XOOPS_ROOT_PATH ."/modules/".  _AM_AMRMODDIR . "/cache/tmp/". $destfilename;
        
        /**
        * Final destination path and filename.
        */
        $destinationfile = XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/" . $destfilename;

		} // end if
		else {
			echo "<p id=\"addmessage\">Error: photo not uploaded.</p>";
			$fileerror = 1;
			if ($_FILES['imagefile']['error'] != "") {
				fileerrormsg($_FILES['imagefile']['error']);
			}
			exit;
		}
	
		/**
		* move from system /tmp to local temp directory
		*/
		if ($destTempFile != '') { 
			if (!move_uploaded_file($sourcefile, $destTempFile)) { 
				//echo 'File saved to local temp dir. ('. $destinationfile .')<BR>'; 
				echo "<p><b>Notice:</b> File could not be moved to local temp dir.</p><br>";
				$fileerror = 1;
			} //else { 
				//echo 'File could not be saved to local temp dir.<BR>'; 
			//}
			/**
			* chmod temp file, or user may not be able to do stuff to it.
			*/
			if (!chmod($destTempFile, 0644)) {
				echo "<p><b>Notice:</b> I was unable to change the temp file's permissions.</p>";
			}
		} // end if
	

		if (!file_exists($destinationfile)) {
			//if not in photo dir, copy and delete from local temp
			//echo "does not exist" . $destinationfile;
			// copy to photo dir
			if (!copy($destTempFile, $destinationfile)) {
				echo "<p>Sorry, I was unable to copy the uploaded file from: <br>". $destTempFile ." <br>to:<br> ".  $destinationfile ."</p>";
				$fileerror = 1;
			} else {
			// if copy worked, delete local temp copy of file.
				if(!unlink($destTempFile)) {
					echo "I was unable to delete the temp copy of the uploaded file:<br>" . $destTempFile;
				}
			}
		} 
		else {
			// if it is in photo dir, give option to do stuff
			$destfilename = uniqid('img').'.jpg';
			if (copy($destinationfile, XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/" . $destfilename)) {
				//echo "<p>Sorry, I was unable to copy the uploaded file from: <br>". $destinationfile ." <br>to:<br> ". GALLERY_IMAGE_PATH . $destfilename ."</p>";
				echo "<p><b>Notice:</b> The file name \"<b>" .$destfilename ."</b>\" already exists in the photo directory, so I have renamed it to \"<b>". $destfilename ."</b>\"</p>";
				// delete temporary local file
				if(!unlink($destTempFile)) {
					echo "I was unable to delete the temp copy of the uploaded file:<br>" . $destTempFile;
				}
			} // if
		} // else
		
		
		/**
		* generate resized images
		* ("path", "thumbnail path", "filename of photo", "width for thumbnail", bool add _tn)
		*/
		// call thumbnail class
		$thumb = $thumbnail->create(XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/", XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/thumb/", $destfilename, $formdata['thumbwidth'], 0);
		// call thumbnail class
		$thumb2 = $thumbnail->create(XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/", XOOPS_ROOT_PATH . $xoopsModuleConfig['photopath'] . "/highlight/", $destfilename, $formdata['hiwidth'], 0);
		

		if (!isset($fileerror)) {
			if (isset($destfilenamechange)) {
				redirect_header("image.php", 2, _AM_AMREV_IMGUPLOADED);
				//echo "entered";
				//echo "<p id=\"addmessage\">Photo upload complete.</p>"; //$destfilenamechange
				//echo "<p style=\"text-align: center\">Return to <a href=\"image.php\">gallery</a>.</p>";
			} else {
				redirect_header("image.php", 2, _AM_AMREV_IMGUPLOADED);
				//echo "<p id=\"addmessage\">Photo upload complete.</p>";//$destfilename
				//echo "<p style=\"text-align: center\"><a href=\"add.php?op=detail&file=". $destfilename . "\">Add image</a> to gallery.</p>";
			}
		}





	# NOTES - do default image size in pixels. Keep filename, text box for 
	# new or random. See what error codes are from $_files[]
	# do gif image checking, or some may not be able to write/create

amrev_adminfooter();
xoops_cp_footer();
} // end if


//----------------------------------------------------------------------------//

if (isset($_REQUEST['op']) AND $_REQUEST['op'] == "delimage") {

//xoops_cp_header();

	/*
	if (isset($_REQUEST['formdata'])) { $formdata = $_REQUEST['formdata']; }
		else { $formdata = "";}
	
	$image_filename = $formdata['image_file'];
	
	// We want to see if the image is in use, so we can change the confirm message.
	if (amr_checkImageInUse($image_filename) == 0) { 
		#echo _AM_AMREV_IMGCONFDEL; 
		$confirm_msg = _AM_AMREV_IMGCONFDEL;
	}
	else { 
		#echo _AM_AMREV_IMGCONFDELIU; 
		#echo sprintf(_AM_AMREV_IMGCONFDELIU, amr_checkImageInUse($image_filename));
		$confirm_msg = sprintf(_AM_AMREV_IMGCONFDELIU, amr_checkImageInUse($image_filename));
	} */

	
	#if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); }
	#	else { $id = ""; }

	/**
	* Confirm deletion.
	*/
	if (!isset($_REQUEST['subop'])) {
		xoops_cp_header();
		
			// test
			#print_r($_POST);
		
			if (isset($_REQUEST['formdata'])) { $formdata = $_REQUEST['formdata']; }
			else { $formdata = "";}
	
			$image_filename = $formdata['image_file'];
	
			// We want to see if the image is in use, so we can change the confirm message.
			if (amr_checkImageInUse($image_filename) == 0) { 
				#echo _AM_AMREV_IMGCONFDEL; 
				$confirm_msg = _AM_AMREV_IMGCONFDEL;
			} else { 
				#echo _AM_AMREV_IMGCONFDELIU; 
				#echo sprintf(_AM_AMREV_IMGCONFDELIU, amr_checkImageInUse($image_filename));
				$confirm_msg = sprintf(_AM_AMREV_IMGCONFDELIU, amr_checkImageInUse($image_filename));
			}
		
		xoops_confirm(array('op' => 'delimage', 'image_file' => $image_filename, 'subop' => 'delok'), 'image.php', $confirm_msg);
		
		xoops_cp_footer();
	} // end if
	
	/**
	* Delete
	*/
	if (isset($_REQUEST['subop']) && $_REQUEST['subop'] == "delok") {
		xoops_cp_header();
		
		// test
		#print_r($_POST);

		if (isset($_REQUEST['image_file'])) { $image_file = $_REQUEST['image_file']; }
			else { $image_file = ""; }
		
		
		$photomain = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos/" . $image_file;
		$photothumb = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos/thumb/" . $image_file;
		$photohigh = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar('dirname') . "/photos/highlight/" . $image_file;
		
		echo "<div style=\"font-family: courier;\">";
		echo _AM_AMREV_IMGDELETING . " " . $image_file . "<br />";
		if (@unlink($photomain)) {
			echo _AM_AMREV_IMGMAINDEL . " <span style=\"color: green;\">deleted</span><br />";
		} else {
			echo _AM_AMREV_IMGMAINDEL . " <span style=\"color: red;\">not deleted</span><br />";
			$imgerr=1;
		}
		if (@unlink($photothumb)) {
			echo _AM_AMREV_IMGHIGHDEL . " <span style=\"color: green;\">deleted</span><br />";
		} else {
			echo _AM_AMREV_IMGHIGHDEL . " <span style=\"color: red;\">not deleted</span><br />";
			$imgerr=1;
		}
		if (@unlink($photohigh)) {
			echo _AM_AMREV_IMGTHUMBDEL . " <span style=\"color: green;\">deleted</span><br />";
		} else {
			echo _AM_AMREV_IMGTHUMBDEL . " <span style=\"color: red;\">not deleted</span><br />";
			$imgerr=1;
		}
		echo "</div><br />";
		
		if (isset($imgerr)) {
			echo _AM_AMREV_IMGDELERR . "<br /><br />";
		}
		
		echo "<a href=\"image.php\">" . _AM_AMREV_IMGRETURN . "</a>";
		
	
		//$sql = sprintf("DELETE FROM %s WHERE id = %u", $xoopsDB->prefix("amreview_reviews"), $id);
	                
		#if ($xoopsDB->queryF($sql)) {
			//redirect_header("image.php", 2, _AM_AMREV_DBDELETED);
		#	echo "deleted";
		#} else {
			//redirect_header("image.php", 2, _AM_AMREV_DBNOTDELETED);
		#	echo "not deleted";
		#} //
		amrev_adminfooter();
		xoops_cp_footer();
	} //


//xoops_cp_footer();
} // end if


?>