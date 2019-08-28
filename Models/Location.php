<?php
namespace Modules\Blog\Models;
//--------- models --------
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostRelated;
//--- services
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Services\ImportService;

//--- traits 

class Location extends BaseModel {
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships; 
    //https://github.com/staudenmeir/eloquent-has-many-deep#morphedbymany
    public      $table          = 'import_items'; //<name pack>_items
    protected   $primaryKey     = 'post_id';
    public      $incrementing   = true;

    protected $fillable = ['post_id', 'latitude', 'longitude', 'address1', 'address2', 'address3', 'city', 'zip_code', 'country', 'state', 'phone', 'display_phone', 'price', 'is_closed', 'review_count', 'yelp_url', 'rating'];

    public static $food_engines = ['justeat', 'sgnamit', 'googleplace', 'foodracers',
            'foodora', 'moovenda', 'deliveroo',
            'bacchetteforchette',
            'theforkit', 'misiedocom',
            'yelp', 'zomato', 'restopolitanit',
            'mymenu', 'foodpanda', 'facebook',
    ];
    public static $address_components = [
            'premise', 'locality', 'postal_town',  
            'administrative_area_level_3','administrative_area_level_2',  'administrative_area_level_1', 
             'country', 
             'street_number', 'route', 'postal_code', 
             'googleplace_url',
            'point_of_interest', 'political', 'campground',
        ];

    //-------- relationships ----------------------
    public function restaurantProviders()
    {
        $rows = $this->hasManyThrough(
            RestaurantProvider::class,
            Restaurant::class,
            'locality', // Foreign key on Restaurant table...
            'post_id', // Foreign key on posts table...
            'locality', // Local key on Location table...
            'post_id' // Local key on Restaurant table...
        );

        return $rows;
    }


    public function restaurants(){
        $related_table=with(new Restaurant)->getTable();
        return $this->hasMany(Restaurant::class,'locality','locality')
            ->join('blog_posts','blog_posts.post_id','=',$related_table.'.post_id')
            ->where('blog_posts.lang',$this->lang)
            ->where('blog_posts.post_type','restaurant')
            ->with(['cuisineCats','post']);
    }

    public function cuisineCats(){
        $related_table=with(new CuisineCat)->getTable();
        return $this->hasManyDeepFromRelations($this->restaurants(), (new Restaurant)->cuisineCats())
         //* 
            ->join('blog_posts','blog_posts.post_id','=',$related_table.'.post_id')
            ->where('blog_posts.lang',$this->lang)
            ->where('blog_posts.post_type','cuisineCat')
            ->groupBy('blog_posts.guid')
            //*/
            ->with(['post']);
            ;
    }

    //-------- mutators ------

    public function getFoodEnginesAttribute($value){
        return self::$food_engines;
    }

    public function getRestaurantsCountAttribute($value){
        return $this->restaurants->count();
    }

    public function getCuisineCatsCountAttribute($value){
        return '?? da fare';
    }

    public function getImageSrcAttribute($value){
        if ('' == $value) {
            $ris = ImportService::pixabay(['q' => $this->locality.' '.$this->country]);
            if (\is_object($ris)) {
                $value = $ris->webformatURL;
            }
        }

        return $value;
    }

    public function getUrlAttribute($value){
        if (!$this->post) {
            $post = Post::firstOrCreate(
                ['guid' => $this->guid, 'type' => $this->post_type, 'lang' => \App::getLocale()],
                ['title' => $this->title]
            );
            $post->title = $this->title;
            $post->save();
            if ($this->post_id != $post->post_id) {
                self::where('post_id', $post->post_id)->delete();
                $this->post_id = $post->post_id;
                $this->save();
            }
            $this->post = $post;
            //return $post->url;
        }

        return $this->post->url;
    }

}
