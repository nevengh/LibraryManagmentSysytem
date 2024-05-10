<?php

namespace App\Models;

use App\Traits\LogChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use LogChanges;
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function authors(){

        return $this->belongsToMany(Author::class,'author_book');
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
