<?php
namespace Modules\Blog\Models;
//--------- models --------
use Modules\LU\Models\User;
//--- TRAITS ---
use Modules\Blog\Models\Traits\PrivacyTrait;
//--- services
use Modules\Theme\Services\ThemeService;

use Modules\Blog\Models\Privacy;

class Profile extends BaseModel {
    use PrivacyTrait; // da mettere anche in restaurant owner 

    //protected $connection = 'mysql'; // this will use the specified database conneciton
    protected $fillable = ['post_id'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    
    //------- RELATIONSHIP ----------

    
}//end model
