<?php

namespace Modules\Blog\Models;

class Label extends BaseModel
{
    protected $fillable=['id','label','title', 'label_id', 'label_type'];
}
