<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            // user = table name, user_id = column name that is why it is user_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // constrained() is used to reference the default table of the model
            $table->unsignedBigInteger('followed_user_id');
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');

            // since foreignId use table name + _id, we can use unsignedBigInteger to follow the same convention
            // then we can use foreign() to reference the table and column
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
        Schema::dropIfExists('follows');
    }
}
