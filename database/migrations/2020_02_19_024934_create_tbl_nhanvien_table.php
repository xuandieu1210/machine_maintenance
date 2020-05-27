<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nhanvien', function (Blueprint $table) {
            $table->bigIncrements('ID_NHANVIEN');
            $table->char('TEN_NHANVIEN');
            $table->char('MA_NHANVIEN');
            $table->char('CHUC_VU');
            $table->char('DIEN_THOAI');
            $table->char('GHI_CHU');
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
        Schema::dropIfExists('tbl_nhanvien');
    }
}
