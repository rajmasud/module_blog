<?php

use Illuminate\Database\Schema\Blueprint;
//----- models -----
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateImagesTable extends XotBaseMigration {
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create($this->getTable(),
                function (Blueprint $table) {
                    $table->increments('id'); //->primary();
                    $table->nullableMorphs('post');
                    $table->text('src')->nullable();
                    $table->integer('auth_user_id')->nullable();
                    $table->text('note')->nullable();
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(),
            function (Blueprint $table) {
                if (! $this->hasColumn('src_out')) {
                    $table->text('src_out')->nullable()->after('src');
                }
                if (! $this->hasColumn('width')) {
                    $table->integer('width')->nullable()->after('src');
                }
                if (! $this->hasColumn('height')) {
                    $table->integer('height')->nullable()->after('src');
                }
            }
        );
    }
}
