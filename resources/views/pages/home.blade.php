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

    .bg-seminar {
        background-image: url('{{ asset('img') }}/seminar.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        /* background-color: rgba(255,255,255,0.4);
        background-blend-mode: lighten; */
    }

    .bg-jasa {
        background-image: url('{{ asset('img') }}/jasa.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        min-height: 300px;
        /* background-color: rgba(255,255,255,0.4);
        background-blend-mode: lighten; */
    }


    .highlight-biru-kuning {
        background: rgb(1, 56, 128);
        color: #ffc415;
        font-size: 30px;
        font-weight: 600;
        padding: 6px 17px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        margin-right: 10px;
    }
    .quote {
        color: rgb(0, 0, 0);
        font-size: 20px;
        font-weight: 500;
    }
    .boxed-btn3-home {
        position: absolute;
        /* left: 50%;
        margin-left: -50%; */
        bottom: 50px;
        max-width: 100%;
        display: block;
        right: 0;
        left: 0;
        margin: auto;
    }
    .highlight-kuning-biru {
        background: #ffc415;
        color: rgb(0, 0, 0);
        font-size: 30px;
        font-weight: 600;
        padding: 6px 17px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        margin-right: 10px;
        /* right: 0;
        left: 0;
        bottom: 0;
        margin: auto; */
    }

    div.slider_text div.slider_span p.highlight-kuning-biru {
        background: #ffc415;
        color: rgb(0, 0, 0);
        font-size: 30px;
        font-weight: 500;
        display: inline-block;
        /* border: red solid 1px; */
    }
    .highlight-kuning-biru-kecil {
        background: #ffc415;
        color: rgb(0, 0, 0);
        font-size: 17px;
        font-weight: 600;
        padding: 6px 17px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        margin-right: 10px;

        /* right: 0;
        left: 0;
        bottom: 0;
        margin: auto; */
    }

    .popular_catagory_area h3 {
        color: rgb(1, 56, 128);
    }

    .popular_catagory_area p {
        text-align: center;
        font-size: 22px;
    }

    .bg-img1 {
        background-image: url('{{ asset('img') }}/interview.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        min-height: 350px;
    }

    .bg-img2 {
        background-image: url('{{ asset('img') }}/jobseek.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        min-height: 350px;
    }
    .bg-img3{
        background-image: url('{{ asset('img') }}/workshop.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        min-height: 350px;
    }
    .bg-jumbotron {
        background-image: url('{{ asset('img') }}/banner/bg-jumbotron-1.jpg');
    }

</style>

@endsection

@section('content')

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center bg-jumbotron">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">JOB EXPERIENCE</h3>
                            <div class="slider_span" data-wow-duration="1s" data-wow-delay=".5s">
                                <p class="highlight-kuning-biru">Be an expert, starts from now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- catagory_area -->
    <div class="catagory_area" style="padding-bottom: 20px;">
        <div class="container">
            <form method="POST" action="{{ route('search') }}">
			@csrf
            <div class="row cat_search">
                <div class="col-lg-4 col-md-12">
                    <div class="single_input">
                        <select id="category" name="category" required>
                        <option value="" disabled selected hidden>Kategori Pekerjaan</option>
                        <option value="all" >Semua Kategori</option>
                        @foreach ($jobcategory as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-12">
                    <div class="single_input">
                        <select id="job_type" name="job_type" required>
                        <option value="" disabled selected hidden>Tipe Pekerjaan</option>
                        <option value="all">Semua Tipe Pekerjaan</option>
                        <option value="remote">Remote</option>
                        <option value="part-time">Part-time</option>
                        <option value="freelance">Freelance</option>
                        <option value="internship">Internship</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
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
    <div class="job_listing_area" style="padding-top: 30px;">
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

    <div class="popular_catagory_area" style="padding: 50px 0;">
        <div class="container">
            <h3>Let's Start</h3>
            <p class="quote">"Tugas kita bukanlah untuk berhasil. Tugas kita adalah untuk mencoba, karena didalam mencoba itulah kita menemukan dan belajar membangun kesempatan untuk berhasil." </br> -Buya Hamka</p>
        </div>
    </div>

    <div class="popular_catagory_area" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 col-md-6 bg-img1 text-center">
                <a class="boxed-btn3-home" href="/login-er">
                    <span class="highlight-kuning-biru">POST THE JOB</span></br>
                    <span class="highlight-kuning-biru-kecil">FOR COMPANY</span>
                </a>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 bg-img2 text-center">
                <a class="boxed-btn3-home" href="/login-st">
                    <span class="highlight-kuning-biru">FIND JOBS</span></br>
                    <span class="highlight-kuning-biru-kecil">FOR STUDENT</span>
                </a>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 bg-img3 text-center">
                <a class="boxed-btn3-home" style="bottom:30px;">
                    <span class="highlight-kuning-biru">OTHER</span></br>
                    <span class="highlight-kuning-biru">SERVICES</span>
                </a>
                </div>
            </div>
        </div>
    </div>

    <div class="popular_catagory_area">
        <div class="container">
            <h3>Seminar dan Pelatihan</h3>
        </div>
    </div>

    <div class="popular_catagory_area bg-seminar mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-8 col-sm-12 text-right">
                    <span class="highlight-biru-kuning">Seminar Pra Kerja</span>
                </div>
                <div class="col-lg-4 offset-lg-8 mt-2 col-sm-12 text-right">
                    <span class="highlight-biru-kuning">Bersama: PT ITS</span>
                </div>
            </div>
        </div>
    </div>

<!-- job_listing_area_start  -->
<div class="job_listing_area" style="padding-top: 30px;">
        <div class="container">
            <div class="job_lists">
                <div class="row">
                @foreach($seminar as $s)
                    <div class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="/data_files/employer_logo/{{  $s->logo  }}" alt="" class="img-logo">
                                </div>
                                <div class="jobs_conetent">
                                    <a><h4>{{ $s->name }}</a>
                                    <div class="links_locat d-flex align-items-center">
                                        <p style="margin-bottom: 2px;">{{ $s->employername }} </p>
                                    </div>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $s->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-money"></i>Rp{{ number_format($s->fee, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a href="#" class="boxed-btn3" style="background-color:rgb(1, 56, 128);">Buy Now</a>
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

    <div class="popular_catagory_area">
        <div class="container">
            <h3>Cari Jasa</h3>
        </div>
    </div>

    <div class="popular_catagory_area bg-jasa mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <span class="highlight-biru-kuning">Jasa oleh mahasiswa ITS</span>
                </div>
            </div>
        </div>
    </div>

    <div class="job_listing_area" style="padding-top: 30px;">
        <div class="container">
            <div class="job_lists">
                <div class="row">
                @foreach($jasa as $js)
                    <div class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <a href=" {{ url('jobs/'.$js->id) }} "><h4>{{ $js->name }}
                                    <div class="links_locat d-flex align-items-center">
                                        <p style="margin-bottom: 2px;">{{ $js->studname }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a href="#" class="boxed-btn3" style="background-color:rgb(1, 56, 128);">Use Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="popular_catagory_area" style="padding: 50px 0;">
        <div class="container">
            <h3>Ayo mulai dari sekarang</h3>
            <p class="quote">"Anda mungkin bisa menunda, tapi waktu tidak akan menunggu"</br> -Benjamin Franklin</p>
        </div>
    </div>


@endsection

@section('scripts')
    {{--  --}}
@endsection
