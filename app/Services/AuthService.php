<?php

namespace  App\Services;

use App\Models\User;
use App\Models\UserSocialAccount;
use App\Traits\TokenTrait;
use Illuminate\Http\Request;

class AuthService
{
    use TokenTrait;

    public function  login(Request  $request)
    {
        /**
         * 通过code 获取用户信息
         * 第三方包已经做了通过code获取access_token  getAccessTokenResponse($code)方法
         * 然后在通过access_token获取用户信息
         **/
        $social = $request->input('social', 'weixin');
        $authUser = $this->getSocialUserInfo($social);
        $params = [
            'id' => $authUser->id ?: "",
            'nickname' => $authUser->nickname ?: "",
            'name' => $authUser->name ?: "",
            'email' => $authUser->email ?: "",
            'avatar' => $authUser->avatar ?: "",
        ];
        /**
         *  插入第三方登录用户表
         **/
        $socialUser = app(UserSocialAccountService::class)->createOrUpdateRecord($social, $params);

        /**
         *  创建用户
         **/
        $user = app(UserService::class)->findOrCreateUserForSocialAccount($social, $socialUser);

        /**
         *  第一次登陆，获得三天免费卡
         */

        if (!$socialUser->user_id) {
            app(UserMuseAccountService::class)->firstLogin($user->id);
        }
        /**
         *  绑定用户
         **/
        $this->bindUser($socialUser, $user);

        /**
         * 如果是第三方登录，则只取第一次登录的uid作为密码
         *
         */
        $result = $this->generateAccessTokenForUser($user);

        /**
         * 记录登录日志
         */
        app(UserLoginService::class)->createLoginLog($user);

        return $result;
    }


    /**
     * 获取第三方用户资料
     * @param $social
     * @return mixed
     */
    protected  function  getSocialUserInfo($social)
    {
        $user =  \Socialite::driver($social)->stateless()->user();
        return $user;
    }

    /**
     * 绑定第三方账号与用户
     * @param UserSocialAccount $socialUser
     * @param User $user
     */
    protected  function  bindUser(UserSocialAccount  $socialUser, User  $user)
    {
        if (!$socialUser->user_id) {
            $socialUser->user_id = $user->id;
            $socialUser->save();
        }
    }
}
