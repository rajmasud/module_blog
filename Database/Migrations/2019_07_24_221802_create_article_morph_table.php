<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\ArticleMorph as MyModel;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateArticleMorphTable extends XotBaseMigration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        //----- create -----
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->nullableMorphs('post');
                $table->nullableMorphs('related');
                $table->integer('auth_user_id')->nullable()->index();

                $table->string('note')->nullable();

                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //----- update -----
        Schema::table($this->getTable(), function (Blueprint $table) {
            if (Schema::hasColumn($this->getTable(), 'related_id')) {
                $table->renameColumn('related_id', 'article_id');
            }

            if (! Schema::hasColumn($this->getTable(), 'article_id')) {
                $table->integer('article_id');
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
