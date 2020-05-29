<?php

namespace Modules\Blog\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//----- repository ----
//http://lyften.com/projects/laravel-repository/doc/usage.html
//use Modules\Blog\Repositories\PostRepository;
//---- models --
use Modules\Blog\Models\Post;

trait ContainerTrait {
    /**
     * @var UserRepository
     */
    protected $repository;

    public function getModel() {
        //return new Post;
        $params = \Route::current()->parameters();
        \extract($params);
        if (is_object($container0)) {
            return get_class($container0);
        }

        $post_type = \is_object($container0) ? $container0->post_type : $container0;

        //echo '<h3>['.$post_type.']</h3>';
        $model = config('xra.model.'.$post_type);
        if ('' == $model) {
            //$row = Post::where('lang', app()->getLocale())->where('guid', $post_type)->first();
            //$model = config('xra.model.'.$row->post_type);
            //if ('' == $model) {
            die('<hr/>settare modello['.$post_type.'] in config/xra<hr/>'.'['.__LINE__.']['.__FILE__.']');
            //}
        }

        return $model;
    }

    /*
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
    */

    public function getController() {
        $params = \Route::current()->parameters();
        \extract($params);
        $model = $this->getModel();
        if (\Request::is('admin/*')) {
            $controller = \str_replace('\\Models\\', '\\Http\\Controllers\\Admin\\', $model);
        } else {
            $controller = \str_replace('\\Models\\', '\\Http\\Controllers\\', $model);
        }
        for ($i = 1; $i < 4; ++$i) {
            $cont_name = 'container'.$i;
            if (isset($$cont_name)) {
                $cont = $$cont_name;
                $type = \is_object($cont) ? $cont->post_type : $cont;
                $controller .= '\\'.Str::studly($type);
            }
        }
        $controller .= 'Controller';

        return $controller;
    }

    public function __call($method, $args) {
        //ddd($args);
        $controller = $this->getController();
        //dd($controller);
        if (\in_array($method, ['store', 'update'], true)) {
            $request = \str_replace('\\Controllers\\', '\\Requests\\', $controller);
            $request = \mb_substr($request, 0, -\mb_strlen('Controller'));
            $pos = \mb_strrpos($request, '\\');
            $request = \mb_substr($request, 0, $pos + 1).Str::studly($method).\mb_substr($request, $pos + 1);
            $request = $request::capture();
            $request->validate($request->rules(), $request->messages());

            return app($controller)->$method($request);
        } else {
            return app($controller)->$method(Request::capture());
        }
        //return app($controller)->$method($args);
    }
}
