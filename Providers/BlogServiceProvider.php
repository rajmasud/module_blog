<?php

namespace Modules\Blog\Providers;

//-------services --------
//-------models-----------
//use Modules\Blog\Models\PostRelated;
//use Modules\Xot\Models\ServiceProviderTrait;

use Modules\Xot\Providers\XotBaseServiceProvider;

class BlogServiceProvider extends XotBaseServiceProvider {
    protected $module_dir = __DIR__;
    protected $module_ns = __NAMESPACE__;
    public $module_name = 'blog';
}
