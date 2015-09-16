<?php namespace Xoopsmodules\amreviews;

    // $Id: image_resizerGD.class.php,v 1.1 2006/04/26 00:25:06 andrew Exp $
    //  ------------------------------------------------------------------------ //
    //  Author: Andrew Mills                                                     //
    //  Email:  ajmills@sirium.net                                               //
    //  About:                                                                   //
    //  Copyright:  Copyright � 2003-2006 Andrew Mills.                          //
    //                                                                           //
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

    // generate image thumbnails

/**
 * Class thumbnails
 */
class Thumbnails
{
    /**
     * @param             $photopath
     * @param             $thumbnailpath
     * @param             $filename
     * @param  string     $thumbwidth
     * @param  string     $extention
     * @return array|bool
     */
    public function create($photopath, $thumbnailpath, $filename, $thumbwidth = '180', $extention = '1')
    {
        //$error = 0;
        //header("Content-type: image/jpeg'); // use for direct output
        $image = $photopath . '/' . $filename; // erm, filenname
        if (!file_exists($image) || !is_readable($image)) {
            // send error and stuff (code, other data, in this case, file)
            $error = $this->show_errors('Unable to read input image.');

            return (false);
        }

        $imagesize = getimagesize($image); # find image dimensions - was IMGsize

        // create path and filename for the thumbnail
        $thumbfilenamepart = explode('.', $filename);
        if ($extention === 1) {
            $thumbfilename = $thumbfilenamepart[0] . '_tn';// . $thumbfilenamepart[1];
        } else {
            $thumbfilename = $thumbfilenamepart[0];
        }
        $thumbnail = $thumbnailpath . $thumbfilename;

        # use width to work out height (keeping aspect ratio)
        $percentage  = $thumbwidth / $imagesize[0]; // was PERcent
        $thumbheight = round($percentage * $imagesize[1], 0); // was YOURheight

        // imagecreate creates images with missing colours with gd2
        // use truecolour version instead - supported in php 4.0.6
        // and later.
        //$NEWimg     = imagecreate($YOURwidth,$YOURheight); // GD1 - won't work as expected with GD2
        //$NEWimg     = imagecreatetruecolor($YOURwidth,$YOURheight); // use with GD2
        //$OLDimg     = imagecreatefromjpeg($image);
        // Replace code above - automatically choose  function depending upon version
        // of the GD library available.
        $gd2 = $this->checkgd();
        if ($gd2) {
            $newimage = imagecreatetruecolor($thumbwidth, $thumbheight);
        } else {
            $newimage = imagecreate($thumbwidth, $thumbheight);
        }

        // create from jpg
        if ($imagesize['mime'] === 'image/jpeg') {
            $oldimage = imagecreatefromjpeg($image);
        }
        if ($imagesize['mime'] === 'image/png') {
            $oldimage = imagecreatefrompng($image);
        }
        // create from gif, requires pre 1.6 or 2.0.28 and later
        $gdinfo = gd_info();
        if (($imagesize['mime'] === 'image/gif') && ($gdinfo['GIF Read Support'])) {
            $oldimage = imagecreatefromgif($image);
        }

        imagecopyresized($newimage, $oldimage, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imagesize[0], $imagesize[1]);
        // or try ImageCopyResampled() for the above, and possibly ImageCreateTrueColor()
        // requires GD > 2.0
        //ImageCopyResampled($NEWimg, $OLDimg,0,0,0,0,$YOURwidth,$YOURheight,$IMGsize[0],$IMGsize[1]);

        // send to file or browser http://uk.php.net/manual/en/function.imagejpeg.php
        if (is_writable($thumbnailpath)) {
            if (file_exists($thumbnail . '.jpg')) {
                $rand          = substr(md5(time()), 0, 5);
                $thumbfilename = $thumbfilename . '_' . $rand . '.jpg';
                $thumbfile     = $thumbnailpath . $thumbfilename;
                imagejpeg($newimage, $thumbfile, 75);
            } else {
                $thumbfilename = $thumbfilename . '.jpg';
                $thumbfile     = $thumbnailpath . $thumbfilename;
                imagejpeg($newimage, $thumbfile, 75);
            }
        } else {
            $this->show_errors('Unable to write thumbnail.');

            return (false);
        }

        //echo $thumbfilename;

        // destroy old image, otherwise it will eat server memory!
        imagedestroy($oldimage);

        // return thumbnail's width, height, filename
        $thumbinfo = array('thumbwidth' => $thumbwidth, 'thumbheight' => $thumbheight, 'thumbnail' => $thumbfilename);

        //print_r($thumbinfo);
        return ($thumbinfo);
    } // end create()

    /**
     * @param $error
     * @return bool
     */
    public function show_errors($error)
    {
        echo "<span style=\"color: red;\">Thumbnail class error: " . $error . '</span>';

        //return(array('error' => '1', 'thumbnail' => ''));
        return (false);
        exit;
    } // end function

    // function to check GD version
    /**
     * @return string
     */
    public function checkgd()
    {
        $gd2 = '0';
        ob_start();
        phpinfo(8);
        $phpinfo = ob_get_contents();
        ob_end_clean();
        $phpinfo = strip_tags($phpinfo);
        $phpinfo = stristr($phpinfo, 'gd version');
        $phpinfo = stristr($phpinfo, 'version');
        preg_match('/\d/', $phpinfo, $gd);
        if ($gd[0] === '2') {
            $gd2 = '1';
        }

        return ($gd2);
    } // end checkgd()
} // end class

