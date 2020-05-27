<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Jul 2019 02:03:52 +0000.
 */

namespace App\Models;


class ListMachineModel 
{
	protected $table = 'excel';
	public $timestamps = false;


	protected $fillable = [
		'STT',
		'TT'
	];

}
