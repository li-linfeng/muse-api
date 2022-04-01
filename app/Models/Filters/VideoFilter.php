<?php

namespace App\Models\Filters;


trait VideoFilter
{
    use BaseFilter;

    // 类型
    public function filterType($name = '')
    {
        if (!$name) {
            return;
        }
        return $this->builder->where('type', $name);
    }
}
