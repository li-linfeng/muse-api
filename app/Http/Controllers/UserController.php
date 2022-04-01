<?php

namespace App\Http\Controllers;

use App\Http\Transformers\UserTransformer;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  info(UserTransformer $userTransformer)
    {
        $info = auth('api')->user();
        $userTransformer->setDefaultIncludes(['friends', 'user_account']);
        return $this->response()->item($info, $userTransformer);
    }

    public function bindShareCode(Request $request, UserService $userService, UserTransformer $userTransformer)
    {
        if (!$request->filled('share_code') || strlen($request->input('share_code')) != 5) {
            abort(422, "分享码填写错误");
        }
        $user = $userService->binShareCodeToUser($request->share_code);
        return $this->response()->item($user, $userTransformer);
    }
}
