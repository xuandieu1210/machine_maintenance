<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;;
// use App\Models\Excel as ExcelTable;
use  Maatwebsite\Excel\Facades\Excel;
use App\Imports\ListMachine;
use App\Models\TblThietbi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return $_POST;
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main(Request $request)
    {


        
        // $data = request()->all();
        // // Excel::load('file.xls', function($reader) {
        // //     // reader methods
        // // });

        
        // $a= Excel::import(new  ExcelTable, $_FILES['filexls']['tmp_name']);
        // dd ($a);
        // //dd($_FILES['filexls']['tmp_name']);
        // //return view('home');


        // $a= Excel::imports('4-g')->load();
        // dd($a);

        // $rows = Excel::toCollection(new ListMachine,  $_FILES['filexls']['tmp_name']);
        // dd($rows);
        $file = $request->file('filexls');

        $path = $request->file('filexls')->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

//dd($highestRow);
$a = [];
for ($row = 2; $row <= $highestRow; ++$row) {
    $a[$row] = [];
    for ($col = 1; $col <= $highestColumnIndex; ++$col) {
        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
        array_push ($a[$row], $value);
    
    }
    
}


 
 foreach ($a as $key => $value) {
    $b = DB::table('tbl_thietbi')->where('MA_THIETBI', $value[4])->get();
    if (count($b) != 0) {
        $insert = [
            ''
        ];

    } else {
        dd(2);
    }
 }

echo '<table>' . PHP_EOL;
foreach ($worksheet->getRowIterator() as $row) {
    echo '<tr>' . PHP_EOL;
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                                                       //    even if a cell value is not set.
                                                       // By default, only cells that have a value
                                                       //    set will be iterated.
    foreach ($cellIterator as $cell) {
        echo '<td>' .
             $cell->getValue() .
             '</td>' . PHP_EOL;
    }
    echo '</tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL; die;
// Set details for the formula that we want to evaluate, together with any data on which it depends

            dd($cellValue);
        // $s = $spreadsheet->getSheetByName('4-g');

        // echo $s->getCell('A1')->getValue(); die;
        // dd($spreadsheet);
        // $data = Excel::import($path)->get();

        // dd($data);
        // //dd ($file->getRealPath());
        // Excel::import($file->getRealPath(), function ($reader) {
        //     return response()->json($reader);
        // });
        
        // $excel = new Excel();
        // $excel->import($_FILES['filexls']['tmp_name'], function (Reader $reader) {
        //     $reader->sheets(function (Sheet $sheet) {
        //         $sheet->rows(function (Row $row) {
        
        //             // Get a column
        //             $row->column('heading_key');
        
        //             // Magic get
        //             $row->heading_key;
        
        //             // Array access
        //             $row['heading_key'];
        //         });
        //     });
        // });
        // dd($rows);
    }
}
