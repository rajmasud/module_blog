<?php
namespace Modules\Blog\Models;
//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;
//--------- models --------
use Modules\LU\Models\User;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
use Modules\Blog\Models\Traits\PrivacyTrait;
//use Modules\Extend\Traits\Updater;
//--- services
use Modules\Theme\Services\ThemeService;


use Modules\Blog\Models\Privacy;

/**
 * { item_description }
 * da fare php artisan scout:import Modules\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel {
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
    use PrivacyTrait; // da mettere anche in restaurant owner ?

    protected $connection = 'mysql'; // this will use the specified database conneciton
    protected $table = 'blog_post_profiles';
    protected $fillable = ['post_id'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    
    //------- RELATIONSHIP ----------

    
}//end model
