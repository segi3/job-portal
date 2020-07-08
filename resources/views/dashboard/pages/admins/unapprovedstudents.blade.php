@extends('dashboard.layout')

@section('title', 'Unapproved Student')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Unapproved Students</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Students</li>
            <li class="breadcrumb-item active">Unapproved-Students</li>
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
                    <h3 class="card-title">Unapproved Students Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Email</th>
                            <th>Detail</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->name}}</td>
                                <td>{{ $student->nrp }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $student->id }}">
                                        Details
                                    </button>
                                    <div class="modal fade" id="modal-{{ $student->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Student Details</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>{{ $student->gender}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>{{ $student->birthdate}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $student->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>
                                                        <td>{{ $student->city}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provinsi</td>
                                                        <td>{{ $student->province}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No HP</td>
                                                        <td>{{ $student->mobile_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hobi</td>
                                                        <td>{{ $student->hobby}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Skill</td>
                                                        <td>{{ $student->skill}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prestasi</td>
                                                        <td>{{ $student->achievment}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pengalaman</td>
                                                        <td>{{ $student->experience}}</td>
                                                    </tr>
                                                   
                                                    <!-- <tr>
                                                        <td>Updated at</td>
                                                        <td>{{ $student->updated_at }}</td>
                                                      </tr> -->
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
                                          <form action="{{ route('student.approve', $student->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-success mr-4">Approve</button>
                                          </form>
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
                        {{ $students->links() }}
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
