<?php

namespace XoopsModules\Amreviews\Locale;

/**
 * Class LanguageFactory
 * @package XoopsModules\Amreviews\Locale
 */
class LanguageFactory
{
    public $langName;
    public const FALLBACK_LOCALE = 'en_US';

    /**
     * LanguageFactory constructor.
     * @param string $lang
     */
    public function __construct($lang = null)
    {
        $this->langName = $lang;
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        $className = __NAMESPACE__;
        return $className;
    }

    /**
     * @param null $name
     * @return string
     */
    public static function getLanguageByName($name = null)
    {
        if (null === $name) {
            $code = self::FALLBACK_LOCALE;
        } else {
            $code = self::getLocaleCode($name);
        }

        $className = __NAMESPACE__ . '\\' . \ucfirst($code) . '\Locale';

        return $className;
    }

    /**
     * @param null $code
     * @return string
     */
    public static function getLanguageByCode($code = null)
    {
        if (null === $code) {
            $code = self::FALLBACK_LOCALE;
        }

        $className = __NAMESPACE__ . '\\' . \ucfirst($code) . '\Locale';

        return $className;
    }

    private static $rawCodes    = [
        ['ar_SA', 'ar', 'ar-Arab-SA', ['arabic']],
        ['bg_BG', 'bg', 'bg-Cyrl-BG', ['bulgarian']],
        ['cs_CZ', 'cs', 'cs-Latn-CZ', ['czech']],
        ['da_DK', 'da', 'da-Latn-DK', ['danish']],
        ['de_DE', 'de', 'de-Latn-DE', ['german']],
        ['el_GR', 'el', 'el-Grek-GR', ['greek']],
        ['en_US', 'en', 'en-Latn-US', ['english']],
        ['es_ES', 'es', 'es-Latn-ES', ['spanish']],
        ['fa_IR', 'fa', 'fa-Arab-IR', ['persian']],
        ['fr_FR', 'fr', 'fr-Latn-FR', ['french']],
        ['hr_HR', 'hr', 'hr-Latn-HR', ['croatian']],
        ['hu_HU', 'hu', 'hu-Latn-HU', ['hungarian']],
        ['it_IT', 'it', 'it-Latn-IT', ['italian']],
        ['ja_JP', 'ja', 'ja-Jpan-JP', ['japanese']],
        ['ko_KR', 'ko', 'ko-Kore-KR', ['korean']],
        ['ms_MY', 'ms', 'ms-Latn-MY', ['malaysian']],
        ['nl_NL', 'nl', 'nl-Latn-NL', ['dutch']],
        ['no_NO', 'no', 'no-Latn-NO', ['norwegian']],
        ['pl_PL', 'pl', 'pl-Latn-PL', ['polish']],
        ['pt_BR', 'pt', 'pt-Latn-BR', ['portuguesebr', 'brazilian']],
        ['pt_PT', 'pt_PT', 'pt-Latn-PT', ['portuguese']],
        ['ru_RU', 'ru', 'ru-Cyrl-RU', ['russian']],
        ['sk_SK', 'sk', 'sk-Latn-SK', ['slovak']],
        ['sl_SI', 'sl', 'sl-Latn-SI', ['slovenian']],
        ['sv_SE', 'sv', 'sv-Latn-SE', ['swedish']],
        ['th_TH', 'th', 'th-Thai-TH', ['thai']],
        ['tr_TR', 'tr', 'tr-Latn-TR', ['turkish']],
        ['vi_VN', 'vi', 'vi-Latn-VN', ['vietnamese']],
        ['zh_CN', 'zh_Hans', 'zh-Hans-CN', ['schinese']],
        ['zh_TW', 'zh_Hant', 'zh-Hant-TW', ['tchinese', 'chinese_zh']],
    ];
    private static $namesByCode = null;
    private static $codesByName = null;

    /**
     * Get legacy language directory name for a locale code
     * @param string $localeCode locale code
     * @return string[] array of possible language directory names, empty if no mapping exists
     */
    public static function getLegacyName($localeCode)
    {
        if (empty(self::$namesByCode)) {
            foreach (self::$rawCodes as $codeDef) {
                [$locale, $shortLocale, $fullLocale, $languages] = $codeDef;
                self::$namesByCode[$locale]      = $languages;
                self::$namesByCode[$shortLocale] = $languages;
            }
        }

        if (isset(self::$namesByCode[$localeCode])) {
            return self::$namesByCode[$localeCode];
        }

        $langOnly = mb_substr($localeCode, 0, 2);
        return self::$namesByCode[$langOnly] ?? [];
    }

    /**
     * Get locale code representing a legacy language directory name
     * @param string $languageDir legacy language directory name
     * @return string|null locale code or null if no mapping exists
     */
    public static function getLocaleCode($languageDir)
    {
        if (empty(self::$codesByName)) {
            foreach (self::$rawCodes as $codeDef) {
                [$locale, $shortLocale, $fullLocale, $languages] = $codeDef;
                foreach ($languages as $language) {
                    self::$codesByName[$language] = $locale; //$fullLocale;
                }
            }
        }

        return self::$codesByName[$languageDir] ?? null;
    }
}
