<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Modules\Blog\Models\Traits\RatingTrait;
//------services---------
//--- TRAITS ---

class Home extends BaseModelLang
{
    use RatingTrait;
    protected $fillable = ['post_id', 'article_type', 'icon_src',];
    //--------- relationship ---------------

    //---------- mututars -----------
}//end model
