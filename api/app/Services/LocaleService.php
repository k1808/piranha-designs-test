<?php

namespace App\Services;

class LocaleService
{
    public static function get()
    {
        return app()->getLocale();
    }
}
