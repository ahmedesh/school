<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
{

    use HasTranslations;


    protected $guarded=[];

    public $translatable = ['Name_Father' , 'Job_Father' , 'Name_Mother' , 'Job_Mother'];   // دا ال columns اللي هيحصل عليه ترجمه فقط فالداتابيز


    protected $table = 'my_parents';
    public $timestamps = true;

    protected function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ParentAttachments::class, 'parent_id' , 'id');
    }

    //in your model.   دي عشان لما امسح الاب يمسحلي الابناء تلقائي
    protected static function booted() { //booted method, no need to call parent boot
        static::deleting( function ($MyParent) {
            $MyParent->attachments()->delete();  // attachments => this function for child in My_Parent Model
        });
    }

}
