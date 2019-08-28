<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

//------ models ------
use Modules\Blog\Models\PostShopItem as MyModel;


class CreateBlogPostShopItemsTable extends Migration{
    
    public function getTable(){
        return with(new MyModel())->getTable();
    }
    public function up(){
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_cat_id');
                $table->integer('post_id');
                $table->integer('post_var_cat_id');
                $table->string('post_id_adds');
                $table->string('post_id_subs');
                $table->integer('num')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
