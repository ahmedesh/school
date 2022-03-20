<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{

    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['Name'];   // دا ال column اللي هيحصل عليه ترجمه فقط فالداتابيز


    protected $table = 'genders';
    public $timestamps = true;

}
