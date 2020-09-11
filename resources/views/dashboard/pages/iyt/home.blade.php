@extends('dashboard.layout')

@section('title', "Dashboard!")

@section('stylesheets')
<style>
table {
  width: 100%;
  table-layout: fixed;
}
.first {
  width: 10%;

}
.second {
  width: 30%;
}
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard IYT</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/IYT">Home</a></li>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Pengumuman ITS Youth Technopreneur</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="first">Nama Kelompok</td>
                                    <td class="second">: {{ $iyt->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Tahun</td>
                                    <td class="second">: {{ $year }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Nama Ketua</td>
                                    <td class="second">: {{ $iyt->nama_ketua }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Tahun Masuk/Lulus</td>
                                    <td class="second">: {{ $iyt->tahun_masuk }} / {{  $iyt->tahun_keluar }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Semester</td>
                                    <td class="second">: {{ $iyt->semester }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Kategori</td>
                                    @if( $iyt->kategori == 'Senior')
                                        <td class="second">: <span class="badge badge-warning"> {{ $iyt->kategori }} </span></td>
                                    @else
                                        <td class="second">: <span class="badge badge-primary"> {{ $iyt->kategori }} </span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="first">Proposal Bisnis</td>
                                    <td class="second">
                                        <a href="{{ route('iyt.proposalbisnis.download', $iyt->id) }}">
                                        <div style="height:100%;width:100%">
                                            : Download
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first">Pitch Desk</td>
                                    <td class="second">
                                        <a href="{{ route('iyt.pitchdesk.download', $iyt->id) }}">
                                        <div style="height:100%;width:100%">
                                            : Download
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
