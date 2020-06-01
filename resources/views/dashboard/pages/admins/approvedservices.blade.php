@extends('dashboard.layout')

@section('title', 'Approved Services')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Approved Services</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Services</li>
            <li class="breadcrumb-item active">Approved-Services</li>
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
                    <h3 class="card-title">Approved Service Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>                  
                            <tr>
                                <th>Service Name</th>
                                <th>Student</th>
                                <th>Last Updated</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->stdname }}</td>
                                    <td>{{ $service->updated_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-{{ $service->id }}">
                                            Details
                                        </button>
                                        <div class="modal fade" id="modal-{{ $service->id }}">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title">Service Details</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <table class="table table-borderless">
                                                    <tbody>
                                                      <tr>
                                                        <td>Service Name</td>
                                                        <td>{{ $service->name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Submitted by</td>
                                                        <td>{{ $service->stdname }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Category</td>
                                                        <td>{{ $service->category_name }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Description</td>
                                                        <td>{{ $service->description }}</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Last Updated</td>
                                                        <td>{{ $service->updated_at }}</td>
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
                                        <form action="{{ route('service.reject', $service->id) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <button type="submit" class="btn btn-sm btn-block btn-danger">Reject</button>
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
                        {{ $services->links() }}
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