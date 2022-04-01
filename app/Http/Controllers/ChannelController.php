<?php

namespace App\Http\Controllers;

use App\Http\Transformers\ChannelTransformer;
use App\Models\Channel;
use App\Services\ChannelService;

class ChannelController extends Controller
{
    public function index(ChannelTransformer $channelTransformer)
    {
        $channels = Channel::filter(['filter_is_show' => 1])
            ->where('is_index', 0)
            ->with(['iconChoose', 'iconUnchoose'])
            ->get();

        return $this->response()->collection($channels, $channelTransformer, ['key' => 'flatten'], function ($resource, $fractal) {
            $fractal->parseIncludes(['icon_choose', 'icon_unchoose']);
        });
    }


    public function detail(Channel $channel, ChannelService $channelService, ChannelTransformer $channelTransformer)
    {
        $recent = $channelService->detail($channel);
        $channel->load([
            'defaultListResource.isCollect',
            'defaultListResource.coverImage',
            'playList.medias.coverImage',
            'playList.medias.isCollect',
            'specialListResource.isCollect',
            'specialListResource.coverImage'
        ]);
        return  $this->response()->item($channel, $channelTransformer, [], function ($resource, $fractal) {
            $fractal->parseIncludes([
                'default_list_medias.is_collect',
                'default_list_medias.cover_image',
                'special_list_medias.is_collect',
                'special_list_medias.cover_image',
                'background_image',
                'other_list.medias.is_collect',
                'other_list.medias.cover_image'
            ]);
        })->setMeta(['recent' => $recent]);
    }
}
