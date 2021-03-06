<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;
//----- traits ----
use Modules\Blog\Models\Traits\RatingTrait;
use Modules\LU\Models\Traits\HasProfileTrait;

//------services---------

//--- models ---

class Article extends BaseModelLang {
    use RatingTrait;
    use HasProfileTrait;

    protected $fillable = [
        'id', 'pos', 'article_type', 'published_at',
        'parent_id', 'parent_type', 'is_featured', 'auth_user_id',
    ];
    protected $appends = ['title'];
    /* https://itnext.io/7-things-you-need-to-know-to-get-the-most-out-of-your-laravel-model-4f915acbb47c */

    //--------- relationship ---------------
    public function sons() {
        return $this->hasMany(Article::class, 'parent_id', 'id')->orderBy('pos');
    }

    public function articles() {
        return $this->hasMany(Article::class, 'parent_id', 'id');
    }

    public function categories() {
        return $this->morphRelated(Category::class, true);
    }

    public function images() {
        return $this->morphMany(Image::class, 'post');
    }

    public function tags() {
        return $this->morphRelated(Tag::class, true);
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'post');
    }

    //---------- mututars -----------
    public function getParentIdAttribute($value) {
        if ('' != $value) {
            return $value;
        }

        if (null == $this->getKey()) {
            return null;
        }

        $value = 0;
        $this->parent_id = $value;
        $this->save();

        return $value;
    }

    /*
    public function setPublishedAtAttribute($value) {
        ddd($value);
        if (\is_string($value)) {
            //$value = Carbon::now();
            //config('app.date_format')
            $value=Carbon::createFromFormat('d/m/Y H:i', $value);
        }
        $this->attributes['published_at'] = $value;
    }
    //*/
}//end model
