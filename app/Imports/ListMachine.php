<?php


namespace App\Imports;

use App\Models\ListMachineModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ListMachine implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new ListMachineModel([
           'STT'     => $row[0],
           'TT'    => $row[1],
        ]);
    }
}