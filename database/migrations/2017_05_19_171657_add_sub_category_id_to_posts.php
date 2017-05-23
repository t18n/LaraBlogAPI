<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubCategoryIdToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function($table) {
            $table->integer('view_count')->default(0);
            $table->integer('seed')->default(0);
            $table->integer('sub_category_id');

            $table->foreign('sub_category_id')
            ->references('id')->on('sub_categories')
            ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropColumn('view_count');
            $table->dropColumn('seed');
            $table->dropColumn('sub_category_id');
            
            $table->dropForeign('sub_category_id');
        });
    }
}
