<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

//---models
//use Modules\Blog\Models\Photo as MyModel;

class CreatePhotosTable extends XotBaseMigration {
    public function up() {
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id'); //->primary();
                $table->string('updated_by')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }

        Schema::table($this->getTable(), function (Blueprint $table) {
            if (! Schema::hasColumn($this->getTable(), 'updated_by')) {
                $table->string('updated_by')->nullable()->after('updated_at');
            }
            if (! Schema::hasColumn($this->getTable(), 'created_by')) {
                $table->string('created_by')->nullable()->after('created_at');
            }
            if (Schema::hasColumn($this->getTable(), 'post_id')) {
                $table->renameColumn('post_id', 'id');
            }
            if (! Schema::hasColumn($this->getTable(), 'auth_user_id')) {
                $table->integer('auth_user_id')->nullable();
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
