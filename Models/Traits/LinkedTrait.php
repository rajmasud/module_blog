<?php
namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
//----- models------
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostRelatedPivot;
use Modules\Blog\Models\PostRelatedMorphPivot;
//----- services -----
use Modules\Theme\Services\ThemeService;
use Modules\Extend\Services\RouteService;
use Modules\Extend\Services\StubService;

//------ traits ---

trait LinkedTrait{

    public function getRouteKeyName(){
        //return 'guid';
        //return \Request::segment(1) === 'admin' ? 'post_id' : 'guid';
        return \inAdmin() ? 'post_id' : 'guid';
        //return  'post.guid';
    }
    //------- relationships ------------
    public function post(){
        //update blog_posts set linkable_type=type
        return $this->morphOne(Post::class,'post',null,'post_id')->where('lang',$this->lang);
        //return $this->hasOne(Post::class,'post_id','post_id')->where('type',$this->post_type)->where('lang',$this->lang); 
    }



    public function morphRelated($related,$inverse=false){
        //$related=Privacy::class;
        if($inverse){
            $model=$this;
            $pivot=get_class($this).'Morph';
        }else{
            if(is_string($related)){ 
                $pivot=$related.'Morph';
                $model=new $related;
            }else{ 
                $pivot=get_class($related).'Morph';
                $model=$related;
            }
        }
        $name='post';
        if(!class_exists($pivot)){
            StubService::missingClass([
                'class'=>$pivot,
                'stub'=>'morph_pivot',  //con questo crea anche la migration
                'model'=>$model,
            ]);
            //Artisan::call('db:seed', ['--force' => true], $outputLog); 
            ddd('Refresh Page ');
        }

        $pivot_table=with(new $pivot)->getTable();
        $pivot_fields=with(new $pivot)->getFillable();
        if($inverse){
            $foreignPivotKey = 'related_id'; 
            $relatedPivotKey = 'post_id'; 
        }else{
            $foreignPivotKey = 'post_id'; 
            $relatedPivotKey = 'related_id'; 
        }
        $parentKey = 'post_id';
        $relatedKey = 'post_id'; 
        /*select count(*) as aggregate from `blog_post_profiles` inner join `restaurant_morph` on `blog_post_profiles`.`post_id` = `restaurant_morph`.`post_id` where `restaurant_morph`.`related_id` = 3 and `restaurant_morph`.`post_type` = 'restaurant'

        select count(*) as aggregate from `blog_post_profiles` inner join `restaurant_morph` on `blog_post_profiles`.`post_id` = `restaurant_morph`.`post_id` where `restaurant_morph`.`related_id` = 3 and `restaurant_morph`.`post_type` = 'profile'

        */
        //$inverse=false;
        //$related_table=with(new $related)->getTable();
        //return $this->morphRelated($related);
        ///*
        return $this->morphToMany($related, $name,$pivot_table, $foreignPivotKey,
                                $relatedPivotKey, $parentKey,
                                $relatedKey, $inverse)
                    ->using($pivot)
                    ->withPivot($pivot_fields)
                    //->wherePivot('auth_user_id',\Auth::user()->auth_user_id)
                    ->withTimestamps()
        ;
    }

    //------- mutators -------------
    /*
    public function getTypeAttribute($value){
        return camel_case(class_basename($this));
    }
    */
    public function getPostTypeAttribute($value){
        //if($value!='') return $value; ??????????????????????????????????????????
        //return 'aa';
        //ddd(snake_case(class_basename($this)));
        //no camel_case ma snake_case
        //da controllare prima questo
        $post_type=collect(config('xra.model'))->search(get_class($this));
        if($post_type===false){
            $post_type=snake_case(class_basename($this));
        }
        return $post_type;
    }

    public function getLangAttribute($value){
        $lang=\App::getLocale();
        return $lang;
    }

    public function setGuidAttribute($value){
        if($value==''){
            $this->post->guid=Str::slug($this->attributes['title'].' '.$this->attributes['subtitle']);
            $res=$this->post->save();
        }
    }


