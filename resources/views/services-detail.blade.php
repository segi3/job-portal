@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
<!-- bradcam_area  -->
@foreach ($servData as $servDetail)

<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{ $servDetail->servname }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->
<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img src="img/svg_icon/1.svg" alt="">
                            </div>
                            <div class="jobs_conetent">
                                <a href="#"><h4>{{ $servDetail->servname }}</h4></a>
                                <div class="links_locat d-flex align-items-center">
                                    <div class="location">
                                        <p> <i class="fa fa-map-marker"></i> {{ $servDetail->city }},{{ $servDetail->prov }}</p>
                                    </div>
                                    {{-- <div class="location">
                                        <p> <i class="fa fa-clock-o"></i> Part-time</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="jobs_right">
                            <div class="apply_now">
                                <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="descript_wrap white-bg">
                    <div class="single_wrap">
                        <h4>Deskripsi Pelayanan</h4>
                        <p>{{ $servDetail->desc }}</p>

                    </div>
                    <h3>Lebih lanjut mengenai penyedia layanan</h3>
                    <div class="single_wrap">

                        <h4>Hobi</h4>
                        <p>{{$servDetail->hobby}}</p>
                        {{-- <ul>
                            <li>The applicants should have experience in the following areas.
                            </li>
                            <li>Have sound knowledge of commercial activities.</li>
                            <li>Leadership, analytical, and problem-solving abilities.</li>
                            <li>Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.</li>
                        </ul> --}}
                    </div>
                    <div class="single_wrap">
                        <h4>Skill</h4>
                        <p>{{$servDetail->skill}}</p>
                        {{-- <ul>
                            <li>The applicants should have experience in the following areas.
                            </li>
                            <li>Have sound knowledge of commercial activities.</li>
                            <li>Leadership, analytical, and problem-solving abilities.</li>
                            <li>Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.</li>
                        </ul> --}}
                    </div>
                    <div class="single_wrap">
                        <h4>Pengalaman</h4>
                        <p>{{$servDetail->expe}}</p>
                    </div>
                    <div class="single_wrap">
                        <h4>Pencapaian</h4>
                        <p>{{$servDetail->achievment}}</p>
                    </div>
                </div>
                <div class="apply_job_form white-bg">

                    <form action="/applyservices/{{$servDetail->id}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="submit_btn">
                                    <button class="boxed-btn3 w-100" type="submit">Pakai Jasa Sekarang</button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Informasi Penyedia Layanan</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>Nama: <span>{{ $servDetail->studentName }}</span></li>
                            <li>NRP: <span>{{ $servDetail->nrp }}</span></li>
                            <li>Nomor Handphone: <span>{{ $servDetail->nohp }}</span></li>
                            <li>Email: <span>{{ $servDetail->email }}</span></li>
                            <li>Jenis Kelamin: <span>{{ $servDetail->gender }}</span></li>
                            <li>Domisili: <span>{{ $servDetail->city }},{{ $servDetail->prov }}</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endforeach
@endsection

@section('scripts')
    {{--  --}}
@endsection
