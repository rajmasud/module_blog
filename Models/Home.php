<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\RatingTrait;
//------services---------
//--- TRAITS ---
use Modules\Xot\Models\Traits\WidgetTrait;

class Home extends BaseModelLang {
    use WidgetTrait;
    use RatingTrait;
    protected $fillable = ['id', 'article_type', 'icon_src'];

    //--------- relationship ---------------

    //---------- mututars -----------
}//end model
