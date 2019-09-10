<<<<<<< HEAD
<?php

namespace Modules\Blog\Models;

class Privacy extends BaseModel {
    protected $fillable = ['post_id', 'related_type', 'obligatory'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
=======
<?php

namespace Modules\Blog\Models;

class Privacy extends BaseModel {
    protected $fillable = ['post_id', 'related_type', 'obligatory'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
>>>>>>> ,
