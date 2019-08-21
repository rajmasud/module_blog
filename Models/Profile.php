<?php
namespace Modules\Blog\Models;
<<<<<<< HEAD

//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

=======
//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
//--------- models --------
use Modules\LU\Models\User;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
<<<<<<< HEAD
=======
use Modules\Blog\Models\Traits\PrivacyTrait;
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD
class Profile extends BaseModel
{
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
=======
class Profile extends BaseModel {
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
    use PrivacyTrait; // da mettere anche in restaurant owner ?

>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
    protected $connection = 'mysql'; // this will use the specified database conneciton
    protected $table = 'blog_post_profiles';
    protected $fillable = ['post_id'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    
    //------- RELATIONSHIP ----------

<<<<<<< HEAD
    public function privacies(){
        $related=Privacy::class;
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
                    ->wherePivot('auth_user_id',\Auth::user()->auth_user_id)
                    ->withTimestamps()
        ;
    }


    /*
    public function filter($params)
    {
        $row = new self();

        return $row;
    }
    */

    //end filter
    /*
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public function relatedType($type)
    {
        return $this->post->related()->wherePivot('type', $type); //->where('lang',\App::getLocale());
    }
    
    public function formFields()
    {
        //$view=ThemeService::getView(); //non posso usarla perche' restituisce la view del chiamante
        //return view('blog::admin.post.partials.'.strtolower(class_basename($this)) )->with('row',$this);
        return false;
    }

    public function sync()
    {
        $users = User::whereRaw('1=1');
        $lang = \App::getLocale();
        //dd($users->get());
        foreach ($users->get() as $user) {
            //echo '<br/>'.$user->handle;
            $row = Post::firstOrCreate(['guid' => $user->handle, 'lang' => $lang, 'type' => 'profile'], ['title' => 'profile of '.$user->handle]);
        }
        
        return; //'aaa';
    }
    */
=======
    
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
}//end model
