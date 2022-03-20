<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{

    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['Name_Class'];  // دا ال column اللي هيحصل عليه ترجمه فقط فالداتابيز تبع باكدج spatie


    protected $table = 'classrooms';
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}
