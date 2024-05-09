<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait LogChanges
{
    public static function bootLogChanges()
    {
        static::created(function ($model) {
            Log::info('New record created: ' . get_class($model) . ' ID ' . $model->id);
        });

        static::updated(function ($model) {
            Log::info('Record updated: ' . get_class($model) . ' ID ' . $model->id);
        });

        static::deleted(function ($model) {
            Log::info('Record deleted: ' . get_class($model) . ' ID ' . $model->id);
        });
    }
}
