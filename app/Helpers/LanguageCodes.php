<?php

namespace App\Helpers;

final class LanguageCodes
{

    // https://learn.microsoft.com/en-us/linkedin/shared/references/reference-tables/language-codes
    private static $collections = [
        'english_american'      => 'en_us',
        'english_british'       => 'en_uk',
        'japanese'              => 'ja_jp',
        'indonesian'            => 'in_id',
        'chinese_simplified'    => 'zh_cn',
        'french'                => 'fr_fr',
        'german'                => 'de_de',
        'italian'               => 'it_it',
        'korean'                => 'ko_kr',
        'portuguese'            => 'pt_pt',
        'portuguese_brazilian'  => 'pt_br',
        'spanish'               => 'es_es',
        'turkish'               => 'tr_tr'
    ];

    public static function getLanguageCodes(string $excelString): ?string
    {
        if (isset(self::$collections[$excelString])) {
            return self::$collections[$excelString];
        }

        return null;
    }
}
