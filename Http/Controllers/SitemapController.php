<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller;

//---- services ---

class SitemapController extends Controller {
    private static $instance = null;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function index() {
        return self::getInstance(); /// per il fluent, o chaining
    }

    public function show() {
        return self::getInstance(); /// per il fluent, o chaining
    }

    public function out() {
        return 'to-do';
    }
}
