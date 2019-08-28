<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\Feed as MyModel;


class CreateBlogFeedsTable extends Migration{

    public function getTable(){
        return with(new MyModel())->getTable();
    }
    

    public function up()
    {
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id');//->primary();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
