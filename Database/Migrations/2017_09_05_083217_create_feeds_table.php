<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;
//----- models -----
use Modules\Blog\Models\Feed as MyModel;

class CreateFeedsTable extends XotBaseMigration
{
    public function getTable()
    {
        return with(new MyModel())->getTable();
    }

    public function up()
    {
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id'); //->primary();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->timestamps();
            });

            //----- UPDATE
            Schema::table($this->getTable(), function (Blueprint $table) {
                if (Schema::hasColumn($this->getTable(), 'post_id')) {
                    $table->renameColumn('post_id', 'id');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
