<?php

namespace Modules\Blog\Models;

//------- services ----
use Illuminate\Database\Eloquent\Model;
//----- models ---
use Modules\LU\Models\User;
//------- traits ---
use Modules\Xot\Traits\Updater;

//------- services ----

class Comment extends BaseModel
{
    protected $fillable = ['id', 'post_id', 'post_type', 'related_type', 'auth_user_id', 'txt', 'lang'];

    public function ratingObjectives()
    {
        return $this->hasMany(Rating::class, 'related_type', 'post_type');
    }

    public function linked()
    {
        return $this->morphTo('post');
    }

    public function ratings()
    {
        return $this->linked->ratings();
    }

    public function commentRatings()
    {
        /*
        return $this->hasMany(RatingMorph::class, 'post_id', 'post_id')
                ->where('post_type',$this->post_type)
                ->where('auth_user_id',$this->auth_user_id);
        */
        //return $this->morphTo('post');//linked
        //return $this->morphOne(Image::class, 'post');

        //return $this->morphMany(Image::class, 'post');//uguale a morphone senza limit 1
        //return $this->morphToMany(Rating::class, 'post');
        //return $this->morphedByMany('App\Post', 'taggable');
        $related = Rating::class;
        $name = 'post';
        $pivot_table = 'rating_morph';
        $foreignPivotKey = 'post_id';
        $relatedPivotKey = 'related_id';
        $parentKey = 'id';
        $relatedKey = 'post_id';
        $inverse = false;

        return $this->morphToMany( //retituisce i voti che danno gli altri al commento
            $related,
            $name,
            $pivot_table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $inverse
        );
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'auth_user_id', 'auth_user_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }

    //--- mutators ---
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    //---- funzione tampone ---
    public function userName()
    {
        $user = $this->user;
        if (is_object($user)) {
            return $user->handle;
        }

        return 'Unknown';
    }
}
