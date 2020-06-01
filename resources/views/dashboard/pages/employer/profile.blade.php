@extends('dashboard.layout')

@section('title', "My Profile")

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">My-Profile</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">General Information</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><strong>Nama</strong></h6>
                            <p class="card-text">{{  $employer->name  }}</p>

                            <h6 class="card-title"><strong>Website</strong></h6>
                            <p class="card-text">
                                @if($employer->website == null)
                                    -
                                @else
                                    <a href="{{  $employer->website  }}">{{  $employer->website  }}</a>
                                @endif
                            </p>

                            <h6 class="card-title"><strong>Address</strong></h6>
                            <p class="card-text">{{  $employer->address  }}, {{  $employer->city  }}, {{  $employer->province  }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><strong>Contact Person</strong></h6>
                            <p class="card-text">{{  $employer->contact_person  }}</p>

                            <h6 class="card-title"><strong>Contact Number</strong></h6>
                            <p class="card-text">{{  $employer->contact_no  }}</p>

                            <h6 class="card-title"><strong>Email</strong></h6>
                            <p class="card-text">{{  $employer->email  }}</p>

                            <h6 class="card-title"><strong>Fax</strong></h6>
                            <p class="card-text">
                                @if($employer->website == null)
                                    -
                                @else
                                    <p class="card-text">{{  $employer->fax  }}</p>
                                @endif
                            </p>

                            <h6 class="card-title"><strong>Address</strong></h6>
                            <p class="card-text">{{  $employer->address  }}, {{  $employer->city  }}, {{  $employer->province  }}</p>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('scripts')
    {{--  --}}
@endsection