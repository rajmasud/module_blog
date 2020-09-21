<?php

namespace Modules\Blog\Models;

//------services---------
use Modules\Xot\Services\ImportService;

//------ models --------

class Place extends BaseModelLang
{
    protected $fillable = ['id', 'post_id', 'post_type',
        //---- address_components----
        'premise', 'locality', 'postal_town',
        'administrative_area_level_3', 'administrative_area_level_2',  'administrative_area_level_1',
        'country',
        'street_number', 'route', 'postal_code',
        'googleplace_url',
        'point_of_interest', 'political', 'campground',
        //-----
        'latitude', 'longitude', 'formatted_address', 'nearest_street',
    ];

    public static $address_components = [
        'premise', 'locality', 'postal_town',
        'administrative_area_level_3', 'administrative_area_level_2',  'administrative_area_level_1',
        'country',
        'street_number', 'route', 'postal_code',
        'googleplace_url',
        'point_of_interest', 'political', 'campground',
    ];

    protected $appends =['value'];

    //----- mutators -----

    public function setFormattedAddressAttribute($value)
    {
        if (isset($this->attributes['formatted_address'])) {
            $address = $this->attributes['formatted_address'];
        } else {
            $address = $value;
            $this->attributes['formatted_address'] = $value;
        }
        if ('' != $address) {
            $tmp = ImportService::getAddressFields(['address' => $address]);
            $this->attributes = array_merge($this->attributes, $tmp);
            //ddd($this->attributes);
        }
    }

    public function getValueAttribute($value)
    {
        return $this->route.', '.$this->street_number.', '.$this->locality.', '.$this->administrative_area_level_2.', '.$this->country;
    }

    public function linked(){
        return $this->morphTo('post');
    }


}
