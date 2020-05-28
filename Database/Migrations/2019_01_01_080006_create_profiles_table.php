<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Location;
//----- models-------
use Modules\Xot\Database\Migrations\XotBaseMigration;  //blog o food ?

class CreateProfilesTable extends XotBaseMigration {
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
                $this->getTable(),
                function (Blueprint $table) {
                    $table->increments('id'); //->primary();//->primary();
                    $table->string('post_type', 191)->nullable()->index();
                    //$table->string('article_type',50)->nullable();
                    //$table->datetime('published_at')->nullable();
                    $table->text('bio')->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table(
            $this->getTable(),
            function (Blueprint $table) {
                //------- add
                if (! $this->hasColumn('created_by')) {
                    $table->string('created_by')->nullable();
                }
                if (! $this->hasColumn('updated_by')) {
                    $table->string('updated_by')->nullable();
                }
                if (! $this->hasColumn('deleted_by')) {
                    $table->string('deleted_by')->nullable();
                }
                if (! $this->hasColumn('firstname')) {
                    $table->string('firstname')->nullable();
                }
                if (! $this->hasColumn('surname')) {
                    $table->string('surname')->nullable();
                }
                if (! $this->hasColumn('email')) {
                    $table->string('email')->nullable();
                }
                if (! $this->hasColumn('phone')) {
                    $table->string('phone')->nullable();
                }
                if (! $this->hasColumn('address')) {
                    $table->string('address')->nullable();
                }
                if (! $this->hasColumn('auth_user_id')) {
                    $table->integer('auth_user_id')->nullable()->index();
                }

                $address_components = Location::$address_components;
                foreach ($address_components as $el) {
                    if (! $this->hasColumn($el)) {
                        $table->string($el)->nullable();
                    }
                    if (! $this->hasColumn($el.'_short')) {
                        $table->string($el.'_short')->nullable();
                    }
                }

                if ($this->hasColumn('post_id')) {
                    $table->dropPrimary('post_id');
                    $table->renameColumn('post_id', 'id');
                    $table->primary('id');
                }
            }
        );
    }
}
