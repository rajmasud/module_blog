<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\Rating as MyModel;

class CreateRatingsTable extends Migration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        //----- create -----
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id'); //->primary();
                $table->string('related_type', 50)->index()->nullable();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //----- update -----
        Schema::table($this->getTable(), function (Blueprint $table) {
            if (! Schema::hasColumn($this->getTable(), 'related_type')) {
                $table->string('related_type', 50)->index()->nullable();
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
