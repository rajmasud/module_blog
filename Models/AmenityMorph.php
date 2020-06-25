<?php

namespace Modules\Blog\Models;

class AmenityMorph extends BaseMorphPivot{
    protected $attributes = ['related_type' => 'amenity'];
}