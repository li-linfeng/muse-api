<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlayListResourceRel extends Model
{
    use HasFactory;

    public $table = 'user_play_list_resource_rel';

    protected $guarded = [];
}
