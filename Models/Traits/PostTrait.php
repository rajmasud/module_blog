<?php



namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;

//----- models------
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostRelatedPivot;
//------ traits ---
use Modules\Theme\Services\ThemeService;

trait PostTrait
{
    //--------- relationship --------------
    public function post()
    {
        $row = $this->hasOne(Post::class, 'post_id', 'post_id')
                ->where('lang', \App::getLocale())
                ->where('type', $this->post_type)
                ->withDefault()
                ;

        return $row;
    }

    public function postOrCreate()
    {
        $post = $this->post;
        if (null == $post) {
            $post = Post::firstOrCreate(['guid' => $this->guid, 'type' => $this->post_type, 'lang' => \App::getLocale()], ['title' => $this->title]);
            self::where('post_id', $post->post_id)->delete();
            $this->post_id = $post->post_id;
            $this->save();
            $this->post = $post;
        }

        return $post;
    }

    public function related()
    {
        //return $this->belongsToMany(PostRev::class, 'blog_post_related', 'post_id', 'related_id')
        //belongsToMany($related, $table, $foreignPivotKey, $relatedPivotKey,$parentKey, $relatedKey, $relation)
        //echo '<br/>'.$this->post_type;
        $pivot_fields = ['type', 'pos', 'price', 'price_currency', 'id'];
        $rows = $this->belongsToMany(Post::class, 'blog_post_related', 'post_id', 'related_id', 'post_id', 'post_id')
                ->withPivot($pivot_fields)
                ->using(PostRelatedPivot::class)
                ->where('lang', \App::getLocale())
                //->with(['linked'])
                ;
        //echo '<pre>'.$rows->toSql().'</pre>';
        return $rows;
    }

    public function relatedrev()
    {
        //return $this->belongsToMany(PostRev::class, 'blog_post_related', 'related_id', 'post_id')
        $pivot_fields = ['type', 'pos', 'price', 'price_currency', 'id'];
        $rows = $this->belongsToMany(Post::class, 'blog_post_related', 'related_id', 'post_id', 'post_id', 'post_id')
                ->withPivot($pivot_fields)
                //->using(PostRelatedPivot::class)
                ->where('lang', \App::getLocale());
        //echo '<pre>'.$rows->toSql().'</pre>';
        return $rows;
    }

    public function relatedType($type)
    {
        if (false === \mb_strpos($type, '_x_')) {
            $type = $this->post_type.'_x_'.$type;
        }

        return $this->related()->wherePivot('type', $type); //->where('lang',\App::getLocale());
        //return $this->related->where('pivot.type', $type);//->where('lang',\App::getLocale());
    }

    //----------- mutators --------------------
    public function getTypeAttribute($value)
    {
        return camel_case(class_basename($this));
    }

    //------ functions -------------------
    /*
    public function image_html($params){
        $type='canvas'; // canvas ,cropped
        $class='';
        $src=$this->image_src;
        extract($params);
        $src1=ThemeService::imageResizeSrc($params);
        return '<img src="'.asset($src1).'" alt="'.$this->image_alt.'" title="'.$this->image_title.'"  width="'.$width.'px" height="'.$height.'px" class="'.$class.'"/>';
    }
    */
}//end PostTrait
