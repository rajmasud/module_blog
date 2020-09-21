<?php

namespace Modules\Blog\Models;

class Category extends BaseModelLang {
    protected $fillable = ['id', 'related_type'];

    public function articles() {
        return $this->morphRelated(Article::class);
    }
}
