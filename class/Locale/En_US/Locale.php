<?php namespace XoopsModules\Amreviews\Locale\En_US;

//use XoopsModules\Amreviews\Locale;

//require_once  __DIR__ . '/en_US.php';
use function constant;
use function defined;

/**
 * Class Locale
 * @package XoopsModules\Amreviews\Locale
 */
class Locale implements En_US, Blocks, Blocksadmin, Common, Directorychecker, Filechecker, Feedback
{
    public const FALLBACK_LOCALE = 'en_US';

    /**
     * @param $key
     * @return mixed
     */
    public static function getValue($key)
    {
        //        return constant('self::'. $key);
        if (defined('self::' . $key)) {
            return constant('self::' . $key);
        }

        if (defined($key)) {
            return constant($key);
        }
        return $key;
    }


}
