<?php

namespace Modules\Blog\Models;

//------services---------

class Page extends BaseModelLang
{
    protected $fillable = ['id', 'pos', 'article_type', 'published_at', 'category_id',
     'layout_position', 'blade','parent_id','icon',
     'is_modal', 'status'
    ];

    //--------- relationship ---------------
    public function sons()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}//end model
