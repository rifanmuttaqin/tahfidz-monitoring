<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->string('siswa_name');
            $table->integer('memorization_type');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('parent_id'); // parent diambil dari data user dengan type Guru
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('parent_id')
                ->references('id')
                ->on('tbl_user')
                ->onDelete('cascade');

            $table->foreign('class_id')
                ->references('id')
                ->on('tbl_class')
                ->onDelete('cascade');
                
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_siswa');
    }
}
