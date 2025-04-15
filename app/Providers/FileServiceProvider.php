<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class FileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('files', function ($app) {
            return new Filesystem;
        });
    }

    public function boot()
    {
        //
    }
}
