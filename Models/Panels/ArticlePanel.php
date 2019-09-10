<<<<<<< HEAD
<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//-------- Services -----
use Modules\Xot\Models\Panels\XotBasePanel;
//---- bases --
use Modules\Xot\Services\RouteService;

class ArticlePanel extends XotBasePanel {
    public static $model = 'Modules\Blog\Models\Article';

    public static $title = 'title';

    public static $search = [];

    public static function with() {
        return ['post'];
    }

    public function search() {
        return [
            'post.title',
        ];
    }

    public static function fields() {
        return [
          (object) [
             'type' => 'Id',
             'name' => 'post_id',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Integer',
             //'name' => 'post[subtitle]'
             'name' => 'parent_id',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'String',
             'name' => 'article_type',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'DateTime',
             'name' => 'published_at',
             'rules' => 'nullable|date', // https://laravel.com/docs/5.8/validation
          //'publish_at' => 'nullable|date',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Text',
             //'name' => 'post[title]',
             'name' => 'post.title',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Text',
             //'name' => 'post[subtitle]'
             'name' => 'post.subtitle',
             'except' => ['index'],
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Tinymce',
             //'name' => 'post[subtitle]'
             'name' => 'post.txt',
             'except' => ['index'],
             'col_bs_size' => 12,
          ],
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs() {
        $tabs_name = [];

        return RouteService::tabs([
            'tabs_name' => $tabs_name,
            'model' => self::$model,
        ]);
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
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
        return [];
    }
}
=======
<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//-------- Services -----
use Modules\Xot\Models\Panels\XotBasePanel;
//---- bases --
use Modules\Xot\Services\RouteService;

class ArticlePanel extends XotBasePanel {
    public static $model = 'Modules\Blog\Models\Article';

    public static $title = 'title';

    public static $search = [];

    public static function with() {
        return ['post'];
    }

    public function search() {
        return [
            'post.title',
        ];
    }

    public static function fields() {
        return [
          (object) [
             'type' => 'Id',
             'name' => 'post_id',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Integer',
             //'name' => 'post[subtitle]'
             'name' => 'parent_id',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'String',
             'name' => 'article_type',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'DateTime',
             'name' => 'published_at',
             'rules' => 'nullable|date', // https://laravel.com/docs/5.8/validation
          //'publish_at' => 'nullable|date',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Text',
             //'name' => 'post[title]',
             'name' => 'post.title',
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Text',
             //'name' => 'post[subtitle]'
             'name' => 'post.subtitle',
             'except' => ['index'],
             'col_bs_size' => 6,
          ],
          (object) [
             'type' => 'Tinymce',
             //'name' => 'post[subtitle]'
             'name' => 'post.txt',
             'except' => ['index'],
             'col_bs_size' => 12,
          ],
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs() {
        $tabs_name = [];

        return RouteService::tabs([
            'tabs_name' => $tabs_name,
            'model' => self::$model,
        ]);
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
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
        return [];
    }
}
>>>>>>> ,
