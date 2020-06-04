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
            $table->integer('THOI_GIAN_CB');	
            $table->string('TRANG_THAI_CLR', 100);	
            $table->string('MA_CB', 100);	
            $table->text('CHI_TIET_CANH_BAO');	
            $table->text('VNP_GHI_CHU');	
            $table->text('TINH_GHI_CHU');		
            $table->string('LOAI_SU_CO');	
            $table->string('THOI_GIAN_CANH_BAO_AC', 255);
            $table->date('THANG');
            $table->timestamps();
            $table->unique( ['ID_THIETBI', 'THOI_GIAN_SU_CO']);
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
