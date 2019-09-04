<?php

namespace Modules\Blog\Models;

//------services---------

class Page extends BaseModel {
    protected $fillable = ['post_id', 'article_type', 'published_at', 'category_id', 'layout_position'];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['published_at','created_at', 'updated_at' ];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}//end model
