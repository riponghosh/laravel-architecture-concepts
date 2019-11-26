<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\TestClass;
use App\Http\Controllers\Auth\TestClass2;
use App\Http\Controllers\Auth\TestClass3;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
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
        $data=resolve('allClass');
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

