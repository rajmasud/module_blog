<?php
namespace Modules\Blog\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

//-------models-----------
use Modules\Blog\Models\Post;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Blog\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        $router=$this->app['router'];
        $this->mergeConfigs();
        $this->registerRoutePattern($router);
        if(\Request::input('act')!='migrate'  && !$this->app->runningInConsole() ){
            $this->registerRouteBind($router);
        }
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(__DIR__ . '/../Routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }


    public function mergeConfigs(){
        if (!isset($_SERVER['SERVER_NAME']) || '127.0.0.1' == $_SERVER['SERVER_NAME']) {
            $_SERVER['SERVER_NAME'] = 'localhost';
        }
        $server_name = str_slug(\str_replace('www.', '', $_SERVER['SERVER_NAME']));
        if(!\File::exists(base_path('config/'.$server_name))){
            $server_name = 'localhost';
        }
        $configs=['database','filesystems','auth','metatag','services','xra']; //auth sarebbe da spostare in LU,metatag in extend
        foreach($configs as $v){
            $extra_conf=config($server_name.'.'.$v);
            $original_conf=config($v);
            if(!is_array($original_conf)) $original_conf=[];
            if(!is_array($extra_conf)) $extra_conf=[];
            $merge_conf=array_merge($original_conf,$extra_conf); //_recursive
            \Config::set($v, $merge_conf);
        }
        //ddd(config('database')); //4debug
    }


    public function registerRoutePattern(\Illuminate\Routing\Router $router){
        //----------ROUTE PATTERN
        if (\is_array(config('xra.model'))) {
            $pattern = \implode('|', \array_keys(config('xra.model')));
            //*
            $patternC = \str_replace('|', ' ', $pattern);
            $patternC = \ucwords($patternC);
            $patternC = \str_replace(' ', '|', $patternC);
            $pattern .= '|'.$patternC;
            //*/
            for ($i = 0; $i < 4; ++$i) {
                $container_name = 'container';
                $container_name .= $i;
                $router->pattern($container_name, '/|'.$pattern.'|/i');
            }
        }else{

        }
    }

    public function getXotModel($name){
        $model=config('xra.model.'.$name);
        $row= new $model;
        return $row;
    }

    public function registerRouteBind(\Illuminate\Routing\Router $router){
        //--------- ROUTE BIND
        //*
        $router->bind('lang', function ($value) {
            \App::setLocale($value);
            return $value;
        });
        $lang = \App::getLocale();
        
        for ($i = 0; $i < 4; ++$i) {
            $item_name = 'item';
            $container_name = 'container';
            $item_name .= $i;
            $container_name .= $i;
            $router->bind($item_name, function ($value) use ($container_name,$lang,$i) {
                $container_curr = request()->$container_name;
                $model=$this->getXotModel($container_curr);
                $pk=($model->getRouteKeyName());
                $pk_full=$model->getTable().'.'.$pk;
                if($pk=='guid') $pk_full='guid'; // pezza momentanea
                if ($i == 0) {
                    if(method_exists($model, 'scopeWithPost')){
                        $rows=$model->withPost($value);  //scopeGlobal ?
                    }else{
                        $rows=$model;
                    }
                    $row=$rows->where([$pk_full=>$value])->first();                   
                } else {
                    $item_prev = request()->{'item'.($i - 1)};
                    $types = camel_case(str_plural($container_curr));
                    $row= $item_prev->$types()->where([$pk_full=>$value])->first();
                }
                if (is_object($row)) {
                    return $row;
                }
                return $value;
            });
        }
    }
}
