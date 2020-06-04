@extends('dashboard.layout')

@section('title', 'New Seminars')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">New Seminars</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Seminars</li>
            <li class="breadcrumb-item active">New-Seminars</li>
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
                    <h3 class="card-title">New Seminar Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nama Seminar</th>
                            <th>Lokasi</th>
                            <th>Fee</th>
                            <th>Listed at</th>
                            <th>Detail</th>
                            <th>Berkas Bukti Sewa tempat</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($seminars as $seminar)
                            <tr>
                                <td>{{ $seminar->name }}</td>
                                <td>{{ $seminar->location }}</td>
                                <td>Rp {{ $seminar->fee }}</td>
                                <td>{{ $seminar->created_at }}</td>
                                <td>

                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $seminar->id }}">
                                        Details
                                    </button>
                                    <div class="modal fade" id="modal-{{ $seminar->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Seminar Details</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Nama seminar</td>
                                                        <td>{{ $seminar->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lokasi</td>
                                                        <td>{{ $seminar->location }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fee</td>
                                                        <td>Rp {{ $seminar->fee }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi</td>
                                                        <td>{{ $seminar->description }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact Person</td>
                                                        <td>{{ $seminar->contact_person }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact Number</td>
                                                        <td>{{ $seminar->contact_no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Listed at</td>
                                                        <td>{{ $seminar->created_at }}</td>
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
                                    <form action="{{ route('berkas.seminar.download', $seminar->id) }}" method="get">
                                      <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                    </form>
                                </td>

                                <td>
                                    <div class="row">
                                      <div class="col-lg-6">
                                          <form action="{{ route('seminar.approve', $seminar->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-success mr-4">approve</button>
                                          </form>
                                      </div>
                                      <div class="col-lg-6">
                                          <form action="{{ route('seminar.reject', $seminar->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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
                        {{ $seminars->links() }}
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
