<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//-------- Services -----
use Modules\Xot\Models\Panels\XotBasePanel;

//---- bases --

class ArticlePanel extends XotBasePanel {
    protected static $model = 'Modules\Blog\Models\Article';

    protected static $title = 'title';

    protected static $search = [];

    public function optionLabel($row) {
        return $row->title;
    }

    public static function with() {
        return ['post'];
    }

    public function search() {
        return [
            'post.title',
        ];
    }

    public function fields() {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'id',
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Select',
                'sub_type' => 'Parent',
                //'name' => 'post[subtitle]'
                'name' => 'parent_id',
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                'name' => 'pos',
                'col_bs_size' => 6,
                //'rules'=>'unique'
            ],
            (object) [
                'type' => 'Text',
                //'name' => 'post[title]',
                'name' => 'post.title',
                'col_bs_size' => 12,
            ],
            //*/
            (object) [
                'type' => 'Textarea',
                //'name' => 'post[subtitle]'
                'name' => 'post.subtitle',
                'except' => ['index'],
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'Image',
                //'name' => 'post[subtitle]'
                'name' => 'post.image_src',
                //'except' => ['index'],
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'Wysiwyg',
                //'name' => 'post[subtitle]'
                'name' => 'post.txt',
                'except' => ['index'],
                'col_bs_size' => 12,
            ],

            (object) [
                'type' => 'SelectMultipleRelationship',
                //'name' => 'post[subtitle]'
                'name' => 'categories',
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'SelectMultipleRelationship',
                //'name' => 'post[subtitle]'
                'name' => 'tags',
                'col_bs_size' => 12,
            ],

            (object) [
                'type' => 'CheckboxSiNo',
                //'name' => 'post[subtitle]'
                'name' => 'is_featured',
                //'col_bs_size' => 12,
            ],
            /*
            */
            /*
            (object) [
            'type' => 'String',
            'name' => 'article_type',
            'col_bs_size' => 6,
            ],
            (object) [
            'type' => 'DateTime',
            'name' => 'published_at',
            //'rules' => new \Modules\Xot\Rules\DateTimeRule(),
            //'rules' => 'nullable|date_format:d/m/Y H:i', // https://laravel.com/docs/5.8/validation
            //'publish_at' => 'nullable|date',
            'col_bs_size' => 6,
            ],
             */
            /*
            (object) [
                'type' => 'Rating',
                'name' => 'myRatings',
                'except' => ['index'],
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'Rating',
                'name' => 'ratings',
                'except' => ['edit', 'create'],
                'col_bs_size' => 12,
            ],
            */
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs() {
        $tabs_name = [];

        return [];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request = null) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions() {
        return [
            new Actions\RateItAction(),
            //new Actions\ChangePosAction(),
        ];
    }
}
