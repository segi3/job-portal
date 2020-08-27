@extends('dashboard.layout')

@section('title', "Dashboard!")

@section('stylesheets')
{{--  --}}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0 text-dark">Welcome {{ session('name') }}.</h1> --}}
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Welcome</li>
            </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Kelompok anda sudah terdaftar dalam ITS Youth Technopreneur</strong></h5>

                        <p class="card-text pt-3">
                            Silahkan menunggu untuk mengetahui pengumuman kelolosan babak selanjutnya.
                        </p>
                        
                        @if( $iyt->status == 0 )
                            <span class="card-text spant-3"> Status akun : </span> <span class="badge badge-warning">Sudah terdaftar</span>
                        @elseif( $iyt->status == 1)
                        <span class="card-text spant-3"> Status akun : </span> <span class="badge badge-success">Lolos ke babak selanjutnya</span>
                        <h6 class="card-text h6t-3">Silahkan relogin untuk menuju dashboard IYT</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{--  --}}
@endsection
