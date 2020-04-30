<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class PrivacyMorph extends BaseMorphPivot
{
    protected $fillable = [
        'id', 'post_id', 'post_type', 'privacy_id', 'related_type', //-- testare se toglierli
        'auth_user_id',
        'title', 'value',
    ];
    //---------------------------------------------------------------------------
    public function privacy()
    {
        return $this->hasOne(Privacy::class);//, 'id', 'privacy_id');
    }

    //---------- mutators -------------------
    /*
    public function setTitleAttribute($value) {
        if (! isset($this->attributes['value'])) {
            $this->attributes['value'] = 0;
        }
    }
    */
}
