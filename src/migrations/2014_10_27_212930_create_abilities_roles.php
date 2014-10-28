<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbilitiesRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('permission_role', function(Blueprint $table)
        {
            $table->increments("id");
            $table->unsignedInteger("permission_id")->index();
            $table->unsignedInteger("role_id")->index();
        });

        Schema::table("permission_role", function(Blueprint $table)
        {
            $table->foreign("permission_id")->references("id")->on("permissions")->onDelete('cascade');
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
		Schema::drop("permission_role");
	}

}