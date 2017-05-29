<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstrainToPostsTable extends Migration
{

    public function up()
    {
        Schema::table('posts', function($table) {

            $table->dropForeign('posts_user_id_foreign');
            $table->dropForeign('posts_category_id_foreign');
            $table->dropForeign('posts_sub_category_id_foreign');

            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('no action');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('no action');

            $table->foreign('sub_category_id')
            ->references('id')->on('sub_categories')
            ->onDelete('no action');
        });
    }

    public function down()
    {
    }
}
