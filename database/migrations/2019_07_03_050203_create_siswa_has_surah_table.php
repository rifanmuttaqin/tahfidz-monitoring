<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaHasSurahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa_has_surah', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('surah_id')->nullable();
            $table->integer('ayat');
            $table->dateTime('date');
            $table->text('note')->nullable();
            $table->string('group_ayat'); // Grup ayat untuk merangkum kelompok penilaian bedasarkan range
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        
            $table->foreign('siswa_id')
            ->references('id')
            ->on('tbl_siswa')
            ->onDelete('set null');
            
            $table->foreign('surah_id')
                ->references('id')
                ->on('tbl_surah')
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
        Schema::dropIfExists('tbl_siswa_has_surah');
    }
}
