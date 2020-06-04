<?php

namespace App\Http\Controllers\Locale;

use App\Http\Controllers\Controller;

class LocalizationController extends Controller
{
    public static function getLang($lang='es')
    {
        switch ($lang) {
            case 'ca':
                return __('lang.catalan');
                break;
            case 'en':
                return __('lang.english');
            break;
            default:
                return __('lang.spanish');
                break;
        }
    }

    public static function allLang()
    {
        return ['ca','en','es'];
    }
}