<?php

namespace App\Models\Filters;


trait ChannelFilter
{
    use BaseFilter;

    public function filterName($name = '')
    {
        if (!$name) {
            return;
        }
        return $this->builder->where('name', 'like', "%$name%");
    }


    public function filterIsShow($show = '')
    {
        if (!$show) {
            return;
        }
        return $this->builder->where('is_show', 1);
    }
}
