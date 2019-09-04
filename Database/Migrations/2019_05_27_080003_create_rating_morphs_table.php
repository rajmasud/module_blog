<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\RatingMorph as MyModel;

class CreateRatingMorphsTable extends Migration{
    public function getTable(){
        return with(new MyModel())->getTable();
    }

    public function up(){
        //----- create -----
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->nullableMorphs('post',191);
                $table->nullableMorphs('related',191);
                $table->integer('rating')->nullable();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //----- update -----
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->integer('rating')->nullable()->change();
            if (!Schema::hasColumn($this->getTable(), 'auth_user_id')) {
                $table->integer('auth_user_id')->nullable()->index();
            }
        });
    }

    public function down(){
        Schema::dropIfExists($this->getTable());
    }
}
