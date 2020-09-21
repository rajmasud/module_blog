<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateArticlesTable extends XotBaseMigration {
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create($this->getTable(),
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->nullableMorphs('parent');
                    $table->integer('pos')->nullable();
                    $table->string('article_type', 50)->nullable();
                    $table->datetime('published_at')->nullable();
                    $table->string('updated_by', 155)->nullable();
                    $table->string('created_by', 155)->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(),
            function (Blueprint $table) {
                if (! Schema::hasColumn($this->getTable(), 'updated_by')) {
                    $table->string('updated_by', 155)
                        ->nullable()
                        ->after('updated_at');
                }
                if (! Schema::hasColumn($this->getTable(), 'created_by')) {
                    $table->string('created_by', 155)
                        ->nullable()
                        ->after('created_at');
                }
                if (! Schema::hasColumn($this->getTable(), 'parent_id')) {
                    $table->nullableMorphs('parent');
                }
                if (! Schema::hasColumn($this->getTable(), 'pos')) {
                    $table->integer('pos')->nullable();
                }
                if (Schema::hasColumn($this->getTable(), 'post_id')) {
                    $table->renameColumn('post_id', 'id');
                }

                if (! Schema::hasColumn($this->getTable(), 'auth_user_id')) {
                    $table->integer('auth_user_id')->nullable();
                }

                if (! Schema::hasColumn($this->getTable(), 'is_featured')) {
                    $table->boolean('is_featured')->nullable();
                }
            }
        );
    }
}
