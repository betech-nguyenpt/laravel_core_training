<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminOneManyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_one_many', function (Blueprint $table) {
            $table->id()->comment('Id');
            $table->integer('one_id')->comment('One id');
            $table->integer('many_id')->comment('Many id');
            $table->tinyInteger('type')->comment('Type of relation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_one_many');
    }
}
