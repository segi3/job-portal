@extends('dashboard.layout')

@section('title', 'List of Qualified Participants')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">List of Qualified Participants</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-IYT</li>
            <li class="breadcrumb-item active">List of Qualified Participants</li>
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
                    <h3 class="card-title">List of Qualified Participants Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>Nama Ketua</th>
                            <th>Nama Kelompok</th>
                            <th>Email mahasiswa</th>       
                            <th>Proposal Bisnis</th>
                            <th>Pitch Desk</th>
                            <th>Updated at</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($iyts as $iyt)
                            <tr>
                                <td>{{ $iyt->nama_ketua }}</td>
                                <td>{{ $iyt->nama_kelompok }}</td>
                                <td>{{ $iyt->email }}</td>
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
                                <td>{{ $iyt->updated_at }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="{{ route('iyt.reject', $iyt->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-danger mr-4">Gagal Lolos ke babak selanjutnya</button>
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
