<<<<<<< HEAD
<?php

namespace Modules\Blog\Models;

class Photo extends BaseModel {
    protected $fillable = ['post_id', 'article_type', 'published_at'];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
=======
<?php

namespace Modules\Blog\Models;

class Photo extends BaseModel {
    protected $fillable = ['post_id', 'article_type', 'published_at'];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
>>>>>>> ,
