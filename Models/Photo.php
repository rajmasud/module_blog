<?php

namespace Modules\Blog\Models;

//----- traits ----
use Modules\Blog\Models\Traits\RatingTrait;

class Photo extends BaseModel {
    use RatingTrait;
    protected $fillable = ['post_id', 'article_type', 'published_at'];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}
