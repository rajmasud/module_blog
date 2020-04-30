<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class RatingMorph extends BaseMorphPivot
{
    protected $fillable = ['id', 'post_id', 'post_type', 'rating_id', 'related_type', 'rating', 'auth_user_id'];

    //-------- RELATIONSHIP -----------
    public function rating()
    {
        return $this->hasOne(Rating::class); //, 'id', 'rating_id');
    }
}
