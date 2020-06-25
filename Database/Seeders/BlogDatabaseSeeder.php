<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BlogDatabaseSeeder extends Seeder {
    public function run() {
        Model::unguard();
        // $this->call("OthersTableSeeder");
    }
}
