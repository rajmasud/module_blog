<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Blog\Models\Page as MyModel;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreatePagesTable extends XotBaseMigration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('published_at')->nullable();
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
            if (! Schema::hasColumn($this->getTable(), 'layout_position')) {
                $table->string('layout_position')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'blade')) {
                $table->string('blade')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'parent_id')) {
                $table->integer('parent_id')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'pos')) {
                $table->integer('pos')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'icon')) {
                $table->string('icon')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'is_modal')) {
                $table->boolean('is_modal')->nullable();
            }
            if (! Schema::hasColumn($this->getTable(), 'status')) {
                $table->integer('status')->nullable();
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
