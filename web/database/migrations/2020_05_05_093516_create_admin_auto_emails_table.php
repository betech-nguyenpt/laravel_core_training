<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAutoEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_auto_emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->string('content')->nullable();
            $table->string('sent_to')->nullable();
            $table->integer('type')->default(1);
            $table->datetime('time_sent')->default(DB::raw('CURRENT_TIMESTAMP'));;
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
        Schema::dropIfExists('admin_auto_emails');
    }
}