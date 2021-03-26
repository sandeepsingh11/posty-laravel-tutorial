<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // create auto incremented id col
            $table->id();
            // create a fk (user table -> id col)
            $table->foreignId('user_id')
                // for gui -> select user id
                ->constrained()
                // when user is deleted, delete all their according posts
                ->onDelete('cascade');
            $table->text('body');
            // create created_at, _updated_at cols
            $table->timestamps();
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
