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
                <h1 class="m-0 text-dark">Dashboard Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <div class="card menu-card">
                    <div class="card-body">
                        <h5 class="card-title">Cari pekerjaan</h5><br><br>

                        <a href="/jobs" class="float-right card-link stretched-link btn btn-sm btn-yl">Halaman job</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card menu-card">
                    <div class="card-body">
                        <h5 class="card-title">Buat Jasa</h5><br><br>

                        <a href="/dashboard/st/create-service" class="float-right card-link stretched-link btn btn-sm btn-yl">Halaman jasa</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card menu-card">
                    <div class="card-body">
                        <h5 class="card-title">Jadi investor</h5><br><br>

                        <a href="/dashboard/st/create-service" class="float-right card-link stretched-link btn btn-sm btn-yl">Halaman Investasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- <script>
    $(".menu-card").hover(function(){
        var imgurl = $(this).data("hoverimage");
        $(this).css("background-image", "url(" + imgurl + ")");
    }, function(){
        $(this).css("background-image", "");
    });
</script> --}}
@endsection
