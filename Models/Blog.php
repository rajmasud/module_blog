<?php
namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends BaseModel {
    protected $fillable=['post_id'];
    protected $table = 'blog_posts';
    //----- relationship -------
}
