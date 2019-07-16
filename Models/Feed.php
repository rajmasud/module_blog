<?php
namespace Modules\Blog\Models;

//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

//--- services
use Modules\Extend\Services\ThemeService;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Extend\Traits\Updater;

/**
 * { item_description }
 * da fare php artisan scout:import XRA\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
class Feed extends BaseModel
{
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
    protected $table = 'blog_feeds';
    protected $fillable = ['post_id'];
    //public $incrementing = true;

    public function formFields()
    {
        //$view=ThemeService::getView(); //non posso usarla perche' restituisce la view del chiamante
        //return view('blog::admin.post.partials.'.strtolower(class_basename($this)) )->with('row',$this);
        return false;
    }
}
