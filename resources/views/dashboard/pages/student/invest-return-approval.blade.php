@extends('dashboard.layout')

@section('title', 'Invest-Return Approval')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Invest-Return Approval</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Invest</li>
            <li class="breadcrumb-item active">Invest-Return Approval</li>
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
                                <th>Nama Investasi</th>
                                <th>Nama Employer</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th style="width: 154px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($invests as $invest)
                                <tr>
                                    <td>{{ $invest->nama_investasi }}</td>
                                    <td>{{ $invest->employername }}</td>
                                    <td>{{ $invest->tgl_jatuh_tempo }}</td>
                                    <td>
                                        <form action="{{ route('invest-return.confirm', $invest->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button type="submit" class="btn btn-sm btn-block btn-danger">Confirm</button>
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
                        {{ $invests->links() }}
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