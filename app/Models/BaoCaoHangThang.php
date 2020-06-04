<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaoCaoHangThang extends Model
{
    protected $table = 'bao_cao_hang_thang';
	protected $primaryKey = 'ID';
	public $timestamps = false;

	protected $casts = [
		'ID' => 'int'
	];

	protected $fillable = [
		'TT',
        'MUC_CB',
        'ID_THIETBI',
        'Object',
        'NGUYEN_NHAN',
        'THOI_GIAN_SU_CO',
        'THOI_GIAN_CLR',
        'THOI_GIAN_CB',
        'TRANG_THAI_CLR',
        'MA_CB',
        'CHI_TIET_CANH_BAO',
        'VNP_GHI_CHU',
        'TINH_GHI_CHU',	
        'LOAI_SU_CO',
        'THOI_GIAN_CANH_BAO_AC',
        'THANG',
	];
}
