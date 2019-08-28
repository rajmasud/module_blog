<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\PrivacyMorph as MyModel; //-- con MorphPivot non e' morphs ma morph

class CreatePrivacyMorphTable extends Migration{
    
    public function getTable(){
        return with(new MyModel())->getTable();
    }

    public function up(){
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->nullableMorphs('post');
                $table->nullableMorphs('related');
                $table->text('title')->nullable(); //ricopio il title
                $table->tinyInteger('value')->nullable(); //-- 0 o 1 
                $table->integer('auth_user_id')->nullable()->index();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //----- update -----
        Schema::table($this->getTable(), function (Blueprint $table) {
        });
    }

    public function down(){
        Schema::dropIfExists($this->getTable());
    }
}
