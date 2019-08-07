<?php
namespace Modules\Blog\Models;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

//---------- traits
use Modules\Extend\Traits\Updater;
use Modules\Blog\Models\Traits\LinkedTrait;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;

abstract class XotBaseModel extends Model
{
    //use Cachable; //mi da un errore 
    use Updater;
    use Searchable;
    use LinkedTrait;
}