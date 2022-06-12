<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLoggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_loggers', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('country')->nullable();
            $table->string('message')->nullable();
            $table->string('description')->nullable();
            $table->integer('level')->nullable();
            $table->integer('logtime')->nullable();
            $table->string('category')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('admin_loggers');
    }
}
