<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
//---------- traits
use Modules\Blog\Models\Traits\LinkedTrait;
use Modules\Xot\Traits\Updater;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

abstract class BaseModel extends Model implements HasMedia{
    use Updater;
    use Searchable;
    use LinkedTrait;

    use HasMediaTrait;

    protected $fillable = ['post_id'];
    protected $casts = [
        //'published_at' => 'datetime:Y-m-d', // da verificare
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    protected $hidden = [
        //'password'
    ];
}
