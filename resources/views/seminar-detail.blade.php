@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
<style>
    .img-logo {
        display: block;
        max-width: 52px;
        max-height: 52px;
        width: auto;
        height: auto;
    }
    .img-poster {
        max-width: 100%;
        max-height: 100%;
        /* height: inherit !important; */
    }
    div.single_jobs {

    }
</style>
@endsection

@section('content')

    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $seminar->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="job_details_area">
        <div class="container">
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
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="/data_files/Employer/employer_logo/{{  $seminar->logo  }}" alt="" class="img-logo">
                                </div>
                                <div class="jobs_conetent">
                                    <a><h4>{{ $seminar->name }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $seminar->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Seminar description</h4>
                            <p>{{ $seminar->description }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Seminar material</h4>
                            <p>{{ $seminar->materi }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Seminar target</h4>
                            <p>{{ $seminar->target }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Seminar schedule</h4>
                            <p>{{ $seminar->waktu }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Fee</h4>
                            @if($seminar->fee == 0)
                            <p>Gratis</p>
                            @else
                            <p>Rp {{ number_format($seminar->fee, 0, ',', '.') }}</p>
                            @endif
                        </div>
                        <div class="single_wrap">
                            <h4>Contact Person</h4>
                            <p>{{ $seminar->contact_person }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Contact Number</h4>
                            <p>{{ $seminar->contact_no }}</p>
                        </div>
                        <div class="single_wrap">
                            <img src="/data_files/Employer/Seminar/Poster/{{  $seminar->poster  }}" alt="" class="img-poster">
                        </div>
                    </div>                
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job_sumary">
                                <div class="summery_header">
                                    <h3>Employer Summary</h3>
                                </div>
                                <div class="job_content">
                                    <ul>
                                        <li>Listed by : <span>{{ $seminar->empname }}</span></li>
                                        <li>Address   : <span>{{ $seminar->empaddress }}, {{ $seminar->empcity }}, {{ $seminar->empprov }}</span></li>
                                        <li>Website   : <span><a href="{{ $seminar->empweb }}">{{ $seminar->empweb }}</a></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection