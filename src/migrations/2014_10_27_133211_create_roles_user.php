<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesUser extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('desc')->nullable()->default(null);
            // sebuah group mewarisi perizinan group yang lain?
            // misalnya group editor akan mewarisi perizinan milik group contributor
            // hanya satu group perizinan saja!
            $table->unsignedInteger('inherit_from_id')->nullable()->default(null);
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
        Schema::drop('roles');
    }

}
