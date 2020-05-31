@extends('dashboard.layout')

@section('title', 'New Jobs')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">New Jobs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Jobs</li>
            <li class="breadcrumb-item active">New-Jobs</li>
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
                    <h3 class="card-title">New Job Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>                  
                            <tr>
                                <th>Job Name</th>
                                <th>Job Employer</th>
                                <th>Job type</th>
                                <th>Job Location</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->employer_name }}</td>
                                    <td>{{ $job->job_type }}</td>
                                    <td>{{ $job->location }}</td>
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
                                                        <td>Submitted by</td>
                                                        <td>{{ $job->employer_name }}</td>
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
                                                        <td>{{ $job->expected_salary }}</td>
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
                                            <form action="{{ route('job.approve', $job->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-success mr-4">approve</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-6">
                                            <form action="{{ route('job.reject', $job->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-block btn-danger">Reject</button>
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