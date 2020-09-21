<?php

use Illuminate\Database\Schema\Blueprint;

//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateAmenityMorphTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->nullableMorphs('post');
                $table->nullableMorphs('related');
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->timestamps();
            });
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(), function (Blueprint $table) {
            if (! $this->hasColumn('updated_at')) {
                $table->timestamps();
            }
            if (! $this->hasColumn('auth_user_id')) {
                $table->integer('auth_user_id')->nullable();
                $table->text('note')->nullable();
            }
            if (Schema::hasColumn($this->getTable(), 'related_id')) {
                $table->renameColumn('related_id', 'amenity_id');
            };
        });
    }//end up
}//end class
