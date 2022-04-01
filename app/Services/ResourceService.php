<?php

namespace  App\Services;

use App\Models\Resource;

class ResourceService
{

    public function getResourceRecentListById($ids)
    {
        return Resource::whereIn('id', $ids)
            ->with(['coverImage', 'isCollect'])
            ->orderByRaw("FIELD(id, " . implode(", ", $ids) . ")")
            ->get();
    }
}
