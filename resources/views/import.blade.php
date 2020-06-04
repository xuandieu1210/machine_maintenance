
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
                        <input class="btn btn-primary" type="submit" value="Xử lý" id = "smbt">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th> ID</th>
                <th>MÃ MÁY NỔ</th>
                <th>TÊN MÁY NỔ</th>
                <th>LOẠI MÁY</th>
                <th>HÃNG</th>
                <th>TRẠM</th>
                <th>DUNG TÍCH BÌNH NHỚT</th>
                <th>THỜI GIAN THAY NHỚT GẦN NHẤT</th>
                <th></th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {


    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('thietbi.getData') !!}',
        columns: [
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

          






        });
</script>
@endpush