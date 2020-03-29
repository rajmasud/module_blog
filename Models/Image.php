<?php

namespace Modules\Blog\Models;

//----- traits ----

class Image extends BaseModel {
    //protected $fillable = ['post_id', 'article_type', 'published_at'];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
}
