<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentAttachments extends Model
{

    protected $guarded=[];

    protected $table = 'parent_attachments';
    public $timestamps = true;

    protected function MyParent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id' , 'id');
    }

}
