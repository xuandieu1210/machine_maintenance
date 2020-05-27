@extends('layouts.app')

@section('content')
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
                        <input class="btn btn-primary" type="submit" value="Xử lý">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
