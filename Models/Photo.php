<?php

namespace Modules\Blog\Models;

//----- traits ----
use Modules\Blog\Models\Traits\RatingTrait;

class Photo extends BaseModelLang
{
    //use RatingTrait;
    protected $fillable = ['id', 'article_type', 'published_at'];
}
