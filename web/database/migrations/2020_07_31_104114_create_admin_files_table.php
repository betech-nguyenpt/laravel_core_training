<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_files', function (Blueprint $table) {
            $table->id()->comment('Id');
            $table->tinyInteger('type')->nullable()->comment('Type of relation');
            $table->bigInteger('belong_id')->nullable()->comment('Id of record relate with file');
            $table->tinyInteger('file_type')->nullable()->comment('Type of file (image/video/document...)');
            $table->tinyInteger('order_number')->nullable()->comment('Order number');
            $table->text('file_name')->nullable()->comment('Name of file');
            $table->text('description')->nullable()->comment('Description');
            $table->tinyInteger('status')->comment('Status');
            $table->timestamp('created_date')->useCurrent()->comment('Created date');
            $table->integer('created_by')->comment('Created by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_files');
    }
}
