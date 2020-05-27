<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDonviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_donvi', function (Blueprint $table) {
            $table->bigIncrements('ID_DONVI');
            $table->char('TEN_DONVI');
            $table->char('MA_DONVI');
            $table->char('DIA_CHI');
            $table->char('SO_DT');
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
        Schema::dropIfExists('tbl_donvi');
    }
}
