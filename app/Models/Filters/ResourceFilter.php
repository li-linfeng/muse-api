<?php

namespace App\Models\Filters;


trait ResourceFilter
{
    use BaseFilter;

    // 类型
    public function filterType($name = '')
    {
        if (!$name) {
            return;
        }
        return $this->builder->whereHas('video', function ($q) use ($name) {
            $q->where('type', $name);
        });
    }

    public function filterName($name = '')
    {
        if (!$name) {
            return;
        }
        return $this->builder->where('title', 'like', "%$name%");
    }
}
