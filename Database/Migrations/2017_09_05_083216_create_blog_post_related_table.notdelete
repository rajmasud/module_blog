<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\PostRelated as MyModel;


class CreateBlogPostRelatedTable extends Migration{
    public function getTable(){
        return with(new MyModel())->getTable();
    }

    public function up()
    {
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('id');
                $table->nullableMorphs('post');
                $table->nullableMorphs('related');
                $table->integer('pos')->nullable();
                $table->string('note')->nullable();
                $table->integer('sons_count')->nullable();
                $table->integer('parents_count')->nullable();
                $table->timestamps();
            });
        }

        Schema::table($this->getTable(), function (Blueprint $table) {
            if (!Schema::hasColumn($this->getTable(), 'price')) {
                $table->decimal('price', 10, 3)->nullable();
            }
            if (!Schema::hasColumn($this->getTable(), 'price_currency')) {
                $table->string('price_currency')->nullable();
            }
            if (!Schema::hasColumn($this->getTable(), 'launch_available')) {
                $table->boolean('launch_available')->nullable();
            }
            if (!Schema::hasColumn($this->getTable(), 'dinner_available')) {
                $table->boolean('dinner_available')->nullable();
            }
            if (!Schema::hasColumn($this->getTable(), 'pos')) {
                $table->integer('pos')->nullable();
            }
            if (!Schema::hasColumn($this->getTable(), 'note')) {
                $table->text('note')->nullable();
            }
            if (Schema::hasColumn($this->getTable(), 'note')) {
                $table->text('note')->nullable()->change();
            }
            //------- CHANGE-------
            $schema_builder = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableDetails($table->getTable());

            if (!$schema_builder->hasIndex($this->getTable().'_'.'post_id'.'_index')) {
                $table->integer('post_id')->nullable()->index()->change();
            }
            if (!$schema_builder->hasIndex($this->getTable().'_'.'related_id'.'_index')) {
                $table->integer('related_id')->nullable()->index()->change();
            }
            if (!Schema::hasColumn($this->getTable(), 'post_type')) {
                $table->string('post_type', 50)->nullable()->index();
            }
            if (!$schema_builder->hasIndex($this->getTable().'_'.'post_type'.'_index')) {
                $table->string('post_type', 50)->nullable()->index()->change();
            }
            if (!Schema::hasColumn($this->getTable(), 'related_type')) {
                $table->string('related_type', 50)->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
