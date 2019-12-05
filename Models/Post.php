<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
//--- traits ---
use Modules\Xot\Traits\Updater;

//---- services --

//--- models ---

/**
 * NO BaseModel.
 *
 **/
class Post extends Model {
    protected $connection = 'mysql';
    protected $fillable = [
        'id', 'post_id', 'lang', 'guid',
        'title',
        'subtitle',
        'post_type',
        'txt',
        //------ IMAGE ---------
        'image_src', 'image_alt', 'image_title',
        //------ SEO FIELDS -----
        'meta_description', 'meta_keyword', // seo
        'author_id',
        'url', 'url_lang', //buffer
        'image_resize_src', // buffer
    ];

    protected $appends = [];

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
        'published_at',
    ];

    protected $casts = [
        'image_resize_src' => 'array',
        'url_lang' => 'array',
    ];

    use Updater;

    public function getRouteKeyName() {
        return in_admin() ? 'guid' : 'post_id';
    }

    //-------- relationship ------
    public function linkable() {
        return $this->morphTo('post');
    }

    public function archive() {
        $lang = $this->lang;
        $post_type = $this->post_type;
        $obj = $this->getLinkedModel();
        $table = $obj->getTable();
        $post_table = with(new Post())->getTable();
        $rows = $obj->join($post_table, $post_table.'.post_id', $table.'.post_id')
                    ->where('lang', $lang)
                    ->where($post_table.'.post_type', $post_type)
                    ->where($post_table.'.guid', '!=', $post_type)
                    ->orderBy($table.'.updated_at', 'desc')
                    ->with('post')
                    ;

        return $rows;
    }

    //end function
    //-------------- MUTATORS ------------------
    public function getTitleAttribute($value) {
        if ('' != $value) {
            return $value;
        }
        $value = $this->attributes['post_type'].' '.$this->attributes['post_id'];
        $this->title = $value;
        $this->save();

        return $value;
    }

    public function getGuidAttribute($value) {
        if ('' != $value) {
            return $value;
        }

        //$value = Str::slug($this->attributes['title']);
        $value = $this->title;
        if ('' == $value) {
            $value = Str::slug($this->attributes['post_type'].' '.$this->attributes['post_id']);
        }
        $this->guid = $value;
        $this->save();

        return $value;
    }
}//end class
