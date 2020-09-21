<?php

namespace Modules\Blog\Models;

class MyRating extends BaseModelLang
{
    protected $table = 'ratings';
    protected $fillable = ['id', 'my_rating', 'related_type'];
    protected $appends = ['my_rating'];
}
