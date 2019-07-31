<?php
namespace Modules\Blog\Models;
//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;
//--- services
use Modules\Theme\Services\ThemeService;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Extend\Traits\Updater;
//--------- models --------

class PostCat extends BaseModel
{
    //use Updater;
    //use Searchable;
    //use LinkedTrait;
    //use PostTrait; //vecchio

    protected $table = 'blog_post_cats';
    protected $primaryKey = 'post_id';
    public $incrementing = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at',
    ];

    protected $fillable = [
        'post_id', //importante per le tabelle collegate
    ];

    //-------- relationship ------
    public function posts()
    {
        $type = $this->post_type.'_x_post';

        return $this->related()->wherePivot('type', $type);
    }

    //-------- mutators ------

    public function formFields()
    {
        //$view=ThemeService::getView(); //non posso usarla perche' restituisce la view del chiamante
        //return view('blog::admin.post.partials.restaurant')->with('row',$this);
        return null;
    }
}
