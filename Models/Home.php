<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\RatingTrait;

//------services---------
//--- TRAITS ---

class Home extends BaseModelLang {
    use RatingTrait;
    protected $fillable = ['id', 'article_type', 'icon_src'];
    //--------- relationship ---------------

    //---------- mututars -----------
}//end model
