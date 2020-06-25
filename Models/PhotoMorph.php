<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class PhotoMorph extends BaseMorphPivot
{
    protected $fillable = [
        'id',
        'post_id', 'post_type',
        'photo_id', 'related_type',
        'auth_user_id',
    ];
}
