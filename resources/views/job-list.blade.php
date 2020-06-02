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

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{$jobsCount}} Tersedia untuk anda</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <!-- catagory_area -->
    <div class="catagory_area">
        <div class="container">
            <div class="row cat_search">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title mb-40">
                        <h4>Categories</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <ul>
                        @foreach($jobcategory as $c)
                            <li><a href=" {{ url('jobs/category/'.$c->slug) }} ">{{ $c->name }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ catagory_area -->
    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h3>Pekerjaan tersedia</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job_lists m-0">
                        <div class="row">
                            @foreach($job as $j)
                            <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="thumb">
                                            <img src="/data_files/employer_logo/{{  $j->logo  }}" alt="" class="img-logo">
                                        </div>
                                        <div class="jobs_conetent">
                                            <a href=" {{ url('jobs/'.$j->id) }} "><h4>{{ $j->name }}</h4></a>
                                            <div class="links_locat d-flex align-items-center">
                                                <p style="margin-bottom: 0px;">{{ $j->employername }} </p>
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
                                            <a href=" {{ url('jobs/'.$j->id) }} " class="boxed-btn3">Apply Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                {{ $job->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--  --}}
@endsection
