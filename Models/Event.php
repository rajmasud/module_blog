<<<<<<< HEAD
<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;

//----- models -----

class Event extends BaseModel {
    protected $fillable = ['post_id', 'date_start', 'date_end'/*,'formatted_address'*/];
    public $fillableRelationship = ['address'];
    protected $appends = [/*'formatted_address'*/];
    protected $dates = ['date_start', 'date_end', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    protected $casts = [
        'date_start' => 'datetime:d/m/Y H:i',
        'date_end' => 'datetime:d/m/Y H:i',
    ];

    //----- relationship -----
    public function address() {
        $row = $this->morphOne(Place::class, 'post'); //->withDefault('aaaa')
        return $row;
    }

    //----- mutators -----

    public function setDateStartAttribute($value) {
        $date_format = 'd/m/Y H:i';
        if (! is_object($value)) {
            $this->attributes['date_start'] = Carbon::createFromFormat($date_format, $value);
        }
    }

    public function setDateEndAttribute($value) {
        $date_format = 'd/m/Y H:i';
        if (! is_object($value)) {
            $this->attributes['date_end'] = Carbon::createFromFormat($date_format, $value);
        }
    }
}//end model
=======
<?php

namespace Modules\Blog\Models;

use Carbon\Carbon;

//----- models -----

class Event extends BaseModel {
    protected $fillable = ['post_id', 'date_start', 'date_end'/*,'formatted_address'*/];
    public $fillableRelationship = ['address'];
    protected $appends = [/*'formatted_address'*/];
    protected $dates = ['date_start', 'date_end', 'created_at', 'updated_at'];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    protected $casts = [
        'date_start' => 'datetime:d/m/Y H:i',
        'date_end' => 'datetime:d/m/Y H:i',
    ];

    //----- relationship -----
    public function address() {
        $row = $this->morphOne(Place::class, 'post'); //->withDefault('aaaa')
        return $row;
    }

    //----- mutators -----

    public function setDateStartAttribute($value) {
        $date_format = 'd/m/Y H:i';
        if (! is_object($value)) {
            $this->attributes['date_start'] = Carbon::createFromFormat($date_format, $value);
        }
    }

    public function setDateEndAttribute($value) {
        $date_format = 'd/m/Y H:i';
        if (! is_object($value)) {
            $this->attributes['date_end'] = Carbon::createFromFormat($date_format, $value);
        }
    }
}//end model
>>>>>>> ,
