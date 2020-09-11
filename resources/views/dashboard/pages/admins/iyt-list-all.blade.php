@extends('dashboard.layout')

@section('title', 'List of IYT Participants')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">List of IYT Participants</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-IYT</li>
            <li class="breadcrumb-item active">List of IYT Participants</li>
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
                    <h3 class="card-title">List of IYT Participants Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>Nama Ketua</th>
                            <th>Nama Kelompok</th>
                            
                            <th>Batch</th>
                            <th>Proposal Bisnis</th>
                            <th>Pitch Desk</th>
                            <th>Other Detail</th>
                            <th>Listed at</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($iyts as $iyt)
                            <tr>
                                <td>{{ $iyt->nama_ketua }}</td>
                                <td>{{ $iyt->nama_kelompok }}</td>
                                @php
                                    $batch=App\IYTBatch::where('id',$iyt->batch_id)->get()->first();
                                    // dd($batch);
                                @endphp
                                <td>{{ $batch->batch }}-{{$batch->IYTname}}</td>
                                <td>
                                    <form action="{{ route('iyt.proposalbisnis.download', $iyt->id) }}" method="get">
                                      <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('iyt.pitchdesk.download', $iyt->id) }}" method="get">
                                      <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                    </form>
                                </td>
                                <td>

                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $iyt->id }}">
                                        Other Details
                                    </button>
                                    <div class="modal fade" id="modal-{{ $iyt->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">IYT Other Details</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Email Mahasiswa</td>
                                                        <td>: {{ $iyt->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun masuk/lulus</td>
                                                        <td>: {{ $iyt->tahun_masuk }} / {{ $iyt->tahun_keluar }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kategori</td>
                                                        @if( $iyt->kategori == 'Senior')
                                                            <td class="second">: <span class="badge badge-warning"> {{ $iyt->kategori }} </span></td>
                                                        @else
                                                            <td class="second">: <span class="badge badge-primary"> {{ $iyt->kategori }} </span></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Semester</td>
                                                        <td>: {{ $iyt->semester }}</td>
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

                                <td>{{ $iyt->created_at }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="{{ route('iyt.approve', $iyt->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Lolos ke babak selanjutnya</button>
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
                        {{ $iyts->links() }}
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
