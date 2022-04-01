<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareRecord extends Model
{

    public $table = "share_record";

    protected $guarded = [];


    public function  user()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }
}
