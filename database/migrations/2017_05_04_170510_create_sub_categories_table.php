<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id')->unsigned()->index();

            $table->foreign('category_id')
            ->references('id')->on('categories');
        });
    }


    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
