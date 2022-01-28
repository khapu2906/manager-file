<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhapuFileManagerAssocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KhapuFileManagerAssoc', function (Blueprint $table) {
            $table->id();
            $table->string('dir_id')->unique();
            $table->string('permission_id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('KhapuFileManagerAssoc');
    }
}
