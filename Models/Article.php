<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;
//----- traits ----
use Modules\Blog\Models\Traits\RatingTrait;

//------services---------

//--- models ---

class Article extends BaseModel {
    use RatingTrait;

    protected $fillable = ['post_id', 'pos', 'article_type', 'published_at', 'parent_id', 'parent_type'];
    protected $appends = ['title'];
    /* https://itnext.io/7-things-you-need-to-know-to-get-the-most-out-of-your-laravel-model-4f915acbb47c */
    protected $casts = [
        //'published_at' => 'datetime:Y-m-d', // da verificare
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    protected $hidden = [
        //'password'
    ];

    //--------- relationship ---------------
    public function sons() {
        return $this->hasMany(Article::class, 'parent_id', 'post_id');
    }

    public function articles() {
        return $this->hasMany(Article::class, 'parent_id', 'post_id');
    }

    //---------- mututars -----------
    public function getParentIdAttribute($value) {
        if ('' != $value) {
            return $value;
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
