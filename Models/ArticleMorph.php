<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class ArticleMorph extends MorphPivot {
    use Updater;
    protected $fillable = [
        'id', 'post_id', 'post_type', 'related_id', 'related_type', //-- testare se toglierli
        'auth_user_id',
        //'title','value',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        // 'published_at',
    ];
    protected $appends = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true; //Indicates if the model should be timestamped.
}
