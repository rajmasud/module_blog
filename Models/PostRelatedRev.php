<?php



namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Modules\Blog\Models\PostContent.
 *
 * @property \Modules\Blog\Models\Post $Post
 * @mixin \Eloquent
 */
class PostRelatedRev extends Model
{
    //class PostRelatedRev extends Pivot {
    protected $table = 'blog_post_related';
    protected $primaryKey = 'related_id';

    //public $incrementing = true;
    //$timestamps = false;
    /*
    protected $fillable =   [
                                'email',
                                'verification_token'
                            ];
    */
    public function post()
    {
        return $this->belongsTo(Post::class, 'related_id', 'post_id');
    }

    public function setPrimaryKey($pk)
    {
        $this->primaryKey = $pk;
    }
}
