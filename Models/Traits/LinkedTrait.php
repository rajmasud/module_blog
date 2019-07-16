<?php
namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
//----- models------
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostRelatedPivot;
use Modules\Blog\Models\PostRelatedMorphPivot;
//----- services -----
use Modules\Extend\Services\ThemeService;
use Modules\Extend\Services\RouteService;

//------ traits ---

trait LinkedTrait
{

    public function getRouteKeyName()
    {
        //return 'guid';
        //return \Request::segment(1) === 'admin' ? 'post_id' : 'guid';
        return \inAdmin() ? 'post_id' : 'guid';
        //return  'post.guid';
    }
    //------- relationships ------------
    public function post()
    {
        //update blog_posts set linkable_type=type
        return $this->morphOne(Post::class,'post',null,'post_id')->where('lang',$this->lang);
        //return $this->hasOne(Post::class,'post_id','post_id')->where('type',$this->post_type)->where('lang',$this->lang); 
    }

    public function morphRelated($related,$inverse=false){
        //-- name post perche' dopo va a cercare il proprio oggetto dentro $name .'_type';
        // percio' post_type=restaurant
        $related_table=with(new $related)->getTable();
        $related_class=$related;
        if(is_object($related_class)){
            $related_class=get_class($related_class);
            //ddd($related_class);
        }
        $related_type=collect(config('xra.model'))->search($related_class);
        //ddd(is_object($related));
        if($related_type==''){
            //var_dump(debug_backtrace());
            echo '<h3>Line:['.__LINE__.']<br/>File:['.__FILE__.']['.$related_class.'] da mettere in xra.model</h3>';
            echo '<pre>';print_r(var_dump(config('xra.model')));echo '</pre>';
            //var_dump(debug_backtrace());
            ddd('fix');

        }
        //ddd($related);
        //if(!isset($alias[$related])){
        //    ddd($related);
        //}
        //$related_type=($alias[$related]); 
        $name='post';//'related';//'relatable'; 
        $pivot_table ='blog_post_related';
        /*
        $pivot_class=$related_class.'Pivot';
        $pivot_obj=new $pivot_class;
        */
        //ddd($pivot_obj->getFillable()); //peril withpivot
        //ddd($pivot_obj->getTable()); //per passare al morph il nome tabella
        
        //ddd($related_class.'Pivot');// con questo avrei i fillable, e il getTable
        //$pivot_table=$related_table.'_pivot';  
        $foreignPivotKey = 'post_id'; 
        $relatedPivotKey = 'related_id'; 
        $parentKey = 'post_id';
        $relatedKey = 'post_id'; 
        //$inverse = false; //passato da parametro
        $pivot_fields = [ 'pos', 'price', 'price_currency', 'id','post_type','related_type']; //'type', tolto
        return $this->morphToMany($related, $name,$pivot_table, $foreignPivotKey,
                                $relatedPivotKey, $parentKey,
                                $relatedKey, $inverse)
                    ->withPivot($pivot_fields)
                    ->wherePivot('related_type', $related_type)
                    ->using(PostRelatedMorphPivot::class)
                    //------------------------------ 
                    ->join('blog_posts','blog_posts.post_id','=',$related_table.'.post_id')
                    ->where('blog_posts.post_type',$related_type)
                    ->where('blog_posts.lang',$this->lang)
                    //--------------------------------
                    ->orderBy($pivot_table.'.pos', 'asc')
                    ->with(['post'])
                    ->distinct()
                    ; 
    }
public function morphRelatedRev($related/*,$inverse=false*/){
        //-- name post perche' dopo va a cercare il proprio oggetto dentro $name .'_type';
        // percio' post_type=restaurant
        $related_table=with(new $related)->getTable();
        $related_class=$related;
        if(is_object($related_class)){
            $related_class=get_class($related_class);
            //ddd($related_class);
        }
        $related_type=collect(config('xra.model'))->search($related_class);

        $name='post';//'related';//'relatable'; 
        $table ='blog_post_related'; 
        $foreignPivotKey = 'related_id';         //where `blog_post_related`.`post_id_1` = 220792
        $relatedPivotKey = 'post_id';      //chiave `blog_post_related`.`related_id_2`
        $parentKey = 'post_id';                 //chiave che gli passo
        $relatedKey = 'post_id';              //chiave di blog_post_restaurants`.`post_id_4`
        $inverse = true; //passato da parametro
        $pivot_fields = ['pos', 'price', 'price_currency', 'id','post_type','related_type'];
        return $this->morphToMany($related, $name,$table, $foreignPivotKey,
                                $relatedPivotKey, $parentKey,
                                $relatedKey, $inverse)
                    ->withPivot($pivot_fields)
                    ->using(PostRelatedMorphPivot::class) /// Call to undefined method  setMorphType() ??
                    //----------------------------------------------------------------------
                    ->join('blog_posts','blog_posts.post_id','=',$related_table.'.post_id')
                    ->where('blog_posts.post_type',$related_type) // da testare, verificare 
                    ->where('blog_posts.lang',$this->lang)
                    //----------------------------------------------------------------------
                    ->orderBy('blog_post_related.pos', 'asc')
                    ->with(['post'])
                    ->distinct()
                    ; 
    }


    public function related_solo_per_toglirtr()
    {
        //belongsToMany($related, $table, $foreignPivotKey, $relatedPivotKey,$parentKey, $relatedKey, $relation)
        $pivot_fields = ['type', 'pos', 'price', 'price_currency', 'id'];
        $rows = $this->belongsToMany(Post::class, 'blog_post_related', 'post_id', 'related_id', 'post_id', 'post_id')
                ->withPivot($pivot_fields)
                ->using(PostRelatedPivot::class)
                ->where('lang', \App::getLocale())
                ->orderBy('blog_post_related.pos', 'asc');
        //->with(['related'])

        return $rows;
    }

    public function relatedType($type)
    {
        if (false === \mb_strpos($type, '_x_')) {
            $type = $this->post_type.'_x_'.$type;
        }

        return $this->related()->wherePivot('type', $type);
    }

    //------- mutators -------------

    public function getTypeAttribute($value)
    {
        return camel_case(class_basename($this));
    }

    public function getPostTypeAttribute($value)
    {
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
        return $query->join('blog_posts','blog_posts.post_id','=',$this->getTable().'.post_id')
                                ->where('lang',$this->lang)
                                ->where('blog_posts.post_type',$this->post_type)
                                ;
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
