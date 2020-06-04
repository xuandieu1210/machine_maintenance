<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblThietbiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_thietbi', function (Blueprint $table) {
            $table->bigIncrements('ID_THIETBI');
            $table->char('TEN_THIETBI');
            $table->char('MA_THIETBI');
            $table->char('LOAI_MAY');
            $table->char('HANG');
            $table->float('DINH_MUC_DAU', 8, 2);
            $table->float('DINH_MUC_NHOT', 8, 2);	
            $table->float('DUNG_TICH_BINH_NHOT', 8, 2);
            $table->float('NHOT_TIEU_HAO', 8, 2)->nullable($value = true);
            $table->date('THOI_GIAN_THAY_NHOT')->nullable($value = true);
            $table->integer('ID_TRAM');	
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
        Schema::dropIfExists('tbl_thietbi');
    }
}
