<?php

namespace Modules\Blog\Models;

//------- services ----
use Illuminate\Database\Eloquent\Model;
//------- traits ---
use Modules\Xot\Traits\Updater;

//------- services ----

class Favorite extends BaseModel
{
    protected $fillable = ['id', 'post_id', 'post_type', 'auth_user_id'];
}
