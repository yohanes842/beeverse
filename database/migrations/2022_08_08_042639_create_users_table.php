<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname')->unique();
            $table->integer('age');
            $table->string('hobby');
            $table->foreignId('gender_id')->constrained('genders');
            $table->string('instagram_username')->unique();
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('balance');
            $table->foreignId("visible_status_id")->constrained('visible_statuses');
            $table->foreignId('payment_status_id')->constrained('payment_statuses');
            $table->bigInteger('payment_price');
            $table->string('image_profile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
