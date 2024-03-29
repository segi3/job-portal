@extends('dashboard.layout')

@section('title', 'New Project Investment')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">New Project Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Project-Investment</li>
            <li class="breadcrumb-item active">New-Project-Investment</li>
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
                    <h3 class="card-title">New Project Investment Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>Nama Investasi</th>
                            <th>Nama Employer</th>
                            <th>Berkas Proposal Investasi</th>
                            <th>Berkas Laporan Keuangan</th>
                            <th>Listed at</th>
                            <th>Detail</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($investasi as $invest)
                            <tr>
                                <td>{{ $invest->nama_investasi }}</td>
                                <td>{{ $invest->employername }}</td>
                                <td>
                                    <form action="{{ route('proposal.investasi.download', $invest->id) }}" method="get">
                                      <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('laporan.investasi.download', $invest->id) }}" method="get">
                                      <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                    </form>
                                </td>
                                <td>{{ $invest->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $invest->id }}">
                                        Details
                                    </button>
                                    <div class="modal fade" id="modal-{{ $invest->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Investasi Details</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Deskripsi Bisnis</td>
                                                        <td>{{ $invest->deskripsi_bisnis}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Harga Saham</td>
                                                        <td>Rp. {{ $invest->harga_saham}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tangga jatuh Tempo</td>
                                                        <td>{{ $invest->tgl_jatuh_tempo}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ROI Top</td>
                                                        <td>{{ $invest->roi_top}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ROI Bottom</td>
                                                        <td>{{ $invest->roi_bot}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lembar total</td>
                                                        <td>{{ $invest->lembar_total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lembar terbeli</td>
                                                        <td>{{ $invest->lembar_terbeli}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bank</td>
                                                        <td>{{ $invest->bank}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Rekening</td>
                                                        <td>{{ $invest->no_rekening}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact Person</td>
                                                        <td>{{ $invest->cp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Listed at</td>
                                                        <td>{{ $invest->created_at }}</td>
                                                      </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                            </div>
                                          </div>
                                          <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                      </div>
                                      <!-- /.modal -->
                                </td>
                                <td>
                                    <div class="row">
                                      <div class="col-lg-6">
                                          <form action="{{ route('investment.approve', $invest->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-success mr-4">Approve</button>
                                          </form>
                                      </div>
                                      <div class="col-lg-6">
                                          <form action="{{ route('investment.reject', $invest->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                          </form>
                                      </div>
                                  </div>
                                  </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investasi->links() }}
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
    {{--  --}}
@endsection
