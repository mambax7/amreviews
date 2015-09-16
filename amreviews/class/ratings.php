<?php namespace Xoopsmodules\amreviews;

    // $Id: ratings.php,v 1.2 2006/04/26 00:24:48 andrew Exp $
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
    //include_once("header.php");

/**
 * Class amrRatings
 */
class Ratings
{
    private $db;

    /**
     * @param $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * Get user rating of review.
     *
     * @param  string $id
     * @return array  - the rating and number to select which star image to use.
     * @rating - the actual rating, an average of all visible votes.
     * @rates  - The number of ratings.
     * @imgNum - The image to return, eg. 2.5 would be inserted into image name.
     */
    public function getRating($id = "0")
    {
        $sql    = ('SELECT COUNT(id) AS rates, AVG(rate_rating) AS rate_rating FROM ' . $this->db->prefix('amreviews_rate') . " WHERE rate_review_id = '" . $id . "' && rate_validated='1' && rate_showme='1'");
        $result = $this->db->query($sql);

        if ($this->db->getRowsNum($result) > 0) {
            while ($myrow = $this->db->fetchArray($result)) {
                $result           = array();
                $result['rating'] = round($myrow['rate_rating'], 1);
                $result['rates']  = $myrow['rates'];

                /**
                 * Return value to use with rate image.
                 * rate_image
                 */
                if ($result['rating'] < 0.01) {
                    $result['imgNum'] = '0';
                }
                if ($result['rating'] >= 0.01 && $result['rating'] <= 0.74) {
                    $result['imgNum'] = '0.5';
                }
                if ($result['rating'] >= 0.75 && $result['rating'] <= 1.24) {
                    $result['imgNum'] = '1';
                }
                if ($result['rating'] >= 1.25 && $result['rating'] <= 1.74) {
                    $result['imgNum'] = '1.5';
                }
                if ($result['rating'] >= 1.75 && $result['rating'] <= 2.24) {
                    $result['imgNum'] = '2';
                }
                if ($result['rating'] >= 2.25 && $result['rating'] <= 2.74) {
                    $result['imgNum'] = '2.5';
                }
                if ($result['rating'] >= 2.75 && $result['rating'] <= 3.24) {
                    $result['imgNum'] = '3';
                }
                if ($result['rating'] >= 3.25 && $result['rating'] <= 3.74) {
                    $result['imgNum'] = '3.5';
                }
                if ($result['rating'] >= 3.75 && $result['rating'] <= 4.24) {
                    $result['imgNum'] = '4';
                }
                if ($result['rating'] >= 4.25 && $result['rating'] <= 4.74) {
                    $result['imgNum'] = '4.5';
                }
                if ($result['rating'] >= 4.75 && $result['rating'] <= 5) {
                    $result['imgNum'] = '5';
                }
            } // while
        } else {
            $result['rating'] = 0;
            $result['rates']  = 0;
            $result['imgNum'] = 0;
        }

        return $result;
    } // end function
} // end class

