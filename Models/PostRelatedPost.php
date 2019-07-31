<?php



namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Blog\Models\PostContent.
 *
 * @property \Modules\Blog\Models\Post $Post
 * @mixin \Eloquent
 */
class PostRelatedPost extends Model
{
    protected $table = 'blog_post_related_post';
    protected $primaryKey = 'id';
}
