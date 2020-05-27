<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDaivtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_daivt', function (Blueprint $table) {
            $table->bigIncrements('ID_DAI');
            $table->char('TEN_DAIVT');
            $table->char('MA_DAIVT');
            $table->char('DIA_CHI');
            $table->char('SO_DT');
            $table->integer('ID_DONVI');
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
        Schema::dropIfExists('tbl_daivt');
    }
}
