<?php

namespace Modules\Blog\Models;

//--------- models --------
use Modules\Blog\Models\Traits\PrivacyTrait;
use Modules\LU\Models\Traits\HasProfileTrait;
//--- TRAITS ---
use Modules\LU\Models\User;

//--- services
//--- bases
//use Modules\Xot\Models\XotBaseModel;

class Profile extends BaseModelLang {
    use PrivacyTrait; // da mettere anche in restaurant owner
    use HasProfileTrait;
    /**
     * se non metto $connection  quando faccio la relazione con lu, prende la connection di lu.
     *
     **/
    protected $connection = 'mysql'; // this will use the specified database conneciton
    protected $fillable = ['id', 'auth_user_id', 'phone'];

    //------- RELATIONSHIP ----------
    public function user() {
        //return $this->belongsTo(User::class, 'auth_user_id', 'auth_user_id');
        return $this->hasOne(User::class, 'auth_user_id', 'auth_user_id');
    }

    public function articles() {
        return $this->hasMany(Article::class, 'auth_user_id', 'auth_user_id');
    }

    //---- mutators ---
    /*  ------------------ utilizza quello di HasProfileTrait
    public function getFullNameAttribute($value) {
        return $value;
        $user = User::firstOrCreate(['auth_user_id' => $this->auth_user_id]);
        $user->post()->firstOrCreate(['guid' => $user->handle, 'lang' => app()->getLocale()]);

        $value = $user->first_name.' '.$user->last_name;
        if (strlen($value) < 5) {
            $value .= ' '.$user->handle;
        }
        $value = trim($value);

        return $value;
    }
    */
}//end model
