<?php
namespace Modules\Blog\Models;

use Carbon\Carbon;
//use Laravel\Scout\Searchable;

//use Illuminate\Database\Eloquent\Model;
//------services---------
use Modules\Theme\Services\ThemeService;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Extend\Traits\Updater;

/**
 * { item_description }
 * da fare php artisan scout:import Modules\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
<<<<<<< HEAD
class Page extends BaseModel{
=======
class Page extends BaseModel
{
>>>>>>> the first commit
    //use Searchable; //se non si crea prima indice da un sacco di errori
    /*
    use Updater;
    use LinkedTrait;
    */
    protected $table = 'blog_post_pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'article_type', 'published_at', 'category_id', 'layout_position'];
    protected $appends = ['category_id'];
    protected $casts = [
        'category_id' => 'integer',
    ];
    protected $dates = ['published_at'/* 'created_at', 'updated_at'*/];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
<<<<<<< HEAD
    /*
=======

>>>>>>> the first commit
    public function filter($params)
    {
        $row = new self();

        return $row;
    }
<<<<<<< HEAD
    */
=======

>>>>>>> the first commit
    //end filter

    //--------- relationship ---------------
    /* on linkedtrait
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
    */
<<<<<<< HEAD
    /*
=======
>>>>>>> the first commit
    public function relatedType($type)
    {
        $post = $this->post;
        if (null == $post) {
            //dd($this->post_id); //null
            return null;
        }

        return $post->related()->wherePivot('type', $type); //->where('lang',\App::getLocale());
    }
<<<<<<< HEAD
    */
=======

>>>>>>> the first commit
    //---------- mututars -----------
    /*
    public function getPublishedAtAttribute($value){
        return Carbon::parse($value)->formatLocalized('%d/%m/%Y %I:%M %p');
        //return $value->formatLocalized('%d/%m/%Y %H:%M');
    }
    //*/
<<<<<<< HEAD
    /*
=======
>>>>>>> the first commit
    public function setPublishedAtAttribute($value)
    {
        //-- with datetimelocal
        if (\is_string($value)) {
            $value = Carbon::parse($value);
        }
        $this->attributes['published_at'] = $value; //->toDateString();
    }
<<<<<<< HEAD
    */
=======

>>>>>>> the first commit
    /*
    public function getArticleTypeAttribute($value){
        dd(\Request::input('category_id'));
    }
    */
<<<<<<< HEAD
    /*
=======

>>>>>>> the first commit
    public function setArticleTypeAttribute($value)
    {
        //dd();
        $this->setCategoryIdAttribute(\Request::input('category_id'));
        $this->attributes['article_type'] = $value;
    }
<<<<<<< HEAD
    */
    /*
=======

    //*
>>>>>>> the first commit
    public function getCategoryIdAttribute($value)
    {
        if (null == $this->relatedType('category')) {
            return null;
        }
        $row = $this->relatedType('category')->first();
        if (null == $row) {
            return null;
        }

        return $row->post_id;
    }

    //*/

   

    //--------- functions -----------
<<<<<<< HEAD
    /*
=======

>>>>>>> the first commit
    public function formFields()
    {
        //$view=ThemeService::getView(); //non posso usarla perche' restituisce la view del chiamante
        $roots = Post::getRoots();
        $view = 'blog::admin.partials.'.snake_case(class_basename($this));

        return view($view)->with('row', $this->post)->with($roots);
    }
<<<<<<< HEAD
    */
=======

>>>>>>> the first commit
    /*
     * Convert a DateTime to a storable string.
     *
     * @param  \DateTime|int  $value
     * @return string
     */
    //public function fromDateTime($value){
        //dd($value);//19/09/2017 12:06 AM
        //print_r($value);
        //$ris=Carbon::createFromFormat('d/m/Y H:i a',$value);
        //dd($ris);
        //return $ris;
    //}
}//end model
