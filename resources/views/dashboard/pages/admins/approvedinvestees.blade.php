@extends('dashboard.layout')

@section('title', 'Approved Investee')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Approved Investees</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Investees</li>
            <li class="breadcrumb-item active">Approved-Investees</li>
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
                    <h3 class="card-title">Approved Investees Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th>Nama Startup</th>
                            <th>Nama Mahasiswa</th>
                            <th>Email</th>
                            <th>Detail</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($investees as $investee)
                            <tr>
                                <td>{{ $investee->nama}}</td>
                                <td>{{ $investee->nama_mhs }}</td>
                                <td>{{ $investee->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $investee->id }}">
                                        Details
                                    </button>
                                    <div class="modal fade" id="modal-{{ $investee->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title">Investee Details</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                        <td>Alamat</td>
                                                        <td>{{ $investee->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kota</td>
                                                        <td>{{ $investee->city}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Province</td>
                                                        <td>{{ $investee->province}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fax</td>
                                                        <td>{{ $investee->fax}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>CP</td>
                                                        <td>{{ $investee->contact_person}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No HP</td>
                                                        <td>{{ $investee->contact_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Updated at</td>
                                                        <td>{{ $investee->updated_at }}</td>
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
                                          <form action="{{ route('investee.reject', $investee->id) }}" method="post">
                                              {{ csrf_field() }}
                                              {{ method_field('put') }}
                                              <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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
                        {{ $investees->links() }}
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
