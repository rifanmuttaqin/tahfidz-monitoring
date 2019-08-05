<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_class', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->string('angkatan');
            $table->string('class_name');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('teacher_id'); // Teacher diambilkan dari data user dengan type Guru
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('teacher_id')
                ->references('id')
                ->on('tbl_user')
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
        Schema::dropIfExists('tbl_class');
    }
}
