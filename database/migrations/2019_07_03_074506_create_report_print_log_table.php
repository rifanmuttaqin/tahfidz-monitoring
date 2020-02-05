<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportPrintLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_report_print_log', function (Blueprint $table) {
            $table->bigIncrements('id', 20);
            $table->unsignedBigInteger('print_by');
            $table->dateTime('date');
            $table->text('note')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    
            $table->foreign('print_by')
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
        Schema::dropIfExists('tbl_report_print_log');
    }
}
