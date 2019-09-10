<<<<<<< HEAD
<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class PhotoMorph extends MorphPivot {
    use Updater;
    protected $fillable = [
        'id',
        'post_id', 'post_type',
        'related_id', 'related_type',
        'auth_user_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
       // 'published_at',
    ];
    protected $appends = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
}
=======
<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

class PhotoMorph extends MorphPivot {
    use Updater;
    protected $fillable = [
        'id',
        'post_id', 'post_type',
        'related_id', 'related_type',
        'auth_user_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
       // 'published_at',
    ];
    protected $appends = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
}
>>>>>>> ,
