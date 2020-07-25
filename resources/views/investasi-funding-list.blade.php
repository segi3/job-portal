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
                        <h3>{{$investasiCount}} investasi tersedia untuk anda</h3>
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
                                    <h3>Investasi tersedia</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="job_lists m-0">
                        <div class="row">
                            @foreach($investasis as $investasi)
                            <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="jobs_conetent">
                                            <a href=" {{ url('investasi-fund/'.$investasi->id) }} "><h4>{{ $investasi->nama_investasi }}</h4></a>
                                            <div class="links_locat d-flex align-items-center">
                                                <p style="margin-bottom: 2px;">{{ $investasi->nama_investee }} </p>
                                            </div>
                                            <div class="links_locat d-flex align-items-center">
                                                <div class="location">
                                                    <p>Target Fund: Rp {{ number_format($investasi->donasi_target, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="location">
                                                    <p>Terkumpul: Rp {{ number_format($investasi->donasi_masuk, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="jobs_right">
                                        <div class="apply_now">
                                            <a href=" {{ url('investasi-fund/'.$investasi->id) }} " class="boxed-btn3">Donasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                {{ $investasis->links() }}
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
