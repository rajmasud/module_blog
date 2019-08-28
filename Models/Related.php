<?php
namespace Modules\Blog\Models;

//use Illuminate\Database\Eloquent\Model;
//use Laralum\Users\Models\User;

//use Laravel\Scout\Searchable;
//--- Models ---//
//use Modules\Blog\Models\Post\PostTrait;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Xot\Traits\FilterTrait;
//use Modules\Xot\Traits\Updater;
use Modules\LU\Models\User;

//https://developers.google.com/search/docs/data-types/articles

/**
 * Modules\Blog\Models\Post.
 *
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\PostContent[] $PostContent
 * @property \Modules\Blog\Models\Category                                               $category
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Comment[]     $comments
 * @property \XRA\LU\Models\User                                                     $user
 * @mixin \Eloquent
 */
class Related extends BaseModel
{
    //use FilterTrait;
    // use Searchable; //ne update quando aggiungo un array mi da errore
    //use Updater;
    //use PostTrait;
    //use LinkedTrait;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at',
    ];

    protected $casts = [
        //'is_admin' => 'boolean',
        'content' => 'array',
        'content_type' => 'array',
    ];

    //protected $primaryKey = ['post_id','lang'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guid',
        'lang',
        'title',
        'type',
        'user_id',
        'category_id',
        'title',
        'description',
        'content',
       // 'parent_id',  //nella prox versione forse va a prendere il setAttributeId
    ];

    protected $appends = [
       // 'parent_id',
     ];
}
