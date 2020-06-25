<?php

namespace Modules\Blog\Providers;

//-------models-----------
//use Modules\Blog\Models\Post;

//--- bases ---
use Modules\Xot\Providers\XotBaseRouteServiceProvider;

class RouteServiceProvider extends XotBaseRouteServiceProvider {
    protected $moduleNamespace = 'Modules\Blog\Http\Controllers';
    protected $module_dir = __DIR__;
    protected $module_ns = __NAMESPACE__;

    //public function bootCallback(){

    //}
}
