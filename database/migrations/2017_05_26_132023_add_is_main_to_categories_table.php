<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsMainToCategoriesTable extends Migration
{

    public function up()
    {
        Schema::table('categories', function($table) {
            $table->string('is_main')->default('1');
            $table->string('is_top')->default('0');
        });
    }

    public function down()
    {
        Schema::table('sub_categories', function($table) {
            $table->dropColumn('is_main');
            $table->dropColumn('is_top');
        });
    }
}
