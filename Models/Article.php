<?php
namespace Modules\Blog\Models;

use Carbon\Carbon;
//use Laravel\Scout\Searchable;

//use Illuminate\Database\Eloquent\Model;
//---- traits 
//use Modules\Extend\Traits\Updater;
//use Modules\Blog\Models\Traits\LinkedTrait;
//------services---------
use Modules\Theme\Services\ThemeService;

//--- models ---

/**
 * { item_description }
 * da fare php artisan scout:import Modules\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel
{
    //use Searchable; //se non si crea prima indice da un sacco di errori
    /*
    use Updater;
    use LinkedTrait;
    */
    protected $table = 'blog_post_articles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'article_type', 'published_at','guid'];
    //protected $appends=['category_id'];
    protected $casts = [
        //'category_id' => 'integer',
    ];
    protected $dates = ['published_at'/* 'created_at', 'updated_at'*/];
    protected $primaryKey = 'post_id';
    public $incrementing = true;

    public function filter($params)
    {
        $row = new self();
        \extract($params);

        return $row;
    }

    //end filter

    //--------- relationship ---------------
    /*
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
    */

    /*
    public function relatedType($type){
        $post=$this->post;
        if($post==null){
            //dd($this->post_id); //null
            return null;
        }
        return $post->related()->wherePivot('type', $type);//->where('lang',\App::getLocale());
    }

    public function relatedrevType($type){
        $post=$this->post;
        if($post==null){
            //dd($this->post_id); //null
            return null;
        }
        return $post->relatedrevType($type);
    }
    */

    //---------- mututars -----------
    /*
    public function getPublishedAtAttribute($value){
        return Carbon::parse($value)->formatLocalized('%d/%m/%Y %I:%M %p');
        //return $value->formatLocalized('%d/%m/%Y %H:%M');
    }
    //*/

    public function setPublishedAtAttribute($value)
    {
        if (\is_string($value)) {
            //ddd($value);
            /*
            $format='d/m/y H:i A';
            ddd(Carbon::now()->format($format));
            $str='6/07/2019 12:28 PM';
            ddd(Carbon::createFromFormat('d/m/y H:i A',$str));
            */
            $value=Carbon::now();
        }
        /*
        //-- with datetimelocal
        
            //$value = Carbon::parse($value);
            $value = Carbon::createFromFormat('d/m/y H:i A',$value);
        }
        $this->attributes['published_at'] = $value; //->toDateString();
        */
        $this->attributes['published_at'] = $value; 
    }

    /*
    public function getArticleTypeAttribute($value){
        dd(\Request::input('category_id'));
    }
    */
    /*
    public function setArticleTypeAttribute($value)
    {
        //dd();
        $this->setCategoryIdAttribute(\Request::input('category_id'));
        $this->attributes['article_type'] = $value;
    }
    */
    
    /*
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
    /*
    public function formFields()
    {
        $roots = Post::getRoots();
        $view = 'blog::admin.partials.'.snake_case(class_basename($this));

        return view($view)->with('row', $this->post)->with($roots);
    }
    */
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
