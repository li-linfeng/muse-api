<?php

namespace App\Models;

use App\Models\Filters\ChannelFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    use ChannelFilter;

    protected $guarded = [];

    public $table = 'channels';


    public function playList()
    {
        return $this->hasMany(PlayList::class, 'channel_id', 'id');
    }


    public function backgroundImage()
    {
        return $this->hasOne(Image::class, 'id', 'background_image_id');
    }

    public function iconChoose()
    {
        return $this->hasOne(Image::class, 'id', 'icon_choose_id');
    }

    public function iconUnchoose()
    {
        return $this->hasOne(Image::class, 'id', 'icon_unchoose_id');
    }

    public function defaultList()
    {
        return $this->hasOne(PlayList::class, 'channel_id', 'id')->where('is_default', 1);
    }

    public function specialList()
    {
        return $this->hasOne(PlayList::class, 'channel_id', 'id')->where('is_special', 1);
    }

    public function specialListResource()
    {
        return $this->hasManyThrough(Resource::class,  PlayList::class, 'channel_id', 'play_list_id', 'id', 'id')->whereRaw('play_lists.is_special = 1')->whereRaw('resources.is_show = 1');
    }

    public function defaultListResource()
    {
        return $this->hasManyThrough(Resource::class,  PlayList::class, 'channel_id', 'play_list_id', 'id', 'id')->whereRaw('play_lists.is_default = 1')->whereRaw('resources.is_show = 1');
    }
}
