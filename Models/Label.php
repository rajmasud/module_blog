<?php

namespace Modules\Blog\Models;

class Label extends BaseModel
{
    protected $fillable=['label','title', 'label_id', 'label_type','created_by', 'updated_by'];
}
