<?php
namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

/**
 * XRA\Blog\Models\PostContent.
 *
 * @property \XRA\Blog\Models\Post $Post
 * @mixin \Eloquent
 */
//class PostRelated extends Model {
class PostRelatedMorphPivot extends MorphPivot
{
    protected $table = 'blog_post_related';
    protected $primaryKey = 'id';
    protected $fillable =   [ 
        'post_id','post_type',
        'related_id','related_type',
        'pos',
        'price',
        'price_currency',
        'launch_avaible',
        'dinner_avaible',
    ];
    

    public function post(){
        return $this->morphTo('post'); // con questa vado a cuisine
    }

    public function related(){
        return $this->morphTo('related');
    }

    //------------- MUTUATORS -----------
    /*
    public function getPriceAttribute($value){
        //dd($this);
        $row=PostRelated::where('post_id',$this->post_cat_id)->where('related_id',$this->post_id)->first();
        return $row->price;
        //return 10;
    }

    public function getSonsCountAttribute($value){
        if ($value=='') {
            $value=$this->where('related_id', $this->post_id)->count();
            $this->sons_count=$value;
            $this->save();
        }
        return $value;
    }
    */

    //public function attachType($a){
    //    return true;
    //}
    public function getRouteN($n, $act)
    {
        $params = \Route::current()->parameters();
        //ddd($this);//->related()->toSql());
        $params['container'.$n] = $this->post_type;
        $params['item'.$n] = $this->post->guid;
        $params['container'.($n + 1)] = $this->related_type;
        $params['item'.($n + 1)] = $this->related->guid;
        $r = '';
        for ($i = 0; $i <= ($n + 1); ++$i) {
            $r .= 'container'.$i.'.';
        }
        $route = $r.$act;
        if ('container0.container1.container2.container3.show' == $route) {
            //echo '<h3>'.$route.'</h3>';
            //ddd(array_keys($params));
            return '1';
        }
        if (in_admin()) {
            $route = 'blog.'.$route;
        }

        return route($route, $params);
    }

    public function getUrlAct($act){
        $params = \Route::current()->parameters();
        list($containers,$items)=params2ContainerItem($params);
        $n_containers=count($containers);
        $n_items=count($items);
        //$post=$this->post;
        //$related=$this->related;
        $post_i=collect($containers)->search($this->post_type);
        //$related_i=collect($containers)->search($this->related_type);
        //ddd('['.$post_i.']['.$this->post_type.']['.$related_i.']['.$this->related_type.']');
        $tmp=[];
        if(in_admin()){ $tmp[]='admin'; }
        for($i=0;$i<=$post_i+1;$i++){  $tmp[]='container'.$i; }
        $tmp[]=$act;
        $routename=implode('.',$tmp);
        $params['container'.($post_i)]=$this->post_type;
        $params['item'.($post_i)]=$this->post;
        $params['container'.($post_i+1)]=$this->related_type;
        $params['item'.($post_i+1)]=$this->related;

        return route($routename,$params);

    }

    
    public function getUrlAttribute($value)             {  return $this->getUrlAct('show');         }
    public function getStoreUrlAttribute($value)        {  return $this->getUrlAct('store');        }
    public function getIndexUrlAttribute($value)        {  return $this->getUrlAct('index');        }
    public function getIndexEditUrlAttribute($value)    {  return $this->getUrlAct('index_edit');   }
    public function getCreateUrlAttribute($value)       {  return $this->getUrlAct('create');       }
    public function getDestroyUrlAttribute($value)      {  return $this->getUrlAct('destroy');      }
    public function getUpdateUrlAttribute($value)       {  return $this->getUrlAct('update');       }
    public function getShowUrlAttribute($value)         {  return $this->getUrlAct('show');         }
    public function getEditUrlAttribute($value)         {  return $this->getUrlAct('edit');         }
    public function getAttachUrlAttribute($value)       {  return $this->getUrlAct('attach');       }
    public function getDetachUrlAttribute($value)       {  return $this->getUrlAct('detach');       }
    public function getMovedownUrlAttribute($value)     {  return $this->getUrlAct('movedown');     }
    public function getMoveupUrlAttribute($value)       {  return $this->getUrlAct('moveup');       }
    
}
