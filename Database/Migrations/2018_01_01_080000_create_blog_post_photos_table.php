<<<<<<< HEAD
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//---models
use Modules\Blog\Models\Photo as MyModel;

class CreateBlogPostPhotosTable extends Migration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id'); //->primary();
                $table->string('updated_by')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }

        Schema::table($this->getTable(), function (Blueprint $table) {
            if (! Schema::hasColumn($this->getTable(), 'updated_by')) {
                $table->string('updated_by')->nullable()->after('updated_at');
            }
            if (! Schema::hasColumn($this->getTable(), 'created_by')) {
                $table->string('created_by')->nullable()->after('created_at');
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
=======
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//---models
use Modules\Blog\Models\Photo as MyModel;

class CreateBlogPostPhotosTable extends Migration {
    public function getTable() {
        return with(new MyModel())->getTable();
    }

    public function up() {
        if (! Schema::hasTable($this->getTable())) {
            Schema::create($this->getTable(), function (Blueprint $table) {
                $table->increments('post_id'); //->primary();
                $table->string('updated_by')->nullable();
                $table->string('created_by')->nullable();
                $table->timestamps();
            });
        }

        Schema::table($this->getTable(), function (Blueprint $table) {
            if (! Schema::hasColumn($this->getTable(), 'updated_by')) {
                $table->string('updated_by')->nullable()->after('updated_at');
            }
            if (! Schema::hasColumn($this->getTable(), 'created_by')) {
                $table->string('created_by')->nullable()->after('created_at');
            }
        });
    }

    public function down() {
        Schema::dropIfExists($this->getTable());
    }
}
>>>>>>> ,
