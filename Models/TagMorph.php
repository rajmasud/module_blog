<?php

namespace Modules\Blog\Models;

class TagMorph extends BaseMorphPivot {
    protected $attributes = ['related_type' => 'tag'];
}
