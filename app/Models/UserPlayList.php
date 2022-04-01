<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlayList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $table = 'user_play_lists';


    public function channel()
    {
        return $this->belongsTo(Channel::class,  'channel_id', 'id');
    }


    public function  medias()
    {
        return $this->hasManyThrough(Resource::class, UserPlayListResourceRel::class, "play_list_id", "resource_id");
    }
}
