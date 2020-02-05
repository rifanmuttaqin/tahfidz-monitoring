<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaHasIqroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa_has_iqro', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('iqro_id')->nullable();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->integer('page');
            $table->dateTime('date');
            $table->text('note')->nullable();
            $table->string('group_page'); // Grup page untuk merangkum kelompok penilaian bedasarkan range
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('siswa_id')
            ->references('id')
            ->on('tbl_siswa')
            ->onDelete('set null');
            
            $table->foreign('iqro_id')
                ->references('id')
                ->on('tbl_iqro')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('tbl_siswa_has_iqro');
    }
}
