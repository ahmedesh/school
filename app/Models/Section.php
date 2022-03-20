<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['Name_Section'];  // اللي هيترجم

    protected $table = 'sections';
    public $timestamps = true;


    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom','Class_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers(){
       return $this->belongsToMany('App\Models\Teacher' , 'teacher_section');
    }

}
