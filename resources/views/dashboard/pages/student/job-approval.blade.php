@extends('dashboard.layout')

@section('title', 'Job Approval')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Job Approval</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Jobs</li>
            <li class="breadcrumb-item active">Jobs-Approval</li>
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
                                <th>Job name</th>
                                <th>Employer</th>
                                <th>Email</th>
                                <th>Last Updated</th>
                                <th style="width: 154px">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->jobname }}</td>
                                    <td>{{ $job->empname }}</td>
                                    <td>{{ $job->email }}</td>
                                    <td>{{ $job->updated_at }}</td>
                                    <td>
                                    @if ($job->status == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($job->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($job->status == 2)
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
                        {{ $jobs->links() }}
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