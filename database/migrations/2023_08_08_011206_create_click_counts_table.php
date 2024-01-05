<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('click_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_book_user_id');
            $table->string('type');

            $table->timestamps();

            $table->foreign('phone_book_user_id')->references('id')->on('phone_book_users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('click_counts');
    }
};
