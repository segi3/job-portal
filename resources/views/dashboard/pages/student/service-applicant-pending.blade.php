@extends('dashboard.layout')

@section('title', 'Service Applicants')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Service Applicant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Services</li>
            <li class="breadcrumb-item active">Services-Applicant-Pending</li>
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
                                <th>Nama</th>
                                <th>Jasa</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Listed at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($applicants as $applicant)
                                <tr>
                                    <td>{{ $applicant->guestname }}</td>
                                    <td>{{ $applicant->servicename }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>{{ $applicant->mobile_no }}</td>
                                    <td>{{ $applicant->created_at }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action="{{ route('service-applicant.accept', $applicant->gsid) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <button type="submit" class="btn btn-sm btn-block btn-success mr-4">Accept</button>
                                                  </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <form action="{{ route('service-applicant.reject', $applicant->gsid) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('put') }}
                                                    <button type="submit" class="btn btn-sm btn-block btn-danger">Reject</button>
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
                        {{ $applicants->links() }}
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