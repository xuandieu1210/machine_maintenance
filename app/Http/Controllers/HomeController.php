<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;;
// use App\Models\Excel as ExcelTable;
use  Maatwebsite\Excel\Facades\Excel;
use App\Imports\ListMachine;
use App\Models\TblThietbi;
use App\Models\BaoCaoHangThang;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;

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
        // $danhsach = DB::table('tbl_thietbi')
        // ->leftJoin('tbl_tram', 'tbl_tram.ID_TRAM', '=', 'tbl_thietbi.ID_TRAM')
        // ->select('tbl_thietbi.*', 'tbl_TRAM.*')
        // ->get();

        // //dd($danhsach);

        // $listHETNhot = [];

        // foreach ($danhsach as $thietbi ) {
        //     if ( $thietbi->NHOT_TIEU_HAO >= $thietbi->DUNG_TICH_BINH_NHOT || time() > strtotime($thietbi->THOI_GIAN_THAY_NHOT . ' +6 months')  ) {
        //         array_push( $listHETNhot, $thietbi);
        //     }

        // }


        return view('home');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main(Request $request)
    {


        $file = $request->file('filexls');
        if ($file == null) {
            return redirect('/');
        } else {
            $path = $request->file('filexls')->getRealPath();
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            $reader->setLoadAllSheets();
            $spreadsheet = $reader->load($file);
            $allSheet = $spreadsheet->getSheetNames();
            
            for ($i =0; $i < count($allSheet); $i ++) {
                $a = [];
                $worksheet = $spreadsheet->getSheetByName($allSheet[$i]);
    
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
                $dataIndex = 2;
                
                for ($row = 1; $row <= $highestRow; ++$row) {
                    
                    for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                        if ($value == 'STT') {
                            $dataIndex = $row +1;
                        }
                        
                    
                    }     
                }
                for ($row = $dataIndex; $row <= $highestRow; ++$row) {
                    
                    $a[$row] = [];
                    for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                        array_push ($a[$row], $value);
                    
                    }
                    
                }
                
    
                foreach ($a as $key => $value) {
                    $thietbi = DB::table('tbl_thietbi')->where('MA_THIETBI', $value[4])->get();
                    
    
                    if (count($thietbi) != 0) {
                        $insert = [
                            'TT' =>  $value[1],
                            'MUC_CB' =>  $value[2],
                            'ID_THIETBI'=>$thietbi[0]->ID_THIETBI,
                            'Object100' => $value[6],
                            'NGUYEN_NHAN'=>$value[7],
                            'THOI_GIAN_SU_CO'=> date('Y-m-d H:i:s',strtotime(str_replace('/', '-',$value[9] ) )),
                            'THOI_GIAN_CLR'=>date('Y-m-d H:i:s',strtotime(str_replace('/', '-',$value[10] ) )),
                            'THOI_GIAN_CB'=>$value[11],
                            'TRANG_THAI_CLR'=>$value[12],
                            'MA_CB'=>$value[13],
                            'CHI_TIET_CANH_BAO'=>$value[14],
                            'VNP_GHI_CHU'=>$value[16],
                            'TINH_GHI_CHU'=>$value[17],	
                            'LOAI_SU_CO'=>$value[19],
                            'THOI_GIAN_CANH_BAO_AC'=>$value[19],
                            'THANG'=>date('Y-m-01',strtotime(str_replace('/', '-',$value[9] ) )),
                        ];
                        try { 
                            DB::table('bao_cao_hang_thang')->insert([
                                $insert
                            ]);
                        } catch(\Illuminate\Database\QueryException $ex){ 
                            Session::flash('message', 'Lỗi import file hoặc file đã được import'); 
                            return redirect('/');
                            // Note any method of class PDOException can be called on $ex.
                        }
                        $luongDau = $thietbi[0]->DINH_MUC_DAU * $value[11]/60;
                        $luongNhot = $luongDau*$thietbi[0]->DINH_MUC_NHOT/100;
    
                        DB::table('tbl_thietbi')
                        ->where('ID_THIETBI', $thietbi[0]->ID_THIETBI)
                        ->update(['NHOT_TIEU_HAO' => $luongNhot + $thietbi[0]->NHOT_TIEU_HAO]);
                    } 
                }
            }
            
    
     
                
    
    
                // $danhsach = DB::table('tbl_thietbi')
                // ->leftJoin(DB::raw("(SELECT bao_cao_hang_thang.*, SUM(bao_cao_hang_thang.THOI_GIAN_CB) as total FROM 
                // bao_cao_hang_thang
                // WHERE bao_cao_hang_thang.THANG = (Select max(THANG) from bao_cao_hang_thang)
                // GROUP BY bao_cao_hang_thang.ID_THIETBI
                // ) as items"),function($join){
                //     $join->on("items.ID_THIETBI","=","tbl_thietbi.ID_THIETBI");
                //  })
                //  ->leftJoin('tbl_tram', 'tbl_tram.ID_TRAM', '=', 'tbl_thietbi.ID_TRAM')
                // ->select('tbl_thietbi.*', 'tbl_TRAM.*', 'items.*')
                // ->get();
    
                $danhsach = DB::table('tbl_thietbi')
                ->leftJoin('tbl_tram', 'tbl_tram.ID_TRAM', '=', 'tbl_thietbi.ID_TRAM')
                ->select('tbl_thietbi.*', 'tbl_TRAM.*')
                ->get();
    
                //dd($danhsach);
    
                $listHETNhot = [];
    
                foreach ($danhsach as $thietbi ) {
                    if ( $thietbi->NHOT_TIEU_HAO >= $thietbi->DUNG_TICH_BINH_NHOT || time() > strtotime($thietbi->THOI_GIAN_THAY_NHOT . ' +6 months')  ) {
                        array_push( $listHETNhot, $thietbi);
                    }
    
                }
    
                return redirect('/import');
        }
  
    }

    public function getData()
    {
        $danhsach = DB::table('tbl_thietbi')
            ->leftJoin('tbl_tram', 'tbl_tram.ID_TRAM', '=', 'tbl_thietbi.ID_TRAM')
            ->select('tbl_thietbi.*', 'tbl_TRAM.*')
            ->get();

            //dd($danhsach);

            $listHETNhot = [];

            foreach ($danhsach as $thietbi ) {
                if ( $thietbi->NHOT_TIEU_HAO >= $thietbi->DUNG_TICH_BINH_NHOT || time() > strtotime($thietbi->THOI_GIAN_THAY_NHOT . ' +6 months')  ) {
                    array_push( $listHETNhot, $thietbi);
                }

            }
    
        return Datatables::of( $listHETNhot)
        ->addColumn('checkbox', '<input type="checkbox" name="student_checkbox[]" class="student_checkbox" value="{{$ID_THIETBI}}" />')
        ->rawColumns(['checkbox'])
        ->make(true);
    }

    public function import() {
        return view('import');
    }

    public function updateThietBi(Request $request) {

        $update = [ 'NHOT_TIEU_HAO' => 0,'THOI_GIAN_THAY_NHOT' => date("Y-m-d")];
        DB::table('tbl_thietbi')->whereIn('ID_THIETBI', $request->listID)->update($update);
        return "Thành công";
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ]);
    }
}
