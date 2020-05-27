<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tram', function (Blueprint $table) {
            $table->bigIncrements('ID_TRAM');
            $table->char('TEN_TRAM');
            $table->char('MA_TRAM');
            $table->char('DIA_CHI');
            $table->char('SO_DT');
            $table->integer('ID_DAI');
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
        Schema::dropIfExists('tbl_tram');
    }
}
