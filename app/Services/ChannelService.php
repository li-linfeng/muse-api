<?php

namespace  App\Services;

use App\Http\Transformers\ChannelTransformer;
use App\Http\Transformers\MediaTransformer;
use App\Models\Channel;
use App\Models\UserPlayRecord;
use App\Serializers\CustomSerializer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ChannelService
{
    public function __construct()
    {
        $this->fractal             = new Manager();
        $this->resourceTransformer = new MediaTransformer();
        $this->channelTransformer = new ChannelTransformer();
        $this->fractal->setSerializer(new CustomSerializer);
    }

    public function detail(Channel $channel)
    {
        $user_id = auth('api')->id();

        $recent = $this->getRecent($user_id, $channel->id);
        return $recent;
    }

    protected function getRecent($user_id, $channel_id)
    {
        $recent_ids = $this->getUserRecentPlayIds($user_id, $channel_id);
        if (!$recent_ids) {
            return [];
        }
        $recent =  app(ResourceService::class)->getResourceRecentListById(array_keys($recent_ids));
        $resources = $this->transformToCollection($recent, ['cover_image', 'is_collect']);
        $result = collect($resources)->map(function ($item) use ($recent_ids) {
            $date = Carbon::parse($recent_ids[$item['id']])->ToDateString();
            $item['play_date'] = $date;
            return $item;
        })->toArray();
        return $result;
    }



    protected function  transformToCollection($data, $includes)
    {
        $this->fractal->parseIncludes($includes);
        $resource = new Collection($data, $this->resourceTransformer, 'flatten');
        return  $this->fractal->createData($resource)->toArray();
    }

    protected function getUserRecentPlayIds($user_id, $channel_id)
    {
        $re = [];
        UserPlayRecord::where('user_id', $user_id)
            ->where('channel_id', $channel_id)
            ->select(DB::raw('resource_id, max(created_at) as max_create'))
            ->groupBy('user_id', 'resource_id')
            ->orderByDesc('max_create')
            ->get()
            ->map(function ($item) use (&$re) {
                $re[$item->resource_id] = $item->max_create;
            });
        return $re;
    }
}
