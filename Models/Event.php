<?php
namespace Modules\Blog\Models;

use Carbon\Carbon;

//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Extend\Traits\Updater;

//----- models -----
use Modules\Blog\Models\Place;


/**
 * { item_description }
 * da fare php artisan scout:import XRA\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
class Event extends BaseModel
{
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
    protected   $table                = 'blog_post_events';
    protected   $fillable             = ['post_id','date_start','date_end'/*,'formatted_address'*/];
    public      $fillableRelationship = ['address'];
    protected   $appends              = [/*'formatted_address'*/]; 
    //protected $casts                = [ 'category_id' => 'integer', ];
    protected   $dates                = ['date_start','date_end','created_at', 'updated_at'];
    protected   $primaryKey           = 'post_id';
    public      $incrementing         = true;
    //----- relationship -----
    //* --https://josephsilber.com/posts/2018/07/02/eloquent-polymorphic-relations-morph-map
    public function address(){
        $row=$this->morphOne(Place::class,'post'); //->withDefault('aaaa')
        return $row;
    }
    //*/
    //----- mutators -----
    public function getDateStartAttribute($value){    
        $date_format='d/m/Y';//config('app.date_format')
        if(!is_object($value)){
            $value=Carbon::parse($value);//->format($date_format);
        }
        return $value->format($date_format);
    }
    public function getDateEndAttribute($value){    
        $date_format='d/m/Y';//config('app.date_format')
        if(!is_object($value)){
            $value=Carbon::parse($value);//->format($date_format);
        }
        return $value->format($date_format);
    }

    public function setDateStartAttribute($value){
        $date_format_js='dd/mm/yy';
        $date_format='d/m/Y';//config('app.date_format')
        $this->attributes['date_start']=Carbon::createFromFormat($date_format, $value);
    }

    public function setDateEndAttribute($value){
        $date_format_js='dd/mm/yy';
        $date_format='d/m/Y';//config('app.date_format')
        $this->attributes['date_end']=Carbon::createFromFormat($date_format, $value);
    }
    /*
    public function getFormattedAddressAttribute($value){
        $value=$this->address;
        if(is_object($value)){
            return $value->formatted_address;
        }
        $params = \Route::current()->parameters();
        extract($params);
        if(isset($item0)){
            return $item0->formatted_address;
        }
        return $value;
    }

    public function setFormattedAddressAttribute($value){
        $data=\Request::all();
        $place=$this->address ?? new Place;
        $place=$place->fill($data);
        if(!isset($this->attributes['post_id']) ){
            $this->attributes['post_id']=$this->max('post_id')+1;
        }
        $res=$this->address()->save($place);
        unset($this->attributes['formatted_address']);
    }
    */
    /*
    public function setAddressAttribute($value){
        ddd($value);
    }
    */


    
}//end model
