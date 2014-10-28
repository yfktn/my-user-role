<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments("id");
            $table->string("username")->unique();
            $table->char('password', 64);
            $table->string("email", 64)->unique();
            $table->string("remember_token")
                ->nullable()
                ->default(null);
            $table->dateTime("created_at")
                ->nullable()
                ->default(null);
            $table->dateTime("updated_at")
                ->nullable()
                ->default(null);
            $table->dateTime("last_login_at")->nullable()
                ->default(null);
            // kedua perintah diatas bisa disingkat menjadi
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            Schema::dropIfExists("users");
        });
    }

}
