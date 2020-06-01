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
        <h1 class="m-0 text-dark">Unapproved Employers</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Employers</li>
            <li class="breadcrumb-item active">Unapproved-Employers</li>
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
                    <h3 class="card-title">Unapproved Employer Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>                  
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Contact person</th>
                                    <th>Contact Number</th>
                                    <th>Last Updated</th>
                                    <th style="width: 87px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($employers as $employer)
                                <tr>
                                    <td>{{ $employer->name }}</td>
                                    <td>{{ $employer->address }}, {{ $employer->city }}, {{ $employer->province }}</td>
                                    <td>{{ $employer->email }}</td>
                                    <td>{{ $employer->contact_person }}</td>
                                    <td>{{ $employer->contact_no }}</td>
                                    <td>{{ $employer->updated_at }}</td>
                                    <td>
                                        <form action="{{ route('employer.approve', $employer->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button type="submit" class="btn btn-sm btn-block btn-success mr-4">approve</button>
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
                        {{ $employers->links() }}
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