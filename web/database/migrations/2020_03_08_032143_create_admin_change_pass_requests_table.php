<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminChangePassRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_change_pass_requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('code');
            $table->string('ip_address');
            $table->string('country');
            $table->tinyInteger('device');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('created_by')->default(0);
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
        Schema::dropIfExists('admin_change_pass_requests');
    }
}