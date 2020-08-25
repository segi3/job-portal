@extends('dashboard.layout')

@section('title', 'Detail Project Investment')

@section('stylesheets')
{{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail Project Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard/investee">Home</a></li>
            <li class="breadcrumb-item active">Investasi</li>
            <li class="breadcrumb-item active">Detail Project Investment</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Investment Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td>Nama Investasi</td>
                                    <td>: {{ $investment->nama_investasi }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Investee</td>
                                    <td>: {{ $investee->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Email Investee</td>
                                    <td>: {{ $investee->email }}</td>
                                </tr>
                                <tr>
                                    <td>CP Investee</td>
                                    <td>: {{ $investee->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td>No Telpon Investee</td>
                                    <td>: {{ $investee->contact_no }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Bisnis</td>
                                    <td>: {{ $investment->deskripsi_bisnis }}</td>
                                </tr>
                                <tr>
                                    <td>Harga saham</td>
                                    <td>: Rp {{ number_format($investment->harga_saham, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td>: {{ $investment->tgl_jatuh_tempo }}</td>
                                </tr>
                                <tr>
                                    <td>ROI</td>
                                    <td>: {{ $investment->roi_bot }}% - {{ $investment->roi_top }}% </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Progress Project List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @foreach($listprogres as $list)
                    <ul class="list-group">
                        <li class="list-group-item" data-toggle="modal" data-target="#modal-{{ $list->id }}">{{ $list->deskripsi_laporan }} ({{ $list->tgl }})</li>
                            <div class="modal fade" id="modal-{{ $list->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Progress Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>: {{ $list->tgl }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi Laporan</td>
                                                        <td>: {{ $list->deskripsi_laporan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan tambahan</td>
                                                        <td>: {{ $list->keterangan_tambahan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berkas Laporan</td>
                                                        <td>
                                                            <form action="{{ route('dashboard.student.download-progress', $list->id) }}" method="get">
                                                                <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                          <!-- /.modal-content -->
                                </div>
                                        <!-- /.modal-dialog -->
                            </div>
                              <!-- /.modal -->
                    </ul>
                    @endforeach
                    </div>
                    <!-- card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $listprogres->links() }}
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
</section>
@endsection

@section('scripts')

@endsection