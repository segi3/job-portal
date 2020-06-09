@extends('dashboard.layout')

@section('title', 'Jobs Approval')

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
            <li class="breadcrumb-item active">Jobs-approval</li>
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
                        <table class="table table-responsive-sm table-bordered">
                            <thead>
                            <tr>
                                <th>Job Name</th>
                                <th>Job type</th>
                                <th>Job Location</th>
                                <th>Details</th>
                                <th>Last Updated</th>
                                <th style="width: 154px">Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->job_type }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>{{ $job->updated_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $job->id }}">
                                            Details
                                        </button>
                                        <div class="modal fade" id="modal-{{ $job->id }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Job Details</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-borderless">
                                                    <tbody>
                                                      <tr>
                                                        <td>Job Name</td>
                                                        <td>{{ $job->name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Job Type</td>
                                                        <td>{{ $job->job_type }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Job Position</td>
                                                        <td>{{ $job->position }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Category</td>
                                                        <td>{{ $job->category_name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Location</td>
                                                        <td>{{ $job->location }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Description</td>
                                                        <td>{{ $job->description }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Required Skill</td>
                                                        <td>{{ $job->required_skill }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Minimal Qualification</td>
                                                        <td>{{ $job->minimal_qualification }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Extra Skill</td>
                                                        <td>{{ $job->extra_skill }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Expected Salary</td>
                                                        <td>{{ number_format($job->expected_salary_high, 0, ',', '.') }} - {{ number_format($job->expected_salary_low, 0, ',', '.') }}</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                          </div>
                                          <!-- /.modal -->
                                    </td>
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
