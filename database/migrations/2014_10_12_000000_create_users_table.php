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
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('age');
            $table->string('email')->unique();
            $table->string('account_number_bank')->unique();
            $table->unsignedInteger('money')->default(0)->nullable();
            $table->unsignedBigInteger('already_received_money')->default(0)->nullable();
            $table->unsignedBigInteger('count_points')->default(0)->nullable();
            $table->bigInteger('thing_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
