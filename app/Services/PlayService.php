<?php

namespace  App\Services;

use App\Models\Resource;
use App\Models\UserPlayRecord;

class PlayService
{

    public function store()
    {
        $request = app('request');
        $user_id = auth('api')->id();
        $resource = Resource::find($request->resource_id);
        $channel_id = $resource->playList->channel_id;
        //增加播放记录
        UserPlayRecord::create([
            'resource_id' => $request->resource_id,
            'user_id'     => $user_id,
            'total_time'  => $request->total_time,
            'channel_id'  => $channel_id,
        ]);

        // //增加一条频道近期播放记录
        // $this->addToChannelRecentPlayList($user_id, $request->resource_id);
        //增加一条近期所有资源播放记录
        // $this->addToTotalRecentPlayList($user_id, $request->resource_id);
        return;
    }

    // protected function addToChannelRecentPlayList($user_id, $resource_id)
    // {
    //     $resource = Resource::find($resource_id);
    //     $channel_id = $resource->playList->channel_id;
    //     $key = "recent:{$user_id}:channel_{$channel_id}";
    //     $this->addToZset($key, $resource_id);
    // }

    // protected function addToTotalRecentPlayList($user_id, $resource_id)
    // {
    //     $key = "recent:{$user_id}:total";
    //     $this->addToZset($key, $resource_id);
    // }


    // protected function addToZset($key, $value, $limit = 20)
    // {
    //     $redis = app('redis');
    //     $count = $redis->zcard($key);

    //     if ($count == $limit) {
    //         //按照升序删除第一个
    //         $redis->zremrangebyrank($key, 0, 0);
    //     }

    //     //当前时间戳作为评分
    //     $redis->zadd($key, time(), $value);
    //     return;
    // }
}
