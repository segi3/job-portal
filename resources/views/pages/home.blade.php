@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')

@endsection

@section('content')

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

<div class="catagory_area" style="padding-bottom: 20px;">
    <div class="container">
        <form method="POST" action="{{ route('search') }}">
            @csrf
            <div class="row cat_search">
                <div class="col-lg-4 col-md-12">
                    <div class="single_input">
                        <select id="category" name="category" required>
                            <option value="" disabled selected hidden>Kategori Pekerjaan</option>
                            <option value="all">Semua Kategori</option>
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

<div class="job_listing_area" style="padding-top: 30px;">
    <div class="container">
        <div class="job_lists">
            <div class="row">
                @foreach($job as $j)
                <div class="col-lg-12 col-md-12">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img src="/data_files/Employer/employer_logo/{{  $j->logo  }}" alt="" class="img-logo">
                            </div>
                            <div class="jobs_conetent">
                                <a href=" {{ url('jobs/'.$j->id) }} ">
                                    <h4>{{ $j->name }}
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
                                                <p> <i
                                                        class="fa fa-money"></i>Rp{{ number_format($j->expected_salary_low, 0, ',', '.') }}
                                                    - {{ number_format($j->expected_salary_high, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                <a href=" {{ url('jobs/'.$j->id) }} " class="boxed-btn3"
                                    style="background-color:rgb(1, 56, 128);">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="popular_catagory_area start-quote">
    <div class="container">
        <h3>Let's Start</h3>
        <p class="quote">"Tugas kita bukanlah untuk berhasil. Tugas kita adalah untuk mencoba, karena didalam mencoba
            itulah kita menemukan dan belajar membangun kesempatan untuk berhasil." </br> -Buya Hamka</p>
    </div>
</div>

<div class="popular_catagory_area panel-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 offset-lg-1 col-sm-12 pointer" onclick="location.href='/login-er'">
                <div class="bg-img1"></div>
                {{-- <a class="boxed-btn3-home bg-img1" href="/login-er"></a> --}}
                    <div class="start-text text-center">
                        <span class="highlight-kuning-biru">POST JOBS</span></br>
                        <span class="highlight-kuning-biru-kecil">FOR COMPANY</span>
                    </div>
                
            </div>
            
            <div class="col-lg-3 offset-lg-1 col-sm-12 pointer" onclick="location.href='/login-st'">
                <div class="bg-img2"></div>
                {{-- <a class="boxed-btn3-home bg-img2" href="/login-st"></a> --}}
                    <div class="start-text text-center">
    
                        <span class="highlight-kuning-biru">FIND JOBS</span></br>
                        <span class="highlight-kuning-biru-kecil">FOR STUDENT</span>
    
                    </div>
                
            </div>
            <div class="col-lg-3 offset-lg-1 col-sm-12 pointer" onclick="location.href='/jasa'">
                <div class="bg-img3"></div>
                {{-- <a class="boxed-btn3-home bg-img3" href="#"></a> --}}
                    <div class="start-text text-center">
    
                        <span class="highlight-kuning-biru-kecil">OTHER</span></br>
                        <span class="highlight-kuning-biru">SERVICES</span>
    
                    </div>
               
            </div>
            
        </div>
    </div>
</div>

<div class="popular_catagory_area bg-white">
    <div class="container">
        <h3>Seminar dan Pelatihan</h3>
    </div>
</div>

<div class="popular_catagory_area bg-seminar seminar-banner">
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

<div class="job_listing_area seminar-area" style="padding-top: 30px;">
    <div class="container">
        @if(count($seminar) > 0)
        <h3>Seminar Terbaru</h2>
        <div class="job_lists">
            <div class="row">
                @foreach($seminar as $s)
                <div class="col-lg-12 col-md-12">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img src="/data_files/Employer/employer_logo/{{  $s->logo  }}" alt="" class="img-logo">
                            </div>
                            <div class="jobs_conetent">
                                <a>
                                    <h4>{{ $s->name }}
                                </a>
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
                                <a href="{{ url('seminar/'.$s->id) }}" class="boxed-btn3" style="background-color:rgb(1, 56, 128);">See detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div>
            <h5 id="zero-entry" class="pt-3">Tidak ada seminar dan pelatihan untuk saat ini</h5>
        </div>
        
        @endif
    </div>
</div>

<div class="popular_catagory_area bg-white">
    <div class="container">
        <h3>Jasa oleh Mahasiswa ITS</h3>
    </div>
</div>

<div class="popular_catagory_area bg-jasa">
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
        @if(count($jasa) > 0)
        <div class="job_lists">
            <div class="row">
                @foreach($jasa as $js)
                <div class="col-lg-12 col-md-12">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="jobs_conetent">
                                <a href=" {{ url('jobs/'.$js->id) }} ">
                                    <h4>{{ $js->name }}
                                        <div class="links_locat d-flex align-items-center">
                                            <p style="margin-bottom: 2px;">{{ $js->studname }} </p>
                                        </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                <a href="{{ url('jasa/'.$js->id) }}" class="boxed-btn3" style="background-color:rgb(1, 56, 128);">Pesan Jasa</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div>
            <h5 id="zero-entry" class="pt-3">Tidak jasa oleh mahasiswa untuk saat ini</h5>
        </div>
        @endif
    </div>
</div>

<div class="popular_catagory_area bg-white">
    <div class="container">
        <h3>ITS Youth Technopreneur</h3>
    </div>
</div>

<div class="popular_catagory_area iyt bg-white">
    <img src="../../img/home-iyt.png" alt="">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <a class="boxed-btn3" href="its-youth-technopreneur">Daftar ITS Youth Technopreneur Sekarang!</a>
            </div>
        </div>
    </div>
</div>



<div class="popular_catagory_area bg-white end-quote" style="padding: 50px 0;">
    <div class="container">
        <h3>Ayo mulai dari sekarang</h3>
        <p class="quote">"Anda mungkin bisa menunda, tapi waktu tidak akan menunggu"</br> -Benjamin Franklin</p>
    </div>
</div>


@endsection

@section('scripts')
{{--  --}}
@endsection
