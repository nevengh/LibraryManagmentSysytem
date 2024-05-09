<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class LogHelper
{
    public static function logCustomAnalytics($data)
    {
        Log::channel('analytics')->info('Custom Analytics', $data);
    }
}
