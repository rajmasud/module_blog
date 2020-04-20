<?php

namespace Modules\Blog\Models;

//------services---------

class Page extends BaseModel
{
    protected $fillable = ['post_id', 'pos', 'article_type', 'published_at', 'category_id',
     'layout_position', 'blade','parent_id','icon',
     'is_modal',
    ];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;

    //--------- relationship ---------------
    public function sons()
    {
        return $this->hasMany(self::class, 'parent_id', 'post_id');
    }
}//end model
