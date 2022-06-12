<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id()->comment('Id');
            $table->tinyInteger('type')->default(1)->comment('1: Send all, 2: send role, 3: send one user');
            $table->integer('receiver_id')->nullable()->comment('Id of receiver');
            $table->string('content')->nullable()->comment('Content of notification');
            $table->string('url')->nullable()->comment('URL to change');
            $table->tinyInteger('status')->default(1)->comment('1 : active, 2 : sent, 3 : read');
            $table->string('created_by')->nullable()->comment('User created notification');
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
        Schema::dropIfExists('admin_notifications');
    }
}
