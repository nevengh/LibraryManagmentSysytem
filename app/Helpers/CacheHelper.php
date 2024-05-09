<?php

namespace App\Helpers;

class CacheHelper
{
    public static function remember($key, $minutes, $callback)
    {
        return cache()->remember($key, $minutes, $callback);
    }
}
