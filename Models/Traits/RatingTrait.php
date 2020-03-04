<?php

namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;

//----- models------
use Modules\Blog\Models\Rating;
//---- services -----
use Modules\Xot\Services\PanelService as Panel;

//------ traits ---

trait RatingTrait {
    //----- relationship -----
    /*
    public function ratings(){
    $related=Rating::class;
    if(is_string($related)){
    $pivot=$related.'Morph';
    }else{
    $pivot=get_class($related).'Morph';
    }
    $name='post';
    $pivot_table=with(new $pivot)->getTable();
    $pivot_fields=with(new $pivot)->getFillable();
    //ddd($pivot_fields);
    $foreignPivotKey = 'post_id';
    $relatedPivotKey = 'related_id';
    $parentKey = 'post_id';
    $relatedKey = 'post_id';
    $inverse=false;
    //$related_table=with(new $related)->getTable();
    //return $this->morphRelated($related);
    ///*
    return $this->morphToMany($related, $name,$pivot_table, $foreignPivotKey,
    $relatedPivotKey, $parentKey,
    $relatedKey, $inverse)
    ->withPivot($pivot_fields)
    //->wherePivot('auth_user_id',\Auth::user()->auth_user_id)
    ;
    }
     */
    public function ratings() {
        /*
        $related = Rating::class;
        return $this->morphRelated($related);
        select * from `rating_morph` where `rating_morph`.`post_id` = 1 and `rating_morph`.`post_id` is not null and `post_type` = 'restaurant' limit 20 offset 0
         */
        //return $this->hasMany(RatingMorph::class,'post_id','post_id')->where('post_type',$this->post_type);
        //return $this->morphMany(RatingMorph::class, 'post');
        $related = Rating::class;

        return $this->morphRelated($related);
    }



    public function ratingObjectives() {
        $related = Rating::class;
        $user_id=\Auth::id();
        return $this->hasMany($related, 'related_type', 'post_type')
            ->selectRaw(
                'ratings.*,
                count(rating) as rating_count,
                avg(rating) as rating_avg,
                sum(if(auth_user_id="'.$user_id.'",rating,0)) AS rating_my
                '
            )->leftJoin(
                'rating_morph',
                function ($join) {
                    $join->on('rating_morph.related_id', 'ratings.post_id')
                        ->whereRaw('rating_morph.post_type = ratings.related_type')
                        ->where('rating_morph.post_id', $this->post_id);
                }
            )->groupBy('ratings.post_id');
        }

    public function scopeWithRating($query){
        return $query->leftJoin('rating_morph',
            function($join){
                $join->on('rating_morph.post_type = ratings.related_type');
            }
        );
    }


    public function myRatings() {
        //$auth_user_id = \Auth::user()->auth_user_id;
        /*
        $rows = $this->ratings()->wherePivot('auth_user_id', $auth_user_id);
        return $rows;
         */
        //--
        /*
        return $this->morphMany(RatingMorph::class, 'post')
        ->where('auth_user_id', \Auth::id());

         */
        //*
        $related = Rating::class;

        return $this->morphRelated($related)
            ->wherePivot('auth_user_id', \Auth::id());
        //*/
    }

    //----- mutators -----
    //*
    public function getMyRatingAttribute($value) {
        $my = $this->myRatings;

        return $my->pluck('pivot.rating', 'post_id');
    }

    //*/
    /*
    public function setMyRatingAttribute($value){
    ddd($value);
    }
     */

    //------ functions ------
    public function ratingAvgHtml() {
        $ratings = $this->ratings;
        //ddd($ratings->count('rating'));
        //return '&#11088;&starf;&star;() '.$ratings->count('rating');
        $msg = '('.$ratings->avg('rating').') '.$ratings->count('rating').' Votes ';
        $rating_url = Panel::get($this)->relatedUrl(['related_name' => 'my_rating', 'act' => 'index_edit']);

        return $msg.'<a data-href="'.$rating_url.'" class="btn btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="Rate it">
        Rate It </a>';
    }
}
