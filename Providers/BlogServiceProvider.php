<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;


//-------services --------
use Modules\Blog\Services\BlogService;
//-------models-----------
use Modules\Blog\Models\Post;
//use Modules\Blog\Models\PostRelated;
//use Modules\Extend\Models\ServiceProviderTrait;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        
        $seg01 = (\Request::segment(1)); //il primo segmento potrebbe essere o lingua o admin
        $langs=config('laravellocalization.supportedLocales');
        if(!is_array($langs)){
            ddd('set config laravellocalization.supportedLocales');
        }
        $langs=array_keys($langs);
        if (\in_array($seg01, $langs, true)) {
            $this->app->setLocale($seg01);
        }
        //ddd(config('xra.languages'));
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        //--- laraxot
        /*
        $this->mergeConfigs();
        $this->registerRoutePattern($router);
        if(\Request::input('act')!='migrate'  && !$this->app->runningInConsole() ){
            $this->registerRouteBind($router);
        }
        */
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('blog.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'blog'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/blog');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/blog';
        }, \Config::get('view.paths')), [$sourcePath]), 'blog');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/blog');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'blog');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'blog');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [BlogService::class];
    }
    /*
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
            
            for ($i = 0; $i < 4; ++$i) {
                $container_name = 'container';
                $container_name .= $i;
                $router->pattern($container_name, '/|'.$pattern.'|/i');
            }
        }else{

        }
    }

    public function registerRouteBind(\Illuminate\Routing\Router $router){
        //--------- ROUTE BIND
        
        $router->bind('lang', function ($value) {
            \App::setLocale($value);

            return $value;
        });
        $lang = \App::getLocale();
        
        $roots=Post::getRoots();
        $roots_low=array_change_key_case($roots);
        for ($i = 0; $i < 4; ++$i) {
            $container_name = 'container'.$i;
            $router->bind($container_name, function ($value) use ($roots,$roots_low) {
                if(isset($roots[$value])){
                    return $roots[$value];
                }
                if( array_key_exists(strtolower($value), $roots_low) ){ //per prendere sia location che Location
                    $value_low=strtolower($value);
                    return $roots_low[$value_low];
                }
                return $value;
            });
        }
       
        for ($i = 0; $i < 4; ++$i) {
            $item_name = 'item';
            $container_name = 'container';
            $item_name .= $i;
            $container_name .= $i;
            $router->bind($item_name, function ($value) use ($container_name,$lang,$i) {
                if ($i == 0) {
                    $container_curr = request()->$container_name;
                    $model=$container_curr->getLinkedModel();
                    $row=$model->item($value);
                    //ddd(get_class($model));
                    if (!is_object($row) && !in_array($container_curr->post_type,['feed','sitemap'])) {
                        $tmp=Post::where('post_type',$container_curr->post_type)->where('guid',$value)->first();
                        //ddd($tmp);
                        if(is_object($tmp)){
                            $tmp_lang=$tmp->generateRowLang($lang);
                            return $tmp_lang->linkable; /// boh da valutare 
                        }
                    }

                    
                } else {
                    $container_curr = request()->$container_name;
                    $item_name_prev = 'item'.($i - 1);
                    $item_prev = request()->$item_name_prev;
                    $container_name_prev = 'container'.($i - 1);
                    $container_prev = request()->$container_name_prev;
                    if(!is_object($item_prev)){ 
                        //echo '<h3>['.__LINE__.']['.$container_prev->post_type.']['.$item_name_prev.']['.$item_prev.']['.$lang.']['.$value.']</h3>';
                        //ddd('o');
                        return abort(404); //da tenere d'occhio
                       
                    }
                    //ddd($item_prev);
                    //ddd($container_curr->post_type);
                    //$rows = $item_prev->related($container_curr->post_type)->where('guid', $value);
                    $types = str_plural($container_curr->post_type);
                    $types = camel_case($types);
                    //ddd($types.'  '.$value);
                    
                    $rows= $item_prev->$types()->where('blog_posts.guid', $value);  //where con il join o whereHas togliendo il join ?

                    //ddd($rows->first());
                    //ddd($item_prev->$types);
                    //ddd($rows->first());
                    try{ 
                    //ddd($rows->toSql());
                        $row=$rows->first();
                    }catch(\Exception $e){
                        $row=$value; //caso della cancellazione di orario
                        //ddd($item_prev); //location
                        //ddd($types); //restaurants
                    //    ddd($e);
                    //    echo '<h3>'.$item_prev->post_type.' - '.$types.'</h3>';
                    //    $row=null;
                    }

                        //ddd($item_prev->$types);
                    if (!is_object($row)) {
                        echo '<h3>['.__LINE__.']['.$container_prev->post_type.']['.$item_name_prev.']['.$item_prev->post_type.']['.$lang.']['.$container_curr->post_type.']['.$value.']</h3>';
                        $tmps=Post::where('post_type',$container_curr->post_type)->where('guid',$value)->where('lang','!=',$lang)->get();
                        //--- genero traduzioni ipotetiche mancanti
                        foreach($tmps as $tmp){
                            $tmp->generateRowLang($lang); //genero le traduzioni
                        }
                        //ddd('a');
                    }
                }
                
                if (is_object($row)) {
                    if($row->post_type=='restaurant'){ ///--- usare getWith 
                        //ddd('si'); //sempre 33 queries..
                        $row->load('cuisines','cuisineCats');
                    }
                    return $row;
                }else{
                    // -- 4 debug
                    //echo '<h3>I:'.$i.'</h3>';
                    //echo '<h3>itemprev:'.$item_prev->post_type.'</h3>';
                    //echo '<h3>types:'.$types.'</h3>';
                    //echo '<h3>guid:'.$value.'</h3>';
                    //ddd($rows->toSql());
                    
                }
                return $value;
            });
        }
    }
    */

}
