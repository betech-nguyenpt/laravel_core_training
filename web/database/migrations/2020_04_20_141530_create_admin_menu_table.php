<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('action_id');
            $table->string('view')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_thumb')->nullable();
            $table->tinyInteger('display_order')->default(1);
            $table->string('name');
            $table->tinyInteger('type')->default(1);
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('admin_menu');
    }
}
