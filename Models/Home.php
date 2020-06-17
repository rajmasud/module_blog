<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Traits\RatingTrait;
use Modules\Xot\Models\Widget;

//------services---------
//--- TRAITS ---

class Home extends BaseModelLang {
    use RatingTrait;
    protected $fillable = ['id', 'article_type', 'icon_src'];

    //--------- relationship ---------------
    public function widgets() {
        return $this->morphMany(Widget::class, 'post')->orderBy('pos');
    }

    //---------- mututars -----------
}//end model
