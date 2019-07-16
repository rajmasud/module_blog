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
        //$this->registerRoutePattern($router);
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
                if ($i == 0) {
                    $container_curr = request()->$container_name;
                    if(!is_object($container_curr) && config('xra.model.'.$container_curr) ){
                        $class=config('xra.model.'.$container_curr);
                        $model=new $class;

                    }else{
                        $model=$container_curr->getLinkedModel();
                    }
                    if (\method_exists($model, 'item')) {
                        $row=$model->item($value);
                    }else{
                        $row=$model->find($value);
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
                        /* --- sbagliato devo prendere l'oggetto collegato e tradurlo, non tradurre quello con lo stesso guid

                        $tmp=Post::where('post_type',$container_prev->post_type)->where('guid',$item_prev)->first();
                        if(is_object($tmp)){
                            $row_lang=$tmp->generateRowLang($lang);
                            $item_prev=$row_lang->linkable; //DEVO COLLEGARLA AL CONTENITORE !!!!! 
                            //ddd($row_lang);
                        }
                        */
                        //ddd($tmp);
                        //ddd($item_prev);
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
                    /* -- 4 debug
                    echo '<h3>I:'.$i.'</h3>';
                    echo '<h3>itemprev:'.$item_prev->post_type.'</h3>';
                    echo '<h3>types:'.$types.'</h3>';
                    echo '<h3>guid:'.$value.'</h3>';
                    ddd($rows->toSql());
                    */
                }
                return $value;
            });
        }
    }
}
