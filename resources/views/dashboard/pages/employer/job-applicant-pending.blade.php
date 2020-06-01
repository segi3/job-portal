@extends('dashboard.layout')

@section('title', 'Job Applicants')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Job Applicant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Jobs</li>
            <li class="breadcrumb-item active">Jobs-Applicant</li>
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
                    <h3 class="card-title">Pending Applicants</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>                  
                            <tr>
                                <th>Nama mahasiwa</th>
                                <th>Nama Pekerjaan</th>
                                <th>Motivation letter</th>
                                <th>CV</th>
                                <th>Details</th>
                                <th>Listed at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($applicants_pending as $applicant)
                                <tr>
                                    <td>{{ $applicant->name }}</td>
                                    <td>{{ $applicant->jobname }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#motlet-{{ $applicant->id }}">
                                            Motlet
                                        </button>
                                        <div class="modal fade" id="motlet-{{ $applicant->id }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Detail mahasiswa</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        {{ $applicant->motlet }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                    <td>{{ $applicant->cv }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $applicant->id }}">
                                            Details
                                        </button>
                                        <div class="modal fade" id="modal-{{ $applicant->id }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Detail mahasiswa</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-borderless">
                                                    <tbody>
                                                      <tr>
                                                        <td>Nama mahasiswa</td>
                                                        <td>{{ $applicant->name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>NRP mahasiswa</td>
                                                        <td>{{ $applicant->nrp }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Email mahasiswa</td>
                                                        <td>{{ $applicant->email }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Nomor HP mahasiswa</td>
                                                        <td>{{ $applicant->mobile_no }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Skill</td>
                                                        <td>{{ $applicant->skill }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Penghargaan</td>
                                                        <td>{{ $applicant->achievment }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Pengalaman</td>
                                                        <td>{{ $applicant->experience }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $applicant->city }},  {{ $applicant->province }}</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                              </div>
                                              <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </td>
                                    <td>{{ $applicant->created_at }}</td>
                                    <td>
                                        <form action="{{ route('job-applicant.accept', $applicant->jsid) }}" method="post">
                                          {{ csrf_field() }}
                                          {{ method_field('put') }}
                                          <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Accept</button>
                                        </form>
                                        <form action="{{ route('job-applicant.reject', $applicant->jsid) }}" method="post">
                                          {{ csrf_field() }}
                                          {{ method_field('put') }}
                                          <button type="submit" class="btn btn-sm btn-block btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $applicants_pending->links() }}
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