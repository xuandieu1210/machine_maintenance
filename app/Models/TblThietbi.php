<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jul 2019 02:03:52 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblNhanvien
 * 
 * @property int $ID_NHANVIEN
 * @property string $MA_NHANVIEN
 * @property string $TEN_NHANVIEN
 * @property string $CHUC_VU
 * @property string $DIEN_THOAI
 * @property int $ID_DONVI
 * @property int $ID_DAI
 * @property bool $SMS_ALARM
 * @property string $GHI_CHU
 * @property string $USER_NAME
 * @property int $SMS_TIME
 * 
 * @property \App\Models\TblDaivt $tbl_daivt
 * @property \App\Models\TblDonvi $tbl_donvi
 * @property \Illuminate\Database\Eloquent\Collection $tbl_pis
 *
 * @package App\Models
 */
class TblThietbi extends Eloquent
{
	protected $table = 'tbl_thietbi';
	protected $primaryKey = 'ID_THIETBI';
	public $timestamps = false;

	protected $casts = [
		'ID_TRAM' => 'int',
	];

	protected $fillable = [
		'ID_THIETBI',
		'TEN_THIETBI',
		'MA_THIETBI',
		'LOAI_MAY',
		'HANG',
		'DINH_MUC_DAU',
		'DINH_MUC_NHOT',
		'DUNG_TICH_BINH_NHOT',
		'NHOT_TIEU_HAO',
		'THOI_GIAN_THAY_NHOT',
		'ID_TRAM'
	];

	public function tbl_tram()
	{
		return $this->belongsTo(\App\Models\TblTram::class, 'ID_TRAM');
	}


}
