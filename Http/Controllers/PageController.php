<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller;

//---- services ---

class PageController extends Controller
{
    private static $instance = null;
    public $html='sss';

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function index()
    {
        return self::getInstance(); /// per il fluent, o chaining
    }

    public function show(){ 
        $instance=self::getInstance();
        [$containers,$items]=params2ContainerItem();
        $last_item=last($items);
        $instance->html= (string)view('pub_theme::pages.'.$last_item)
        ->with('lang', \App::getLocale());

        return $instance;// per il fluent, o chaining
    }

    public function out()
    {
        return $this->html;
    }
}
