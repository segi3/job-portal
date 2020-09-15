@extends('dashboard.layout')

@section('title', "Detail Peserta")

@section('stylesheets')
<style>
.table-kelompok {
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
                <h1 class="m-0 text-dark">Halaman {{ $iyt->nama_kelompok }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Mentor</li>
                    <li class="breadcrumb-item active">List-Peserta</li>
                    <li class="breadcrumb-item active">{{ $iyt->nama_kelompok }}</li>
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
                        <h5 class="m-0">Detail Kelompok</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-kelompok table-borderless">
                            <tbody>
                                <tr>
                                    <td class="first">Nama Kelompok</td>
                                    <td class="second">: {{ $iyt->nama_kelompok }}</td>
                                </tr>
                                <tr>
                                    <td class="first">Tahun</td>
                                    <td class="second">: 
                                        <?php $year = explode('-',$iyt->invoice_iyt); echo $year[0]; ?>
                                    </td>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Tabel Notulensi</h5>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Mentor</th>
                                <th>Judul</th>
                                <th>Dokumentasi</th>
                                <th>Komentar</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($mentorings as $mentoring)
                                <tr>       
                                    <td>{{ $mentoring->tgl_mentoring }}</td>
                                    <td>{{ $mentoring->name }}</td>
                                    <td>{{ $mentoring->judul }}</td>
                                    <td>
                                        @if (empty($mentoring->dokumentasi))
                                            Belum ada dokumentasi
                                        @else
                                            <form action="{{ route('iyt.mentoring.download.dokumentasi', $mentoring->mentoring_id) }}" method="get">
                                                {{ csrf_field() }}
                                                {{ method_field('get') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-link" style="border: 2px solid; border-radius: 40px;">Download</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-block btn-primary modalbtn1" style="border: 2px solid; border-radius: 40px;" data-toggle="modal" data-target="#modalone-{{ $mentoring->mentoring_id }}">
                                            Komentar
                                        </button>
                                        <div class="modal modal_mentor fade" id="modalone-{{ $mentoring->mentoring_id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Komentar Mentor</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{ $mentoring->komentar }}</p>
                                                    
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default closebtn1" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-sm btn-block btn-primary modalbtn2" style="border: 2px solid; border-radius: 40px;" data-toggle="modal" data-target="#modaltwo-{{ $mentoring->mentoring_id }}">
                                            Tambah Komentar
                                        </button>
                                        <div class="modal modal_mentor fade" id="modaltwo-{{ $mentoring->mentoring_id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Masukkan komentar</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" role="form" id="quickForm" action="">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="inputName">Komentar</label>
                                                        <textarea name="name" class="form-control" id="inputKomentar" placeholder="Komentar">
                                                    </div>
                                                </form>
                                                    
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-default closebtn2" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $mentorings->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
