<?php

namespace App\Models;

use App\Models\Filters\PlayListFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    use HasFactory;
    use PlayListFilter;

    protected $guarded = [];

    public $table = 'play_lists';


    public function channel()
    {
        return $this->belongsTo(Channel::class,  'channel_id', 'id');
    }


    public function  medias()
    {
        return $this->hasMany(Resource::class, "play_list_id", "id")->where('is_show', 1);
    }
}
