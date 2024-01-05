<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_book_users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_url')->nullable();
            $table->string('social_id')->nullable();
            $table->string('backup_file')->nullable();
            $table->string('fcm_token')->nullable();
            $table->date('plan_expire_at')->nullable();

            $table->tinyInteger('is_active')->default(1);
            $table->string('api_token')->unique()->nullable()->default(null);;

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
        Schema::dropIfExists('phone_book_users');
    }
};
