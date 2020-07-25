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

    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{$Count}} Tersedia untuk anda</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="catagory_area" style="padding-top: 50px; padding-bottom: 0px;">
        <div class="container">
            <div class="row cat_search">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title mb-40" style="margin-bottom: 10px;">
                        <h4>Kategori</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <ul>
                        @foreach($seminarcategory as $c)
                            <li><a href=" {{ url('seminar/category/'.$c->slug) }} ">{{ $c->name }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="job_listing_area plus_padding" style="padding-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h3>Seminar tersedia</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job_lists m-0">
                        <div class="row">
                            @foreach($seminar as $s)
                            <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="thumb my-auto">
                                            <img src="/data_files/employer_logo/{{  $s->emplogo  }}" alt="" class="img-logo">
                                        </div>
                                        <div class="jobs_conetent">
                                            <a href=" {{ url('jobs/'.$s->id) }} "><h4>{{ $s->name }}</h4></a>
                                            <div class="links_locat d-flex align-items-center">
                                                <p style="margin-bottom: 2px;">{{ $s->employername }} </p>
                                            </div>
                                            <div class="links_locat d-flex align-items-center">
                                                <div class="location">
                                                    <p> <i class="fa fa-map-marker"></i> {{ $s->location }}</p>
                                                </div>
                                                <div class="location">
                                                    <p> <i class="fa fa-money"></i>Rp. {{ $s->fee}}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                {{ $seminar->links() }}
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
