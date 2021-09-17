<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * 管理员
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable(false)->default('')->unique();
            $table->string('password')->nullable(false)->default('');
            $table->string('name')->nullable(false)->default('')->unique();
            $table->string('avatar')->nullable(false)->default('');
            $table->string('remember_token')->nullable(false)->default('');
            $table->string('login_ip')->nullable(false)->default('');
            $table->timestamp('last_login_at');
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
        Schema::dropIfExists('admins');
    }
}
