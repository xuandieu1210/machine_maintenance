

@extends('layouts.app')

@section('content')

@if(Session::has('message'))
<p class="alert alert-danger {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="md-form" action="{{ url('main') }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field()}}
                        <div class="file-field">
                            <a class="btn-floating purple-gradient mt-0 float-left">
                            <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
                            <input type="file" name="filexls">
                            </a>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Import dữ liệu tháng" id = "smbt">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<h2 style="text-align:center">DANH SÁCH MÁY NỔ CẦN THAY NHỚT</h2>
<br>
<input class="btn btn-primary" id="update" type="button" value="Cập nhật đã thay nhớt">
<br><br>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                <th> ID</th>
                <th>MÃ MÁY NỔ</th>
                <th>TÊN MÁY NỔ</th>
                <th>LOẠI MÁY</th>
                <th>HÃNG</th>
                <th>TRẠM</th>
                <th>DUNG TÍCH BÌNH NHỚT</th>
                <th>THỜI GIAN THAY NHỚT GẦN NHẤT</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#users-table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        buttons: [
            {
            extend: 'excelHtml5',
            className: 'btn btn-info',
            "text": "Xuất Excel",
            exportOptions: {
              columns: ':visible'
            }
          }
        ],
        ajax: '{!! route('thietbi.getData') !!}',
        columns: [
                    { "data":"checkbox", orderable:false, searchable:false},
 
                    {
                        data: "ID_THIETBI",
                        searchable: false,
                        orderable: false,
                        className: "dt"
                    },
                    { data: 'MA_THIETBI', name: 'MA_THIETBI' },
                    { data: 'TEN_THIETBI', name: 'TEN_THIETBI' },
                    { data: 'LOAI_MAY', name: 'LOAI_MAY' },
                    { data: 'HANG', name: 'HANG',
                       
                    },
                    { data: 'TEN_TRAM', name: 'TEN_TRAM' },
                    { data: 'DUNG_TICH_BINH_NHOT', name: 'DUNG_TICH_BINH_NHOT' },
                    { data: 'THOI_GIAN_THAY_NHOT', name: 'THOI_GIAN_THAY_NHOT'},
                       
                    
                ],

    });

          

    var list = [];


    $('#example-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = table.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        console.log(rows);
    });


    $('#users-table').on('change', '.checkbox', function(){
    // If checkbox is not checked
    if(!this.checked){
        var el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
        }
    }
    });

    $('#update').on('click', function(e){
        var id = [];
        if(confirm("Bạn có muốn cập nhật đã thay nhớt cho các máy nổ đã chọn"))
        {
            $('.student_checkbox:checked').each(function(){
                id.push($(this).val());
            });
            if(id.length > 0)
            {
                $.ajax({
                    url:"{{ route('update')}}",
                    method:"get",
                    data:{listID:id},
                    success:function(data)
                    {
                        alert(data);
                        $('#users-table').DataTable().ajax.reload();
                    }
                });
            }
            else
            {
                alert("XIn chọn ít nhất 1 máy nổ");
            }
        }
    });
});


</script>
@endpush