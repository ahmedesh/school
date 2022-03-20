<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }


//    عامل العلاقتين دول عشان لما يمسح الاب يمسجلي الابناء فقط بس كدا
    public function StudentAccount()
    {
        return $this->hasMany('App\Models\StudentAccount', 'processing_id');
    }


    protected static function booted() { //booted method, no need to call parent boot
        static::deleting( function ($MyParent) {
            $MyParent->StudentAccount()->delete();  // StudentAccount => this function for child in My_Parent Model
        });
    }

}
