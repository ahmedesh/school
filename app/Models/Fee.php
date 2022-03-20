<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{

    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['title'];   // دا ال column اللي هيحصل عليه ترجمه فقط فالداتابيز

    protected $table = 'fees';
    public $timestamps = true;


    public function grade(){
        return $this->belongsTo('App\Models\Grade' , 'Grade_id' , 'id');
    }
    public function classroom(){
        return $this->belongsTo('App\Models\Classroom' , 'Classroom_id' , 'id');
    }

}
