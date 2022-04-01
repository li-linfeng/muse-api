<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //表单验证错误抛出 422
        \API::error(function (\Dingo\Api\Exception\ValidationHttpException $exception) {
            $errors = $exception->getErrors();
            return response()->json(['message' => $errors->first(), 'status_code' => 422], 422);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //注册模型观察者
        $this->registerObservers();
    }


    protected function registerObservers()
    {
        \App\Models\UserCollect::observe(\App\Observers\UserCollectObserver::class);
    }
}
