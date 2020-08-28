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
                        <h3>{{ $job->name }}</h3>
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
                                    <img src="/data_files/Employer/employer_logo/{{  $job->logo  }}" alt="" class="img-logo">
                                </div>
                                <div class="jobs_conetent">
                                    <a><h4>{{ $job->name }}</h4></a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->job_type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{{ $job->description }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Minimal Qualification</h4>
                            <p>{{ $job->minimal_qualification}}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Required Skill</h4>
                            <p>{{ $job->required_skill }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Extra Skill</h4>
                            @if( $job->extra_skill == null)
                            <p>-</p>
                            @else
                            <p>{{ $job->extra_skill }}</p>
                            @endif
                        </div>
                        <div class="single_wrap">
                            <h4>Compensation</h4>
                            <p>{{ $job->kompesasi }}</p>
                        </div>
                    </div>

                    @if( session('role') == 'student' )
                    <div class="apply_job_form white-bg">
                        <h4>Apply for the job</h4>
                        <form action="/applyjob/{{$job->id}}" method="POST" enctype="multipart/form-data">
					    {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                          </button>
                                        </div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="cv" id="cv" aria-describedby="inputGroupFileAddon03">
                                          <label class="custom-file-label" for="cv">Upload CV</label>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <textarea name="motlet" id="motlet" cols="30" rows="10" placeholder="Motivation Letter"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else 
                    <form method="GET" action="/login-st" class="mb-4">
                        <div class="submit_btn mt-5">
                            <button type="submit" class="boxed-btn3 w-100">
                                {{ __('Login sebagai mahasiswa utuk Apply Job!') }}
                            </button>
                        </div>
                    </form>
                    @endif

                    
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job_sumary">
                                <div class="summery_header">
                                    <h3>Job Summary</h3>
                                </div>
                                <div class="job_content">
                                    <ul>
                                        <li>Published on   : <span>{{ $job->created_at }}</span></li>
                                        <li>Expected Salary: <span>Rp {{ number_format($job->expected_salary_high, 0, ',', '.') }} - Rp{{ number_format($job->expected_salary_low, 0, ',', '.') }}</span></li>
                                        <li>Location       : <span>{{ $job->location }}</span></li>
                                        <li>Job Type       : <span> {{ $job->job_type }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-5">
                            <div class="job_sumary">
                                <div class="summery_header">
                                    <h3>Employer Summary</h3>
                                </div>
                                <div class="job_content">
                                    <ul>
                                        <li>Listed by : <span>{{ $job->empname }}</span></li>
                                        <li>Address   : <span>{{ $job->empaddress }}, {{ $job->empcity }}, {{ $job->empprov }}</span></li>
                                        <li>Website   : <span><a href="{{ $job->empweb }}">{{ $job->empweb }}</a></span></li>
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
<script type="application/javascript">
	$('#cv').change(function(e){
		var fileName = e.target.files[0].name;
		$('.custom-file-label').html(fileName);
	});
</script>
@endsection