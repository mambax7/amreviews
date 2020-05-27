<?php

declare(strict_types=1);

namespace XoopsModules\Amreviews\Common;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: Amreviews
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 */

use XoopsModules\Amreviews\Helper;

/**
 * Trait ServerStats
 * @package XoopsModules\Amreviews\Common
 */
trait ServerStats
{
    /**
     * serverStats()
     *
     * @return string
     */
    public static function getServerStats()
    {
        $helper = Helper::getInstance();
        $lang   = $helper->getLanguage();
        $html   = '';
        $html   .= '<fieldset>';
        $html   .= "<legend style='font-weight: bold; color: #900;'>" . $lang::IMAGEINFO . '</legend>';
        $html   .= "<div style='padding: 8px;'>";
        $html   .= '<div>' . $lang::SPHPINI . '</div>';
        $html   .= '<ul>';

        $gdlib = \function_exists('gd_info') ? '<span style="color: #008000;">' . $lang::GDON . '</span>' : '<span style="color: #ff0000;">' . $lang::GDOFF . '</span>';
        $html  .= '<li>' . $lang::GDLIBSTATUS . $gdlib;
        if (\function_exists('gd_info')) {
            if (true === ($gdlib = gd_info())) {
                $html .= '<li>' . $lang::GDLIBVERSION . '<b>' . $gdlib['GD Version'] . '</b>';
            }
        }

        $downloads = \ini_get('file_uploads') ? '<span style="color: #008000;">' . $lang::ON . '</span>' : '<span style="color: #ff0000;">' . $lang::OFF . '</span>';
        $html      .= '<li>' . $lang::SERVERUPLOADSTATUS . $downloads;

        $html .= '<li>' . $lang::MAXUPLOADSIZE . ' <b><span style="color: #0000ff;">' . \ini_get('upload_max_filesize') . '</span></b>';
        $html .= '<li>' . $lang::MAXPOSTSIZE . ' <b><span style="color: #0000ff;">' . \ini_get('post_max_size') . '</span></b>';
        $html .= '<li>' . $lang::MEMORYLIMIT . ' <b><span style="color: #0000ff;">' . \ini_get('memory_limit') . '</span></b>';
        $html .= '</ul>';
        $html .= '<ul>';
        $html .= '<li>' . $lang::SERVERPATH . ' <b>' . XOOPS_ROOT_PATH . '</b>';
        $html .= '</ul>';
        $html .= '<br>';
        $html .= $lang::UPLOADPATHDSC . '';
        $html .= '</div>';
        $html .= '</fieldset><br>';

        return $html;
    }
}
