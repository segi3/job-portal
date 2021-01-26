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

                        <a href="/investasi-fund" class="float-right card-link stretched-link btn btn-sm btn-yl">Halaman Investasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">ITS Youth Technopreneur</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="card-title">Apa itu IYT?</h6>

                                <p class="card-text">
                                    IYT merupakan kompetisi wirausaha berbasis teknologi tingkat ITS sekaligus program pengembangan usaha Mahasiswa. Mahasiswa ITS yang memiliki ide bisnis ataupun yang baru menjalankan bisnis selama 1 tahun dapat mengikuti kompetisi ini dan jika lolos akan memperoleh pendanaan, pendampingan, monitoring dan evaluasi. Program ini diselenggarakan oleh Subdirektorat Pengembangan Karir dan Kewirausahaan Mahasiswa (PK2M) Direktorat Kemahasiswaan ITS. Program ini dirancang untuk menumbuhkan bibit-bibit wirausahawan berbasis teknologi agar mahasiswa dapat menciptakan produk teknologi inovatif yang dapat berguna di masyarakat.
                                </p>

                                <a href="/its-youth-technopreneur" class="btn btn-primary">Halaman IYT</a>
                            </div>
                            @if ( $iyt != null )
                                <div class="col-lg-12" style="margin-top: 15px;">
                                    @if( $iyt->status_iyt == 0 )
                                    <span class="card-text spant-3"> Status akun : </span> <span class="badge badge-warning">Sudah terdaftar</span>
                                    @elseif( $iyt->status_iyt == 1)
                                    <span class="card-text spant-3"> Status akun : </span> <span class="badge badge-success">Lolos ke babak selanjutnya</span>
                                    <h6 class="card-text h6t-3">Jika tombol menuju dashboard IYT tidak muncul, silahkan relogin terlebih dahulu</span>
                                    @endif
                                </div>
                            @endif
                        </div>

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
