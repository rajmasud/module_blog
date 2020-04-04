<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;

//------services---------
//--- TRAITS ---

class Home extends BaseModel {
    protected $fillable = ['post_id', 'article_type', 'icon_src',];
    protected $appends = [];
    protected $casts = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    //--------- relationship ---------------

    //---------- mututars -----------
    
}//end model
