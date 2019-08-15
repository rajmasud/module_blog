<?php
namespace Modules\Blog\Models;

//use Illuminate\Database\Eloquent\Model;
//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;

/**
 * Modules\Blog\Models\PostContent.
 *
 * @property \Modules\Blog\Models\Post $Post
 * @mixin \Eloquent
 */
class PostContent extends BaseModel
{
	//use LinkedTrait;
    protected $table = 'blog_post_contents';
    public $incrementing = true;

    public function Post()
    {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }
}
