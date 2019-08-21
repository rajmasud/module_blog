<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Modules\Blog\Models\Article as MyModel;;

class CreateBlogPostArticlesTable extends Migration
{
    //protected $table = 'blog_post_articles';
    public function getTable(){
        return with(new MyModel())->getTable();
    }

    public function up(){
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                //$table->increments('id');
                $table->increments('post_id');//->primary();
                $table->string('article_type', 50)->nullable();
                $table->datetime('published_at')->nullable();
                $table->string('updated_by', 255)->nullable()->after('updated_at');
                $table->string('created_by', 255)->nullable()->after('created_at');
                $table->timestamps();
            });
        }
        Schema::table($this->getTable(), function (Blueprint $table) {
            if (!Schema::hasColumn($this->getTable(), 'updated_by')) {
                $table->string('updated_by', 255)->nullable()->after('updated_at');
            }
            if (!Schema::hasColumn($this->getTable(), 'created_by')) {
                $table->string('created_by', 255)->nullable()->after('created_at');
            }
            if (!Schema::hasColumn($this->getTable(), 'parent_id')) {
                $table->nullableMorphs('parent');
            }
            //$sql='ALTER TABLE '.$this->getTable().' CHANGE COLUMN post_id post_id INT(16) NOT NULL AUTO_INCREMENT FIRST;';
            //\DB::unprepared($sql);

        });
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
