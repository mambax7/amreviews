<?php namespace XoopsModules\Amreviews\Locale;

use function constant;

require_once __DIR__ . '/fr_FR.php';

/**
 * Class Locale
 * @package XoopsModules\Amreviews\Locale
 */
class Locale implements fr_FR
{
    /**
     * @param $key
     * @return mixed
     */
    public static function getValue($key)
    {
        return constant('self::' . $key);
    }
}
