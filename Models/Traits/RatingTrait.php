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
        $user_id = \Auth::id();

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
                    $join->on('rating_morph.rating_id', 'ratings.id')
                        ->whereRaw('rating_morph.post_type = ratings.related_type')
                        ->where('rating_morph.post_id', $this->id);
                }
            )->groupBy('ratings.id')
            ->with('post');
    }

    public function scopeWithRating($query) {
        return $query->leftJoin(
            'rating_morph',
            function ($join) {
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

    public function getRatingsAvgAttribute($value) {
        if ($value = '') {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if ('' != $value) {
            $this->ratings_avg = $value;
            $this->save();
        }

        return $value;
    }

    public function getRatingsCountAttribute($value) {
        if ($value = '') {
            return $value;
        }
        $value = $this->ratings->count('pivot.rating');
        $this->ratings_count = $value;
        $this->save();

        return $value;
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
        $pivot_avg = $ratings->avg('pivot.rating');
        $pivot_cout = $ratings->count('pivot.rating');

        $msg = '<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';

        //$rating_url = Panel::get($this)->relatedUrl(['related_name' => 'my_rating', 'act' => 'index_edit']);
        $rating_url = Panel::get($this)->showUrl().'?_act=rate';
        //http://geek.local/public_html/it/article/prova-articolo?_act=rate
        /*
        return $msg.'<a data-href="'.$rating_url.'" class="btn btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="Rate it">
        Rate It </a>';
        */
        $title = 'Vota '.$this->title;

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btn_iframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btn_iframe;
    }
}
