<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\RatingTrait;
//------services---------
//--- TRAITS ---
use Modules\Xot\Models\Traits\HomeTrait;

class Home extends BaseModelLang {
    use HomeTrait;
    use RatingTrait;
    protected $fillable = ['id', 'article_type', 'icon_src'];

    //--------- relationship ---------------

    //---------- mututars -----------
}//end model
