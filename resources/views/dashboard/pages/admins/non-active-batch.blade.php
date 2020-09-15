@extends('dashboard.layout')

@section('title', 'Non Active Batches')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Non-Active Batches</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-IYT</li>
            <li class="breadcrumb-item active">Non-Active-Batches</li>
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
                    <h3 class="card-title">Active Batch Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                        <tr>
                            <th>IYT Name</th>
                            <th>Batch</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($batches as $batch)
                            <tr>
                                <td>{{ $batch->IYTname }}</td>
                                <td>{{ $batch->batch }}</td>
                                <td>{{ $batch->start_date }}</td>
                                <td>{{ $batch->end_date }}</td>
                                <td>
                                    <form action="{{ route('batch.active', $batch->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <button type="submit" class="btn btn-sm btn-success"> Change to Active</button>
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
                        {{ $batches->links() }}
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