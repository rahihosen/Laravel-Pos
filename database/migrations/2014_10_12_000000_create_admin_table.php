<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('admin_image')->nullable();
            $table->string('password');
            $table->integer('admin_role')->default(1);
            $table->boolean('admin_status')->default(1);
            $table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
