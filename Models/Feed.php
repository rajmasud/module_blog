<?php
namespace Modules\Blog\Models;
//--- services
use Modules\Theme\Services\ThemeService;
//--- TRAITS ---

class Feed extends BaseModel{
    protected $fillable = ['post_id'];
}
