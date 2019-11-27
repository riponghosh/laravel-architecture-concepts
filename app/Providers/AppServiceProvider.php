<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\TestClass;
use App\Http\Controllers\Auth\TestClass2;
use App\Http\Controllers\Auth\TestClass3;
use App\Http\Controllers\Auth\TestClass4;
use App\Http\Controllers\Auth\TestClass5;
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

        // Extending Bindings

        $this->app->extend(TestClass2::class, function ($service, $app) {
            return new TestClass4($service);
        });
        app(TestClass2::class)->user();
        // dd(app(TestClass4::class)); trying to resolve TestClass4 give error. Because TestClass4 has dependencies on TestClass2 but TestClass2 return instance of TestClass4. So type hint give error. It is not an instance of TestClass2, an intance of TestClass4. 

        // Container Events

        $this->app->resolving(function ($object, $app) {
            if (gettype($object)=='object') {
                echo "resolving object ".get_class($object)." <br>" ; 
            }
            // dd(get_class($object));
            // print_r($object);
        });

        // resolve without binding

        $this->app->make(TestClass5::class);//or app(TestClass5::class) or resolve(TestClass5::class)
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

