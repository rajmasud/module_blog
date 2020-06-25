<?php

namespace Modules\Blog\Models;

//----- traits ----

class Image extends BaseModel   //BaseModelLang?
{
    protected $fillable =['id','post_type','post_id','src','src_out','width','height','auth_user_id','note'];
}
