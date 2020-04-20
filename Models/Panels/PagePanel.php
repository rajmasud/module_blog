<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;

use Modules\Blog\Models\Panels\Traits\XotBasePanelTrait;
//---- bases --

class PagePanel extends XotBasePanel
{
    use XotBasePanelTrait;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    protected static $model = 'Modules\Blog\Models\Page';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    protected static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    protected static $search = [
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static function with()
    {
        return [];
    }

    /**
     * on select the option id.
     */
    
    /**
     * on select the option label.
     */
    public function optionLabel($row)
    {
        return $row->title;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */ 
    public function fields()
    {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'post_id',
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
                'type' => 'String',
                'name' => 'icon',
                'col_bs_size' => 6,
                //'rules'=>'unique'
            ],

            (object) [
                'type' => 'Text',
                //'name' => 'post[title]',
                'name' => 'post.title',
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'Image',
                //'name' => 'post[title]',
                'name' => 'post.image_src',
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
                'type' => 'String',
                //'name' => 'post[subtitle]'
                'name' => 'blade',
                //'except' => ['index'],
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Checkbox',
                //'name' => 'post[subtitle]'
                'name' => 'is_modal',
                //'except' => ['index'],
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Integer',
                //'name' => 'post[subtitle]'
                'name' => 'status',
                //'except' => ['index'],
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'Wysiwyg',
                //'type' => 'Textarea',
                'name' => 'post.txt',
                'except' => ['index'],
                'col_bs_size' => 12,
            ],
             (object) [
                'type' => 'CellCollapse',
                //'type' => 'Textarea',
                'name' => 'Seo',
                'fields' => $this->seoFields(),
                'col_bs_size' => 12,
            ],
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs()
    {
        $tabs_name = [];

        return [];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request = null)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions()
    {
        return [
            new Actions\SendMsgAction()
        ];
    }
}
