<?php

namespace App\Providers;

use App\View\Components\HeaderUserProfile;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //my custom component register :-
        //'myProfileInHeader' is a custom name of my component btw if i use resources\views\components\file name as component name it also works but better use custom name
        //'HeaderUserProfile:class' this is class name which is exist in app\view\components\
        Blade::component( 'myProfileInHeader', HeaderUserProfile::class );

    }
}
