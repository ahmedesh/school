<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use SoftDeletes;

    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['name'];   // دا ال column اللي هيحصل عليه ترجمه فقط فالداتابيز


    protected $table = 'students';
    public $timestamps = true;

    public function gender(){
        return $this->belongsTo('App\Models\Gender' , 'gender_id' , 'id');
    }

    public function grade(){
        return $this->belongsTo('App\Models\Grade' , 'Grade_id' , 'id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom' , 'Classroom_id' , 'id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section' , 'section_id' , 'id');
    }

    public function Nationality(){
        return $this->belongsTo('App\Models\Nationality' , 'nationalitie_id' , 'id');
    }

    public function myparent(){
        return $this->belongsTo('App\Models\My_Parent' , 'parent_id' , 'id');
    }

    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
