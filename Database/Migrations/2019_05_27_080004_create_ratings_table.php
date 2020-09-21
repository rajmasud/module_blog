<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Blog\Models\Rating as MyModel;
//----- models -----
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateRatingsTable extends XotBaseMigration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        //----- create -----
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
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
            if (Schema::hasColumn($this->getTable(), 'post_id')) {
                $table->renameColumn('post_id', 'id');
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
