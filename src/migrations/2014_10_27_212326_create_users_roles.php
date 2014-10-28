<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('role_user', function(Blueprint $table)
        {
            $table->increments("id");
            $table->unsignedInteger("user_id")->index();
            $table->unsignedInteger("role_id")->index();
        });

        Schema::table("role_user", function(Blueprint $table)
        {
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("role_id")->references("id")->on("roles")->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("role_user");
	}

}
