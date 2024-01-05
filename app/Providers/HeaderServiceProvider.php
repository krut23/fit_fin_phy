<?php

namespace App\Providers;

use App\Models\Manufacturer;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Media;
use Request;
//use Auth;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(){
//        view()->composer(['admin/*'],function ($view) {
//        });
        view()->composer(['*'],function ($view){

            if(!empty(Auth::user())) {
                $view->with([
                    'userRoleStatus'=>Auth::user()->status,
                    'alertWarningMessage'=> !empty($message) ? $message->message : null,
                ]);
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
