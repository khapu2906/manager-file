<?php

namespace Khapu\ManagerFiles;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use	Illuminate\Config\Repository;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;

class PackageBaseServiceProvider extends ServiceProvider
{

    protected const MODULE_PATH =  __DIR__ . '/';
    
    protected const MODULE_CONFIG = 'config/khapufile.php';

    protected const MODULE_ROUTE  =  'routes/web.php';

    protected const MODULE_PUBLIC = '../public';

    protected $moduleName = '';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $pathConfig = self::MODULE_PATH . self::MODULE_CONFIG;
        $this->mergeConfigFrom($pathConfig, 'khapu-filemanager');

        $this->app->singleton('khapu-filemanager', function () {
            return true;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(self::MODULE_PATH . 'resources/views', 'khapu-filemanager');
        // dd(self::MODULE_PATH . 'resource/views');
        $this->publishes([
            self::MODULE_PATH . self::MODULE_CONFIG => base_path('config/khapufile.php'),
        ], 'kpf_config');

        $this->publishes([
            self::MODULE_PATH . self::MODULE_PUBLIC  => public_path('khapu-filemanager'),
        ], 'kpf_public');

        $this->publishes([
            self::MODULE_PATH . 'views' => resource_path('views/khapu-filemanager'),
        ], 'kpf_views');

        if (File::exists(self::MODULE_PATH . self::MODULE_ROUTE)) {
            $this->loadRoutesFrom(self::MODULE_PATH . self::MODULE_ROUTE);
        }
        
      
    }
}
