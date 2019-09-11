<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;
use Modules\Xot\Services\RouteService;

class ArticleMorphPanel extends XotBasePanel {
    protected static $model = 'Modules\Blog\Models\ArticleMorph';
    protected static $title = 'title';
    protected static $search = [];

    public static function with() {
        return [];
    }

    public function search() {
        return [];
    }

    public function optionId($row) {
        return $row->area_id;
    }

    public function optionLabel($row) {
        return $row->area_define_name;
    }

    public function indexNav() {
        return null;
    }

    public static function fields() {
        return [
  (object) [
     'type' => 'Text',
     'name' => 'id',
     'comment' => 'not in Doctrine',
  ],
  (object) [
     'type' => 'Text',
     'name' => 'post_id',
     'comment' => 'not in Doctrine',
  ],
  (object) [
     'type' => 'Text',
     'name' => 'post_type',
     'comment' => 'not in Doctrine',
  ],
  (object) [
     'type' => 'Text',
     'name' => 'related_id',
     'comment' => 'not in Doctrine',
  ],
  (object) [
     'type' => 'Text',
     'name' => 'related_type',
     'comment' => 'not in Doctrine',
  ],
  (object) [
     'type' => 'Text',
     'name' => 'auth_user_id',
     'comment' => 'not in Doctrine',
  ],
];
    }

    public function tabs() {
        $tabs_name = [];

        return [];
    }

    public function cards(Request $request) {
        return [];
    }

    public function filters(Request $request = null) {
        return [];
    }

    public function lenses(Request $request) {
        return [];
    }

    public function actions(Request $request = null) {
        return [];
    }
}
