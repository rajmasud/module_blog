<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
//---------- traits
use Modules\Blog\Models\Traits\LinkedTrait;
use Modules\Xot\Traits\Updater;

abstract class BaseModelLang extends Model {
    use Updater;
    use Searchable;
    use LinkedTrait;

    protected $fillable = ['id'];
    protected $casts = [
        //'published_at' => 'datetime:Y-m-d', // da verificare
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $hidden = [
        //'password'
    ];
    public $timestamps = true;
    //-----------
    /*
    protected $id;
    protected $post;
    protected $lang;
    */
}
