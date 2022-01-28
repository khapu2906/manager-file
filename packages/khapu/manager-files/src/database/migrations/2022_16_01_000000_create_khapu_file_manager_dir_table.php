<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhapuFileManagerDirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KhapuFileManagerDir', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('basePath')->unique();
            $table->string('subPath')->unique();
            $table->json('type');
            $table->int('size');
            $table->string('unitSize');
            $table->int('parentId');
            $table->int('level');
            $table->int('child');
            $table->bigInteger('modifiedAt');
            $table->bigInteger('inodeChangeAt');
            $table->bigInteger('accessedAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('KhapuFileManagerDir');
    }
}
