<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jul 2019 02:03:52 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TblDaivt
 * 
 * @property int $ID_DAI
 * @property string $MA_DAIVT
 * @property string $TEN_DAIVT
 * @property string $DIA_CHI
 * @property string $SO_DT
 * @property int $ID_DONVI
 * 
 * @property \App\Models\TblDonvi $tbl_donvi
 * @property \Illuminate\Database\Eloquent\Collection $tbl_nhanviens
 * @property \Illuminate\Database\Eloquent\Collection $tbl_pis
 *
 * @package App\Models
 */
class TblDaivt extends Eloquent
{
	protected $table = 'tbl_tram';
	protected $primaryKey = 'ID_TRAM';
	public $timestamps = false;

	protected $casts = [
		'ID_DAI' => 'int'
	];

	protected $fillable = [
		'ID_TRAM',
		'TEN_TRAM',
		'MA_TRAM',
		'DIA_CHI',
		'SO_DT',
		'ID_DAI'
	];

	public function tbl_dai()
	{
		return $this->belongsTo(\App\Models\TblDai::class, 'ID_DAI');
	}

	public function tbl_nhanviens()
	{
		return $this->hasMany(\App\Models\TblThietbi::class, 'ID_TRAM');
	}

}
