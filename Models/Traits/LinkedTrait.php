<?php

namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
//----- models------
use Modules\Blog\Models\Post;
//----- services -----
use Modules\Xot\Services\PanelService as Panel;
use Modules\Xot\Services\RouteService;
use Modules\Xot\Services\StubService;

//------ traits ---

trait LinkedTrait
{
    public function getRouteKeyName()
    {
        return \inAdmin() ? 'post_id' : 'guid';
    }

    //------- relationships ------------
    public function post()
    {
        return $this->morphOne(Post::class, 'post', null, 'post_id')->where('lang', $this->lang);
    }

    public function morphRelated($related, $inverse = false)
    {
        if ($inverse) {
            $model = $this;
            $pivot = get_class($this) . 'Morph';
        } else {
            if (is_string($related)) {
                $pivot = $related . 'Morph';
                $model = new $related();
            } else {
                $pivot = get_class($related) . 'Morph';
                $model = $related;
            }
        }
        $name = 'post';
        if (!class_exists($pivot)) {
            StubService::missingClass([
                'class' => $pivot,
                'stub'  => 'morph_pivot', //con questo crea anche la migration
                'model' => $model,
            ]);
            ddd('Refresh Page ');
        }

        $pivot_table  = with(new $pivot())->getTable();
        $pivot_fields = with(new $pivot())->getFillable();
        if ($inverse) {
            $foreignPivotKey = 'related_id';
            $relatedPivotKey = 'post_id';
        } else {
            $foreignPivotKey = 'post_id';
            $relatedPivotKey = 'related_id';
        }
        $parentKey  = 'post_id';
        $relatedKey = 'post_id';

        return $this->morphToMany(
            $related,
            $name,
            $pivot_table,
            $foreignPivotKey,
            $relatedPivotKey,
            $parentKey,
            $relatedKey,
            $inverse
        )
            ->using($pivot)
            ->withPivot($pivot_fields)
            ->withTimestamps()
        ;
    }

    //------- mutators -------------

    public function getPostTypeAttribute($value)
    {
        $post_type = collect(config('xra.model'))->search(get_class($this));
        if (false === $post_type) {
            $post_type = snake_case(class_basename($this));
        }

        return $post_type;
    }

    public function getLangAttribute($value)
    {
        if ($value != '') {
            return $value;
        }

        $lang = \App::getLocale();

        return $lang;
    }

    public function setGuidAttribute($value)
    {
        if ('' == $value) {
            $this->post->guid = Str::slug($this->attributes['title'] . ' ' . $this->attributes['subtitle']);
            $res              = $this->post->save();
        }
    }

    public function getPostAttr($func, $value)
    {
        $str0 = 'get';
        $str1 = 'Attribute';
        $name = substr($func, strlen($str0), -strlen($str1));
        $name = Str::snake($name);
        if ('' != $value) {
            return $value;
        }
        if ('Post' == class_basename($this)) {
            return $this->$name;
        }
        if (isset($this->pivot) && Str::endsWith($name, '_url')) { // solo le url dipendono dal pivot
            return $this->pivot->$name; //.'#PIVOT';
        }
        if (!isset($this->post) && '' != $this->getKey()) {
            $this->post = $this->post()->create(['lang' => \App::getLocale()]);
        }

        if (isset($this->post)) {
            return $this->post->$name; //.'#NO-PIVOT';
        }
        if (Str::endsWith($name, '_url')) {
            $act = Str::before($name, '_url');

            return RouteService::urlModel(['model' => $this, 'act' => $act]);
        }

        return $value;
    }

    //---- da mettere i mancanti ---
    public function getTitleAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getSubtitleAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getGuidAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getImageSrcAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    public function getTxtAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    //*
    public function getUrlAttribute($value)
    {
        /*
        return $this->getPostAttr(__FUNCTION__, $value);
         */
        return Panel::get($this)->url();
    }

    //*/
    public function getRoutenameAttribute($value)
    {
        return $this->getPostAttr(__FUNCTION__, $value);
    }

