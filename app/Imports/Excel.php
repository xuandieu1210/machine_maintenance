<?php

namespace App\Imports;

use App\Models\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class UsersImport implements WithMappedCells, ToModel 
{
    public function mapping(): array
    {
        return [
            'STT'     => 'A2',
            'TT'    => 'B2',
            'Muc_cb'     => 'C2',
            'Loai_ne'    => 'D2',
        ];
    }

    /**
     * @param array $row
     *
     * @return Excel|null
     */
    public function model(array $row)
    {
        return new Excel([
           'STT'     => $row['STT'],
		   'TT'    =>$row['TT'],
		   'Muc_cb'     => $row['Muc_cb'],
           'Loai_ne'    =>$row['Loai_ne'],
        ]);
    }
}