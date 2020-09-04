<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/3
 * Time: 9:44
 */
namespace Randy\Rbac;

use Illuminate\Support\ServiceProvider;
use Randy\Rbac\Http\Varm;

class RbacServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('rbac',function(){
            return new Varm;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        //发布数据库
        $this->publishes([
            __DIR__ . '/data/migrations/' => database_path('migrations'),
            __DIR__ . '/data/seeds/' => database_path('seeds'),
        ]);
    }
}

