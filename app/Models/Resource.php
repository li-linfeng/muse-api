<?php

namespace App\Models;

use App\Models\Filters\ResourceFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    use ResourceFilter;

    public $table = 'resources';

    protected $guarded = [];


    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'media_id');
    }


    public function playList()
    {
        return $this->belongsTo(PlayList::class, 'play_list_id', 'id');
    }

    public function coverImage()
    {
        return $this->hasOne(Image::class, 'id', 'cover_image_id');
    }


    //是否收藏
    public function isCollect()
    {
        $userId = (int) auth('api')->id();
        return $this->hasOne(UserCollect::class, 'resource_id', 'id')->where('user_id', $userId);
    }


    public function getTypeAttribute()
    {
        return optional($this->video)->type;
    }

    public function getTotalTimeAttribute()
    {
        return optional($this->video)->total_time;
    }

    public function getPathAttribute()
    {
        return optional($this->video)->path;
    }

    public function getUrlAttribute()
    {
        $api_user = auth('api')->user();
        $url = optional($this->video)->url;
        if ($api_user) {
            $key = $api_user->id . '_' . $api_user->nickname;
            $url = encryptUrl($url, $key);
        }
        return $url;
    }

    public function getOriginNameAttribute()
    {
        return optional($this->video)->origin_name;
    }
}
