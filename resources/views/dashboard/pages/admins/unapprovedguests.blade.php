@extends('dashboard.layout')

@section('title', 'Unapproved Employers')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Unapproved Guest</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Guests</li>
            <li class="breadcrumb-item active">Unapproved-Guests</li>
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
                    <h3 class="card-title">Unapproved Guest Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Pekerjaan</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Berkas</th>
                                    <th>Last Update</th>
                                    <th style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($guests as $g)
                                <tr>
                                    <td>{{ $g->name }}</td>
                                    <td>{{ $g->pekerjaan }}</td>
                                    <td>{{ $g->email }}</td>
                                    <td>{{ $g->mobile_no }}</td>
                                    <td>
                                        {{-- <form action="{{ route('berkas.download', str_replace(' ','_',$g->name).md5($g->$email)) }}" method="get"> --}}
                                        <form action="{{ route('berkas.download', $g->id) }}" method="get">
                                          <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                        </form>
                                    </td>
                                    <td>{{ $g->updated_at }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action="{{ route('guest.approve', $g->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Approve</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <form action="{{ route('guest.delete', $g->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-sm btn-block btn-danger">Delete</button>
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
                        {{ $guests->links() }}
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
