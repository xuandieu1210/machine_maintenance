<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaoCaoHangThangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bao_cao_hang_thang', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('TT');	
            $table->string('MUC_CB', 100);	
            $table->integer('ID_THIETBI');
            $table->string('Object'. 100);
            $table->string('NGUYEN_NHAN', 255);
            $table->dateTime('THOI_GIAN_SU_CO');	
            $table->dateTime('THOI_GIAN_CLR');	
            $table->dateTime('THOI_GIAN_CB');	
            $table->string('TRANG_THAI_CLR', 100);	
            $table->string('MA_CB', 100);	
            $table->string('CHI_TIET_CANH_BAO', 255);	
            $table->string('VNP_GHI_CHU', 255);	
            $table->string('TINH_GHI_CHU', 255);		
            $table->string('LOAI_SU_CO', 255);	
            $table->string('THOI_GIAN_CANH_BAO_AC', 255);

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
        Schema::dropIfExists('bao_cao_hang_thang');
    }
}
