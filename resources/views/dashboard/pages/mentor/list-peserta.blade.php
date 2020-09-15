@extends('dashboard.layout')

@section('title', 'List Peserta IYT')

@section('stylesheets')

@endsection

{{-- main content --}}
@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">List-Peserta</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Mentor</li>
            <li class="breadcrumb-item active">List Peserta</li>
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
                    <h3 class="card-title">Tabel List Peserta</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Nama Kelompok</th>
                                <th>Nama Ketua</th>
                                <th>Tingkat</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($iyts as $iyt)
                                <tr>
                                    
                                    <td>{{ $iyt->nama_kelompok }}</td>
                                    <td>{{ $iyt->nama_ketua }}</td>
                                    @if( $iyt->kategori == 'Senior')
                                        <td><span class="badge badge-warning"> {{ $iyt->kategori }} </span></td>
                                    @else
                                        <td><span class="badge badge-primary"> {{ $iyt->kategori }} </span></td>
                                    @endif
                                    <td>
                                        <a href="{{ url('mentor/list-peserta-IYT/detail/'.$iyt->id) }}">Halaman Detail</a>
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
