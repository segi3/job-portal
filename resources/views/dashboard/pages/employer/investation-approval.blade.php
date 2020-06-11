@extends('dashboard.layout')

@section('title', 'Investation Approval')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Investation Approval</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Investation</li>
            <li class="breadcrumb-item active">Investation-approval</li>
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
                                <th>No Rekening</th>
                                <th>Description</th>
                                <th>ROI</th>
                                <th>jatuh Tempo</th>
                                <th>Updated at</th>
                                <th style="width: 154px">Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($investations as $investation)
                                <tr>
                                    <td>{{ $investation->no_rekening }} - {{ $investation->bank }}</td>
                                    <td>{{ $investation->deskripsi_bisnis }}</td>
                                    <td>{{ $investation->roi_bot }}% - {{ $investation->roi_top }}%</td>
                                    <td>{{ $investation->tgl_jatuh_tempo }}</td>
                                    <td>{{ $investation->updated_at }}</td>
                                    <td>
                                    @if ($investation->status == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($investation->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($investation->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
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
                        {{ $investations->links() }}
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
