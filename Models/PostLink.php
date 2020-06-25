<?php

namespace Modules\Blog\Models;

class PostLink extends BaseModel
{
    protected $fillable = ['id', 'url', 'title', 'type'];
}
