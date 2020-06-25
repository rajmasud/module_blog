<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;

class ProfilePanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    protected static $model = 'Modules\Blog\Models\Profile';

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
    protected static $search = [];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static function with() {
        return [];
    }

    public function search() {
        return [];
    }

    /**
     * on select the option id.
     */
    public function optionId($row) {
        return $row->area_id;
    }

    /**
     * on select the option label.
     */
    public function optionLabel($row) {
        return $row->area_define_name;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
        'col_bs_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
        'value'=>'..',
     */
    public function indexNav() {
        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param Request                               $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery($data, $query) {
        //return $query->where('auth_user_id', $request->user()->auth_user_id);
        return $query;
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(Request $request, $query) {
        //return $query->where('auth_user_id', $request->user()->auth_user_id);
         //return $query->where('user_id', $request->user()->id);
    }

    public function fields() {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'id',
                //'rules' => 'required',
                'comment' => null,
            ],
            (object) [
                'type' => 'String',
                'name' => 'user.first_name',
                //'rules' => 'required',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'user.last_name',
                //'rules' => 'required',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'String',
                'name' => 'user.handle',
                //'rules' => 'required',
                'comment' => null,
                'col_bs_size' => 6,
            ],
            (object) [
                'type' => 'PasswordWithConfirm',
                'name' => 'user.passwd',
                'rules' => 'required|confirmed',
                'comment' => null,
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'AddressGoogle',
                'name' => 'indirizzo',
                //'rules' => 'required',
                'comment' => null,
                'col_bs_size' => 12,
            ],
            (object) [
                'type' => 'PivotFields', //-- da aggiornare
                'name' => Str::plural('privacy'),
                'col_bs_size' => 12,
                'rules' => 'pivot_rules',
                'except' => ['index'],
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
    public function actions(Request $request = null) {
        return [
            new \Modules\Blog\Models\Panels\Actions\PersonalInfoAction(),
            new \Modules\Blog\Models\Panels\Actions\UserSecurityAction(),
        ];
    }

    // avatar esiste solo in profile, non esiste l'avatar di un articolo
    public function avatar($size = 100) {
        $user = $this->row->user;
        if (! is_object($user)) {
            if (isset($this->row->auth_user_id)) {
                $this->row->user()->create();
            }
            //dddx($this->row);
            return null;
        }
        $email = \md5(\mb_strtolower(\trim($user->email)));
        $default = \urlencode('https://tracker.moodle.org/secure/attachment/30912/f3.png');

        return "https://www.gravatar.com/avatar/$email?d=$default&s=$size";
    }
}
