<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('content');
            $table->integer('status');
            $table->string('slug');
            $table->double('rating')->nullable()->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('seed')->default(0);
            
            $table->integer('sub_category_id')->nullable()->unsigned()->index();
            $table->integer('category_id')->nullable()->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

            
            $table->foreign('sub_category_id')
            ->references('id')->on('sub_categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
