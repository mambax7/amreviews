<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author          trabis <lusopoemas@gmail.com>
 * @author          mamba <mabax7@gmail.com>
 * @param $params
 * @param $smarty
 */

function smarty_function_translate($params, $smarty)
{
    /**
     * @param $params
     * @param $smarty
     * @return mixed
     */
    function smarty_function_translate($params, $smarty)
    {
        $key     = $params['key'] ?? '';
        $dirname = $params['dir'] ?? ''; //Mtools
        $utility = '\\Xoopsmodules\\' . ucfirst($dirname) . '\\Utility';
        return $utility::translate($key, $dirname);
    }
}
