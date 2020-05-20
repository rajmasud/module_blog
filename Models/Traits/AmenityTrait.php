<?php

namespace Modules\Blog\Models\Traits;

//use Laravel\Scout\Searchable;

//----- models------
use Modules\Blog\Models\Amenity;

//---- services -----
//use Modules\Xot\Services\PanelService as Panel;

//------ traits ---

trait AmenityTrait {
    // elenco delle amenities collegati ad un determinato modello collegato (es: ristorante)
    public function amenities() {
        return $this->morphRelated(Amenity::class);
    }

    // elenco delle amenities totali (non collegate a nessuna istanza di modello collegato)
    public function amenityObjectives() {
        return $this->hasMany(Amenity::class, 'related_type', 'post_type');
    }
}
