<?php

namespace App\Models;

use App\Traits\LogChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use LogChanges;
    use HasFactory;

    protected $fillable = ['name', 'bio'];


    public function books(){

        return $this->belongsToMany(Book::class,'author_book');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public static function boot()
    {
        parent::boot();

        self::bootLogChanges();
    }
}

