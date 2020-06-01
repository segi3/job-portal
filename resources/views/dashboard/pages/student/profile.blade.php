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
            @if (Session::has('success'))

				<div class="alert alert-success" role="alert">
					<strong>Success:</strong> {{ Session::get('success') }}
				</div>

            @elseif (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

			@if (count($errors) > 0)

				<div class="alert alert-danger" role="alert">
					<strong>Errors:</strong>
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>

			@endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">General Information</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><strong>Nama</strong></h6>
                            <p class="card-text">{{  $student->name  }}</p>

                            <h6 class="card-title"><strong>Gender</strong></h6>
                                @if($student->gender == 'L')
                                    <p class="card-text">Laki-Laki</p>
                                @elseif($student->gender == 'P')
                                    <p class="card-text">Perempuan</p>
                                @endif

                            <h6 class="card-title"><strong>NRP</strong></h6>
                            <p class="card-text">{{  $student->nrp  }}</p>

                            <h6 class="card-title"><strong>Birthdate</strong></h6>
                            <p class="card-text">{{  $student->birthdate  }}</p>

                            <h6 class="card-title"><strong>Address</strong></h6>
                            <p class="card-text">{{  $student->address  }}, {{  $student->city  }}, {{  $student->province  }}</p>

                            <h6 class="card-title"><strong>Hobby</strong></h6>
                            <p class="card-text">{{  $student->hobby  }}</p>

                            <h6 class="card-title"><strong>Skill</strong></h6>
                            <p class="card-text">{{  $student->skill  }}</p>

                            <h6 class="card-title"><strong>Achievment</strong></h6>
                            <p class="card-text">{{  $student->achievment  }}</p>

                            <h6 class="card-title"><strong>Experience</strong></h6>
                            <p class="card-text">{{  $student->experience  }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><strong>Email</strong></h6>
                            <p class="card-text">{{  $student->email  }}</p>

                            <h6 class="card-title"><strong>Mobile Number</strong></h6>
                            <p class="card-text">{{  $student->mobile_no  }}</p>
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