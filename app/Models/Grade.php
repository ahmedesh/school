<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grade extends Model
{

    use HasTranslations;

    protected $guarded=[];

    public $translatable = ['Name'];   // دا ال column اللي هيحصل عليه ترجمه فقط فالداتابيز

    protected $table = 'Grades';
    public $timestamps = true;

    public function classroom()
    {
        return $this->hasMany('App\Models\Classroom', 'Grade_id');
    }

    // علاقة المراحل الدراسية لجلب الاقسام المتعلقة بكل مرحلة

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }

}
