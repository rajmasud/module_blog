<?php
namespace Modules\Blog\Models;

//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;
//use Modules\Extend\Traits\Updater;
//--- Models ---//
//use Laralum\Users\Models\User;
use Modules\LU\Models\User;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;


/**
 * Modules\Blog\Models\Comment.
 *
 * @property \Modules\Blog\Models\Post $post
 * @property \XRA\LU\Models\User   $user
 * @mixin \Eloquent
 */
class Comment extends BaseModel
{
    use Searchable;
    use Updater;
    use LinkedTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'post_id', 'comment'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
