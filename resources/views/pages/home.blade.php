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
</style>

@endsection

@section('content')

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">JOB EXPERIENCE</h3>
                            <div class="slider_span" data-wow-duration="1s" data-wow-delay=".5s">
                                <p><span>Being The Expert Start From Now</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- catagory_area -->
    <div class="catagory_area">
        <div class="container">
            <form method="POST" action="{{ route('search') }}">
			@csrf
            <div class="row cat_search">
                <div class="col-lg-9 col-md-12">
                    <div class="single_input">
                        <select id="category" name="category">
                        <option value="all">Semua Kategori</option>
                        @foreach ($jobcategory as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="job_btn">
                        <button type="submit" class="boxed-btn3" style="background-color:rgb(1, 56, 128);">
                                {{ __('Cari Pekerjaan') }}
                        </button>
                    </div>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <span>Kategori Populer:</span>
                        <ul>
                            @foreach($jobcategorypop as $pop)
                            <li><a href=" {{ url('jobs/category/'.$pop->slug) }} ">{{ $pop->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ catagory_area -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">
            <div class="job_lists">
                <div class="row">
                @foreach($job as $j)
                    <div class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="/data_files/employer_logo/{{  $j->logo  }}" alt="" class="img-logo">
                                </div>
                                <div class="jobs_conetent">
                                    <a href=" {{ url('jobs/'.$j->id) }} "><h4>{{ $j->name }}
                                    <div class="links_locat d-flex align-items-center">
                                        <p style="margin-bottom: 2px;">{{ $j->employername }} </p>
                                    </div>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $j->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $j->job_type }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-money"></i>Rp{{ number_format($j->expected_salary_high, 0, ',', '.') }} - {{ number_format($j->expected_salary_low, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a href=" {{ url('jobs/'.$j->id) }} " class="boxed-btn3" style="background-color:rgb(1, 56, 128);">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

    <!-- job_searcing_wrap  -->
    <div class="job_searcing_wrap overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Job?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="#" class="boxed-btn3">Browse Job</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Expert?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="#" class="boxed-btn3">Post a Job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_searcing_wrap end  -->
    <!-- popular_catagory_area_start  -->
    <div class="popular_catagory_area">
        <div class="container">
            <h3>Seminar dan Pelatihan</h3>
            <div class="jumbotron">
                <p><span>Seminar Pra Kerja</span></p>
                <p><span>Bersama: PT ITS</span></p>
		    </div>
        </div>
    </div>
    <!-- popular_catagory_area_end  -->
    <div class="container">

	</div>
@endsection

@section('scripts')
    {{--  --}}
@endsection
