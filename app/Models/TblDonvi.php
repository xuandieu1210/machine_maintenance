<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jul 2019 02:03:52 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDonvi
 * 
 * @property int $ID_DONVI
 * @property string $MA_DONVI
 * @property string $TEN_DONVI
 * @property string $DIA_CHI
 * @property string $SO_DT
 * @property int $CAP_TREN
 * 
 * @property \App\Models\TblDonvi $tbl_donvi
 * @property \Illuminate\Database\Eloquent\Collection $tbl_daivts
 * @property \Illuminate\Database\Eloquent\Collection $tbl_donvis
 * @property \Illuminate\Database\Eloquent\Collection $tbl_nhanviens
 *
 * @package App\Models
 */
class TblDonvi extends Eloquent
{
	protected $table = 'tbl_donvi';
	protected $primaryKey = 'ID_DONVI';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_DONVI' => 'int',
	];

	protected $fillable = [
		'ID_DONVI',
		'TEN_DONVI',
		'MA_DONVI',
		'DIA_CHI',
		'SO_DT',
	];


	public function tbl_daivts()
	{
		return $this->hasMany(\App\Models\TblDaivt::class, 'ID_DONVI');
	}

}
