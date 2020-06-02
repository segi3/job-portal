@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{$servicesCount}} Tersedia untuk anda</h3>
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
                        <h4>Jasa tersedia</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <ul>
                        @foreach($jobcategory as $c)
                            <li><a href=" {{ url('jasa/category/'.$c->slug) }} ">{{ $c->name }}</a></li>
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
                                    <h3>Daftar Jasa Tersedia</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job_lists m-0">
                        <div class="row">
                            @foreach($services as $serv)
                            <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        {{-- <div class="thumb">
                                            <img src="img/svg_icon/1.svg" alt="">
                                        </div> --}}
                                        <div class="jobs_conetent">
                                            <a href="{{ url('jasa/'.$serv->id) }}"><h4>{{ $serv->name }}</h4></a>
                                            <div class="links_locat d-flex align-items-center">
                                                <p>{{ $serv->penyedia }} </p>
                                            </div>
                                            <div class="links_locat d-flex align-items-center">
                                                <div class="location">
                                                    <p> <i class="fa fa-list-alt"></i> {{ $serv->category }}</p>
                                                    <p> <i class="fa fa-clock-o"></i> {{ $serv->lastupdate }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="jobs_right">
                                        <div class="apply_now">
                                            <a href="{{ url('jasa/'.$serv->id) }}" class="boxed-btn3">Apply Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <?php echo $services->render(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

@endsection

@section('scripts')
    {{--  --}}
@endsection
