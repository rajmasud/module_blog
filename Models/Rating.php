<?php
namespace Modules\Blog\Models;

use Carbon\Carbon;

class Rating extends BaseModel{
    protected $fillable = ['post_id','my_rating','related_type'];
    protected $appends = ['my_rating'];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
}