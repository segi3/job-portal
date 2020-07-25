@extends('dashboard.layout')

@section('title', 'On-Going Project List')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">On-Going Project List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Investasi</li>
            <li class="breadcrumb-item active">On-Going Project List</li>
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
                    <h3 class="card-title">On-Going Project List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                            <tr>
                                <th>Nama Investasi</th>
                                <th>Nama Investee</th>
                                <th>Lembar Terbeli</th>
                                <th>Total Harga</th>
                                <th style="width: 87px">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($investment as $inv)
                            <tr>
                                <td>{{ $inv->nama_investasi }}</td>
                                <td>{{ $inv->nama_investee }}</td>
                                <td>{{ $inv->lembar_beli }}</td>
                                <td>{{ $inv->total_harga }}</td>
                                <td>
                                    <a class="tn btn-sm btn-block btn-info" href="{{ url('/dashboard/st/detail-investment/'.$inv->investasi_id) }}" role="button">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investment->links() }}
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