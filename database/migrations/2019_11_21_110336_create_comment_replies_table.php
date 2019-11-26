<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_comment_id');
            $table->unsignedBigInteger('user_id');
            $table->text('reply');
            $table->foreign('blog_comment_id')
                ->references('id')->on('blog_comments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('comment_replies');
    }
}
