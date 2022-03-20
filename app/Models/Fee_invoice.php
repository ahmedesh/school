<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee_invoice extends Model
{

    protected $guarded=[];

    protected $table = 'fee_invoices';
    public $timestamps = true;

    public function grade(){
        return $this->belongsTo('App\Models\Grade' , 'Grade_id' , 'id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom' , 'Classroom_id' , 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee', 'fee_id');
    }



    protected function StudentAccount(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudentAccount::class, 'fee_invoice_id' , 'id');
    }

    //in your model.   دي عشان لما امسح الاب يمسحلي الابناء تلقائي
    protected static function booted()
    { //booted method, no need to call parent boot
        static::deleting(function ($fee_invoice) {
            $fee_invoice->StudentAccount()->delete();  // StudentAccount => this function for child in $fee_invoice Model
        });
    }
}
