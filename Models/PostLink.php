<<<<<<< HEAD
<?php

namespace Modules\Blog\Models;

class PostLink extends BaseModel {
    protected $fillable = ['post_id', 'url', 'title', 'type'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
=======
<?php

namespace Modules\Blog\Models;

class PostLink extends BaseModel {
    protected $fillable = ['post_id', 'url', 'title', 'type'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
>>>>>>> ,
