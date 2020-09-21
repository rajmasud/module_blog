<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class EventMorph extends BaseMorphPivot
{
    protected $fillable = [
        'id', 'post_id', 'post_type', 'event_id', 'related_type', //-- testare se toglierli
        'auth_user_id',
        //'title','value',
    ];
}
