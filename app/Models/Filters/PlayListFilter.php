<?php

namespace App\Models\Filters;


trait PlayListFilter
{
    use BaseFilter;

    public function filterName($name = '')
    {
        if (!$name) {
            return;
        }
        return $this->builder->where('name', 'like', "%$name%");
    }

    public function filterChannel($id = '')
    {
        if (!$id) {
            return;
        }
        return $this->builder->where('channel_id', $id);
    }

    public function filterIgnore($id = 0)
    {
        if (!$id) {
            return;
        }
        return $this->builder->where('id', '!=', $id);
    }
}
