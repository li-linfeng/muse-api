<?php

namespace App\Models;

use App\Models\Filters\VideoFilter;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    use VideoFilter;

    public $table = 'videos';

    protected $guarded = [];


    public function resource()
    {
        return $this->belongsTo(Resource::class, 'id', 'media_id');
    }
}
