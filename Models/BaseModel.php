<?php
namespace Modules\Blog\Models;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

//---------- traits
use Modules\Xot\Traits\Updater;
use Modules\Blog\Models\Traits\LinkedTrait;

abstract class BaseModel extends Model{
    use Updater;
    use Searchable;
    use LinkedTrait;
}