<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\TestClass;
use App\Http\Controllers\Auth\TestClass2;
use App\Http\Controllers\Auth\TestClass3;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        // different bind and singleton
        $this->app->bind('rand1', function () {
            return Str::random(5);
        });
        echo app('rand1');
        echo "<br>";
        echo app('rand1');
        echo "<br>";

        $this->app->singleton('rand2', function () {
            return Str::random(5);
        });
        echo app('rand2');
        echo "<br>";
        echo app('rand2');
        echo "<br>";

        // example of tagging

        $this->app->bind('class1', function () {
            return new TestClass3();
        });

        $this->app->bind('class2', function () {
            return new TestClass2();
        });

        $this->app->tag(['class1', 'class2'], 'all');

        
        $this->app->bind('allClass', function ($app) {
            return $app->tagged('all');
        });
    
        // $data=app()->tagged('all');
        $data=resolve('allClass');//app('allClass') or $this->app->make('allClass')
        foreach ($data as $data) {
            $data->test();
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

