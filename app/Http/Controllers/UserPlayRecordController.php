<?php

namespace App\Http\Controllers;

use App\Services\PlayService;

class UserPlayRecordController extends Controller
{
    //
    public function store(PlayService $playService)
    {
        $playService->store();
        return $this->response()->noContent();
    }
}
