<?php

use Illuminate\Database\Schema\Blueprint;

//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateAmenityMorphTable extends XotBaseMigration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
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
        });
    }//end up
}//end class

