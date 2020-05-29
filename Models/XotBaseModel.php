<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
//---------- traits
use Modules\Blog\Models\Traits\LinkedTrait;
use Modules\Xot\Traits\Updater;

abstract class XotBaseModel extends Model {
    use Updater;
    use Searchable;
    use LinkedTrait;
    //-------------
    /*
    protected $lang;
    protected $post;
    */
}
