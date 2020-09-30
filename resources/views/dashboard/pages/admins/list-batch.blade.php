@extends('dashboard.layout')

@section('title', 'List Batches')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">List Batches</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-IYT</li>
            <li class="breadcrumb-item active">List-Batches</li>
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
                    <h3 class="card-title">List Batch Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                        <tr>
                            <th>IYT Name</th>
                            <th>Year</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th style="width: 225px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($batches as $batch)
                            <tr>
                                <td>{{ $batch->IYTname }}</td>
                                <td>{{ $batch->batch }}</td>
                                <td>{{ $batch->start_date }}</td>
                                <td>{{ $batch->end_date }}</td>
                                @if( $batch->status == 1)
                                    <td><span class="badge badge-success" style="font-size:15px">Active</span></td>
                                @else
                                    <td><span class="badge badge-danger" style="font-size:15px">Non-Active</span></td>
                                @endif
                                <td>
                                    <div class="row">
                                        <div class="col-lg-4">
                                        @if( $batch->status == 1)
                                            <form action="{{ route('batch.non-active', $batch->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-danger"> Change to Non-Active</button>
                                            </form>
                                        @else
                                            <form action="{{ route('batch.active', $batch->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <button type="submit" class="btn btn-sm btn-success"> Change to Active</button>
                                            </form>
                                        @endif
                                        </div>
                                        <div class="col-lg-4">
                                            <a class="btn btn-sm btn-warning" href="{{ URL::to('admin/IYT-edit-batch/'.$batch->id) }}">Edit</a>
                                        </div>
                                        <div class="col-lg-4">
                                            <form action="{{ route('batch.delete', $batch->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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