<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\Home as MyModel;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateHomesTable extends XotBaseMigration
{
    public function up()
    {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
                $this->getTable(),
                function (Blueprint $table) {
                    $table->increments('post_id'); //->primary();
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table(
            $this->getTable(),
            function (Blueprint $table) {
                if (! $this->hasColumn('icon_src')) {
                    $table->string('icon_src')->nullable();
                }
                if ($this->hasColumn('post_id')) {
                    $table->renameColumn('post_id', 'id');
                }
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
