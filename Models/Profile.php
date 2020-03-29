<?php

namespace Modules\Blog\Models;

//--------- models --------
use Modules\Blog\Models\Traits\PrivacyTrait;
//--- TRAITS ---
use Modules\LU\Models\User;

//--- services
//--- bases
//use Modules\Xot\Models\XotBaseModel;

class Profile extends BaseModel {
    use PrivacyTrait; // da mettere anche in restaurant owner
    /**
     * se non metto $connection  quando faccio la relazione con lu, prende la connection di lu.
     *
     **/
    protected $connection = 'mysql'; // this will use the specified database conneciton
    protected $fillable = ['post_id', 'auth_user_id', 'phone'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    

    //------- RELATIONSHIP ----------
    public function user() {
        return $this->belongsTo(User::class, 'auth_user_id', 'auth_user_id');
        //return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }
}//end model
