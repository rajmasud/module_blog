<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//----- models -----
use Modules\Blog\Models\Rating as MyModel;

//--
/*
https://phppot.com/php/php-star-rating-system-with-javascript/
https://www.phpzag.com/star-rating-system-with-ajax-php-and-mysql/
*/


class CreateRatingsTable extends Migration
{
    public function getTable(){
        return with(new MyModel())->getTable();
    }

    public function up(){
        //----- create -----
        if (!Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id');
                $table->string('related_type',50)->index()->nullable();
                //$table->datetime('published_at')->nullable();
                //$table->text('bio')->nullable();
                //$table->increments('id');
                //$table->morphs('upvoteable'); // Adds unsigned INTEGER upvoteable_id and STRING upvoteable_type
                //$table->morphs('post');
                //$table->integer('rating');
                //$table->text('note');
                //`status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Block, 0 = Unblock'
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
                $table->timestamps();
            });
        }
        //----- update -----
        Schema::table($this->getTable(), function (Blueprint $table) {
            if (!Schema::hasColumn($this->getTable(), 'related_type')) {
                //$table->morphs('post');

                $table->string('related_type',50)->index()->nullable();
            };
            /*
            if (!Schema::hasColumn($this->getTable(), 'date_start')) {
                $table->dateTime('date_start')->nullable();
                $table->dateTime('date_end')->nullable();
            };

            if (!Schema::hasColumn($this->getTable(), 'created_by')) {
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->string('deleted_by')->nullable();
            };
            */
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }
}
