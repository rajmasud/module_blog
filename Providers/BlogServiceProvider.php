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

use Modules\Xot\Providers\XotBaseServiceProvider;

class BlogServiceProvider extends XotBaseServiceProvider{
	protected $module_dir= __DIR__;
    protected $module_ns=__NAMESPACE__;
    public $module_name='blog';  
}