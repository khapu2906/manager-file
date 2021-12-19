<?php

namespace Khapu\Directory;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use	Illuminate\Config\Repository;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;

class PackageBaseServiceProvider extends ServiceProvider
{


    protected $moduleName = '';

    public $config = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
