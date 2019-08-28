<?php
namespace Modules\Blog\Models;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

//---------- traits
use Modules\Xot\Traits\Updater;
use Modules\Blog\Models\Traits\LinkedTrait;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;

abstract class XotBaseModel extends Model {
    use Updater;
    use Searchable;
    use LinkedTrait;
}