<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Services\AuthService;
use App\Services\JiGuangAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function oauth(Request $request)
    {
        return \Socialite::with('weixin')->redirect();
    }

    public function callback(Request $request)
    {
        Log::channel('daily')->info(json_encode($request->all(), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE));
        return $this->response->array([
            'request' => $request->all(),
        ]);
    }

    public function loginBySocial(AuthLoginRequest  $request, AuthService  $authService)
    {
        $result =  $authService->login($request);
        return $this->response->array($result);
    }

    public function loginByMobile(JiGuangAuthService $authService)
    {
        if (!request()->input('login_token')) {
            abort(422, "登录token不能为空");
        }
        $result = $authService->login();
        return $this->response->array($result);
    }
}