    public function getPostAttr($func,$value){
        $str0='get';
        $str1='Attribute';
        $name=substr($func, strlen($str0),-strlen($str1));
        $name=Str::snake($name);
        //if($name=='title'){
            //ddd($value);
        //}
        if($value!=''){ return $value; }
        if(class_basename($this)=='Post'){
            //ddd($name);//create_url
            return $this->$name;
        }
        if (isset($this->pivot) && Str::endsWith($name, '_url') ) { // solo le url dipendono dal pivot
            //ddd(get_class($this->pivot));// Modules\Blog\Models\PostRelatedMorphPivot
            return $this->pivot->$name;//.'#PIVOT';
        } 
        if (isset($this->post)) {
            //echo($value.' '.$name); ddd($this->attributes);
            return $this->post->$name;//.'#NO-PIVOT';
        }
        if(Str::endsWith($name, '_url')){ 
            $act=Str::before($name, '_url');
            return RouteService::urlModel(['model'=>$this,'act'=>$act]);
        }
        return $value;
    }
    //---- da mettere i mancanti --- 
    public function getTitleAttribute($value)       {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getSubtitleAttribute($value)    {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getGuidAttribute($value)        {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getImageSrcAttribute($value)    {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getTxtAttribute($value)         {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getUrlAttribute($value)         {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getRoutenameAttribute($value)   {return $this->getPostAttr(__FUNCTION__,$value);}

    //public function setTitleAttribute($value)       {return $this->setPostAttr(__FUNCTION__,$value);}
    //public function setSubtitleAttribute($value)    {return $this->setPostAttr(__FUNCTION__,$value);}
  //  public function setGuidAttribute($value)        {return $this->setPostAttr(__FUNCTION__,$value);}
    public function setImageSrcAttribute($value)    {return $this->setPostAttr(__FUNCTION__,$value);}
    public function setTxtAttribute($value)         {return $this->setPostAttr(__FUNCTION__,$value);}
    public function setUrlAttribute($value)         {return $this->setPostAttr(__FUNCTION__,$value);}
    public function setRoutenameAttribute($value)   {return $this->setPostAttr(__FUNCTION__,$value);}


    //--- attribute e' risertvato
    public function setPostAttr($func,$value){
        $str0='set';
        $str1='Attribute';
        $name=substr($func, strlen($str0),-strlen($str1));
        $name=Str::snake($name);
        $data=[$name=>$value];
        $data['lang']=\App::getLocale();
        //$this->post->$name=$value;
        //$res=$this->post->save();
        $this->post()->updateOrCreate($data);
        print_r($data);
        unset($this->attributes[$name]);
    }
    /*
    public function urlActFunc($func,$value){
        $str0='get';
        $str1='Attribute';
        $name=substr($func, strlen($str0),-strlen($str1));
        $name=Str::snake($name);
        if(class_basename($this)=='Post'){
            //ddd($name);//create_url
        }
        if (isset($this->pivot)) {
            return $this->pivot->$name;//.'#PIVOT';
        }
        if (isset($this->post)) {
            return $this->post->$name;
        }
        return $value;
    }
    */
    public function getEditUrlAttribute($value)     {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getMoveupUrlAttribute($value)   {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getMovedownUrlAttribute($value) {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getIndexUrlAttribute($value)    {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getShowUrlAttribute($value)     {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getIndexEditUrlAttribute($value){return $this->getPostAttr(__FUNCTION__,$value);}
    public function getCreateUrlAttribute($value)   {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getUpdateUrlAttribute($value)   {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getDestroyUrlAttribute($value)  {return $this->getPostAttr(__FUNCTION__,$value);}
    public function getDetachUrlAttribute($value)   {return $this->getPostAttr(__FUNCTION__,$value);}


    

    public function getTabsAttribute($value){
        //if($this->post->guid!=$this->post->post_type){
            //ddd($this->post->guid.'  '.$this->post->post_type);
            //ddd('-['.$this->attributes['guid'].']  ['.$this->attributes['type'].']');
        //    return ['cuisine','photo','article','contact','map'];
        //}
    }

    public function getParentTabsAttribute($value){
        $params = \Route::current()->parameters();
        //$second_last = collect(\array_slice($params, -2))->first(); //penultimo
        $n_params=count($params);
        $second_last=collect($params)->take(-2)->first();        
        if(is_object($second_last) && $n_params>1){
            return $second_last->tabs;
        }
    }

    //----------------------------------------------
    public function imageResizeSrc($params){
        $value=null;
        if (isset($this->post)) {
            $value = $this->post->imageResizeSrc($params);
        }

        return $value;
    }

    public function image_html($params){
        $value=null;
        if (isset($this->post)) {
            $value = $this->post->image_html($params);
        }

        return $value;    
    }

    public function urlLang($params){
        if (!isset($this->post)) {
            return '#';
        }
        return $this->post->urlLang($params);
    }

    public function linkedFormFields(){
        $roots = Post::getRoots();
        $view = 'blog::admin.partials.'.snake_case(class_basename($this));
        return view($view)->with('row', $this->post)->with($roots);
    }

    //------------------------------------
    public function item($guid){
        if(in_admin()){
            $rows=$this->join('blog_posts','blog_posts.post_id','=',$this->getTable().'.post_id')
                                ->where('lang',$this->lang)
                                ->where('blog_posts.post_id',$guid)
                                ->where('blog_posts.post_type',$this->post_type)
                                ;    
        }else{
            $rows=$this->join('blog_posts','blog_posts.post_id','=',$this->getTable().'.post_id')
                                ->where('lang',$this->lang)
                                ->where('blog_posts.guid',$guid)
                                ->where('blog_posts.post_type',$this->post_type)
                                ;
        }
        /* -- testare i tempi
        $rows=$this->whereHas('post',function($query) use($guid){
            $query->where('guid',$guid);
        });
        */                                
        return $rows->first();
    }
    public function scopeOfItem($query,$guid){
        //getRouteKeyName
        if(in_admin()){

            return $query->where('post_id',$guid);
            //return $query->where('post.post_id',$guid);
        }else{
            return $query->whereHas('post',function($query) use($guid){
                $query->where('guid',$guid);
            });
        }
    }

    public function scopeWithPost($query,$guid){
        /*
        return $query->join('blog_posts as post','post.post_id','=',$this->getTable().'.post_id')
                                ->where('lang',$this->lang)
                                ->where('post.post_type',$this->post_type)
                                ;
        */
        return $query->join('blog_posts as post',function ($join) {
                $join->on('post.post_id','=',$this->getTable().'.post_id')
                        ->where('lang',$this->lang)
                        ->where('post.post_type',$this->post_type)
                        ;
        });
    }

    /*
    // In your model
public function scopeWithCalculatedPricing( $query, $include_tax = false ) {
  $tax_multiplier = $include_tax ? 1.2 : 1;
  $query->selectRaw( 'products.*, ( products.price * ' . $tax_multiplier . ' ) as total_price' )
      ->where( 'stock', '>', 0 );
}

// Elsewhere...
// Let's get some product with the total_price calculated with tax
$products_with_prices = Product::withCalculatedPricing( true );


$customers = Customer::with( [ 'products' => function( $query ) {
    // Attaching the scope to the current Query Builder, $query
    $query->withCalculatedPricing(true);
    // Result: Object of class Illuminate\Database\Eloquent\Relations\HasMany could not be converted to string
}]);

https://hashnode.com/post/a-little-trick-with-eloquent-query-scopes-that-makes-them-super-reusable-ciylr4k0r001os453wuvd4t8w


public function scopeActiveDvdsPerSeries($query, $series_id)
{
    $filter = function ($q) use ($series_id) {
        $q->where('active', 1)->where('series_id', $series_id);
    };

    return $query->whereHas('dvds', $filter)->with(['dvds' => $filter]);
}


*/

    //---------------------------------
    public function listItemSchemaOrg($params){

       
        $tmp=explode('\\',get_class($this));
        $ns=Str::snake($tmp[1]);
        $pack=Str::snake($tmp[3]);
        $view=$ns.'::schema_org.list_item.'.$pack;
        if(!\View::exists($view)){
            ddd('not exists ['.$view.']');
        }
        $row=$this;
        foreach($params as $k=>$v){
            $row->$k=$v;
        }
        return view($view)->with('row',$row);
    }


    public function urlNextContainer($container){
        //ddd($this->post->pivot);
        //ddd($this->post); 
        $params = \Route::current()->parameters();
        list($containers,$items)=params2ContainerItem($params);
        $container_n=collect($containers)->search($this->post_type);
        $act='index';
        $tmp=[];
        for($i=0;$i<=$container_n+1;$i++){
            $tmp[]='container'.$i;
        }
        $path=implode('.',$tmp);
        //$ns='pub_theme';
        $routename=$path.'.'.$act;
        $parz=$params;
        $parz['item'.($container_n+0)]=$this;
        $parz['container'.($container_n+1)]=$container;
        //it/{container0}/{item0}/{container1}/{item1}/{container2}
        $route=route($routename,$parz);
        return $route;
    }

}
