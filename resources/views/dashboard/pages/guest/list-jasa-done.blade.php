@extends('dashboard.layout')

@section('title', 'Service Approval')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Service Done</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Services-Approval</li>
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
                    <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Nama jasa</th>
                                <th>Nama mahasiswa</th>
                                <th>Last Updated</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 150px;">Status Pekerjaan</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->stdname }}</td>
                                    <td>{{ $service->servname }}</td>
                                    <td>{{ $service->updated_at }}</td>
                                    <td>
                                    @if ($service->status == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($service->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($service->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($service->status == 1)
                                            @if ($service->status_pekerjaan == 0)
                                                <span class="badge bg-warning">Belum Selesai</span>
                                            @elseif ($service->status_pekerjaan == 1)
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        @else
                                            <span class="badge bg-warning">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($service->status_pekerjaan == 0)
                                            <form action="{{ route('service.done', $service->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Selesai</button>
                                            </form>
                                        @elseif ($service->status_pekerjaan == 1)
                                            <form action="{{ route('service.notdone', $service->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-danger mr-4">Batal</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $services->links() }}
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
