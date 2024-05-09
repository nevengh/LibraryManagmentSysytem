<?php


namespace App\Helpers;

class DateHelper
{
    public static function formatDateTime($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
}