    //public function setTitleAttribute($value)       {return $this->setPostAttr(__FUNCTION__,$value);}
    //public function setSubtitleAttribute($value)    {return $this->setPostAttr(__FUNCTION__,$value);}
    //  public function setGuidAttribute($value)        {return $this->setPostAttr(__FUNCTION__,$value);}
    public function setImageSrcAttribute($value)
    {
        return $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setTxtAttribute($value)
    {
        return $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setUrlAttribute($value)
    {
        return $this->setPostAttr(__FUNCTION__, $value);
    }

    public function setRoutenameAttribute($value)
    {
        return $this->setPostAttr(__FUNCTION__, $value);
    }

    //--- attribute e' risertvato
    public function setPostAttr($func, $value)
    {
        $str0         = 'set';
        $str1         = 'Attribute';
        $name         = substr($func, strlen($str0), -strlen($str1));
        $name         = Str::snake($name);
        $data         = [$name => $value];
        $data['lang'] = \App::getLocale();
        //$this->post->$name=$value;
        //$res=$this->post->save();
        $this->post()->updateOrCreate($data);
        print_r($data);
        unset($this->attributes[$name]);
    }

    //*
    public function urlActFunc($func, $value)
    {
        $str0 = 'get';
        $str1 = 'Attribute';
        $name = substr($func, strlen($str0), -strlen($str1));
        $act  = Str::snake($name);
        $act  = substr($act, 0, -4);
        $url  = RouteService::urlModel(['model' => $this, 'act' => $act]);

        return $url;
    }

    //*/
    public function getEditUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getMoveupUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getMovedownUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getIndexUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getShowUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getIndexEditUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getCreateUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getUpdateUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getDestroyUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    public function getDetachUrlAttribute($value)
    {
        return $this->urlActFunc(__FUNCTION__, $value);
    }

    //----------------------------------------------
    public function imageResizeSrc($params)
    {
        return '[' . __FILE__ . '][' . __LINE__ . ']';
        $value = null;
        if (isset($this->post)) {
            $value = $this->post->imageResizeSrc($params);
        }

        return $value;
    }

    public function image_html($params)
    {
        $value = null;
        if (isset($this->post)) {
            $value = $this->post->image_html($params);
        }

        return $value;
    }

    public function urlLang($params)
    {
        return '[' . __FILE__ . '][' . __LINE__ . ']';
        if (!isset($this->post)) {
            return '#';
        }

        return $this->post->urlLang($params);
    }

    public function linkedFormFields()
    {
        $roots = Post::getRoots();
        $view  = 'blog::admin.partials.' . snake_case(class_basename($this));

        return view($view)->with('row', $this->post)->with($roots);
    }

    //------------------------------------
    public function item($guid)
    {
        $post_table = with(new Post())->getTable();
        if (in_admin()) {
            $rows = $this->join($post_table, $post_table . '.post_id', '=', $this->getTable() . '.post_id')
                ->where('lang', $this->lang)
                ->where($post_table . '.post_id', $guid)
                ->where($post_table . '.post_type', $this->post_type)
            ;
        } else {
            $rows = $this->join($post_table, $post_table . '.post_id', '=', $this->getTable() . '.post_id')
                ->where('lang', $this->lang)
                ->where($post_table . '.guid', $guid)
                ->where($post_table . '.post_type', $this->post_type)
            ;
        }
        /* -- testare i tempi
        $rows=$this->whereHas('post',function($query) use($guid){
        $query->where('guid',$guid);
        });
         */
        return $rows->first();
    }

    public function fixItemLang($item_guid)
    {
        $item_guid  = str_replace('%20', '%', $item_guid);
        $panel      = Panel::get($this);
        $other_lang = Post::where('post_type', $panel->postType())
            ->where('guid', 'like', $item_guid)
            ->first();
        if (is_object($other_lang)) {
            $up       = $other_lang->replicate();
            $up->lang = \App::getLocale();
            $up->save();
            $row = self::firstOrCreate(['post_id' => $up->post_id]);
            return $row;
        }
    }

    public function scopeOfItem($query, $guid)
    {
        //getRouteKeyName
        if (in_admin()) {
            return $query->where('post_id', $guid);
            //return $query->where('post.post_id',$guid);
        } else {
            return $query->whereHas('post', function ($query) use ($guid) {
                $query->where('guid', $guid);
            });
        }
    }

    public function scopeWithPost($query, $guid)
    {
        $post_table = with(new Post())->getTable();

        return $query->join($post_table . ' as post', function ($join) {
            $join->on('post.post_id', '=', $this->getTable() . '.post_id')
                ->where('lang', $this->lang)
                ->where('post.post_type', $this->post_type)
            ;
        });
    }

    //---------------------------------
    public function listItemSchemaOrg($params)
    {
        $tmp  = explode('\\', get_class($this));
        $ns   = Str::snake($tmp[1]);
        $pack = Str::snake($tmp[3]);
        $view = $ns . '::schema_org.list_item.' . $pack;
        if (!\View::exists($view)) {
            ddd('not exists [' . $view . ']');
        }
        $row = $this;
        foreach ($params as $k => $v) {
            $row->$k = $v;
        }

        return view($view)->with('row', $row);
    }

    public function urlNextContainer($container)
    {
        //ddd($this->post->pivot);
        //ddd($this->post);
        $params                   = \Route::current()->parameters();
        list($containers, $items) = params2ContainerItem($params);
        $container_n              = collect($containers)->search($this->post_type);
        $act                      = 'index';
        $tmp                      = [];
        for ($i = 0; $i <= $container_n + 1; ++$i) {
            $tmp[] = 'container' . $i;
        }
        $path = implode('.', $tmp);
        //$ns='pub_theme';
        $routename                              = $path . '.' . $act;
        $parz                                   = $params;
        $parz['item' . ($container_n + 0)]      = $this;
        $parz['container' . ($container_n + 1)] = $container;
        //it/{container0}/{item0}/{container1}/{item1}/{container2}
        $route = route($routename, $parz);

        return $route;
    }
}
