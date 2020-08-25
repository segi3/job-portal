@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
<style>
    .red-str {
        color: red;
    }

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endsection

@section('content')
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{ $investasi->nama_investasi }}</h3>
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
                            {{-- <div class="thumb">
                                <img src="img/svg_icon/1.svg" alt="">
                            </div> --}}
                            <div class="jobs_conetent">
                                <a href="#">
                                    <h4>{{ $investasi->nama_investasi }}</h4>
                                </a>
                                <div class="links_locat d-flex align-items-center">
                                    {{-- <div class="location">
                                        <p> <i class="fa fa-map-marker"></i> {{ $servDetail->city }},
                                    {{ $servDetail->prov }}</p>
                                </div> --}}
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
                    <h4>Deskripsi Bisnis</h4>
                    <p>{{ $investasi->deskripsi_bisnis }}</p>
                </div>
                @if(session()->has('role'))
                    @if( session('role') == 'student' || session('role') == 'guest')
                    <div class="single_wrap">
                        <h4>Proposal Investasi</h4>
                        <form action="{{ route('proposal.project.investasi.download', $investasi->id) }}" method="get">
                            <button type="submit" class="btn btn-sm btn-primary mr-4">Download Proposal Investasi</button>
                        </form>
                    </div>
                    @endif
                @endif

            </div>

        </div>
        <div class="col-lg-4">
            <div class="job_sumary">

                <div class="summery_header">
                    <h3>Informasi investasi</h3>
                </div>
                <div class="job_content">
                    <ul>
                        <li>Penyedia saham: <span>{{ $investasi->nama_investee }}</span></li>
                        <li>Target Donasi : <span>Rp {{ number_format($investasi->donasi_target, 0, ',', '.') }}</span></li>
                        <li>Donasi Masuk : <span>Rp {{ number_format($investasi->donasi_masuk, 0, ',', '.') }}</span></li>
                    </ul>
                    @if($investasi->status_tempo == 2)

                    <div class="alert alert-danger" role="alert">
                        <span>Masa aktif saham sudah lewat</span>
                    </div>
                    @elseif(session()->has('role'))
                    @if( (session('role') == 'student' || session('role') == 'guest') && $investasi->status_tempo == 1)
                    <hr>
                    <h5>Donasi</h5>
                    <form method="POST" action="/donasi/{{ $investasi->id }}" enctype="multipart/form-data">
                        {{-- <form method="POST" onsubmit="return submitForm();"> --}}
                        @csrf
                        <div class="mt-10 mb-3">
                            <label for="total_harga" class="">{{ __('Jumlah Donasi') }}</label>
                            <input type="total_harga" name="total_harga" placeholder="" id="dsp"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = ''" class="single-input"
                                >
                        </div>

                        <input type="checkbox" name="termspolicy" id="termpolicy">
                        <label>Saya Menyetujui <a href="/syarat-ketentuan" target="_blank">Syarat dan
                                Ketentuan</a></label>

                        <input type="hidden" id="p_id" name="project_id" value="{{ $investasi->id }}" />
                        <input type="hidden" id="p_name" name="project_name" value="{{ $investasi->nama_investasi }}" />

                        <div class="input-group-icon mt-10">
                            <div class="col-lg">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        {{ __('Beli') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endif

                </div>

            </div>

        </div>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-OIG__kD5EwOHlm0Z"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

{{-- snap pop up --}}
{{-- <script>
    function submitForm() {
        console.log('btn presses');
        $.post("/beli-saham/{{ $investasi->id }}",
{
_method: 'POST',
_token: '{{ csrf_token() }}',
lembar_beli: $('input#lembar').val(),
project_id: $('input#project_id').val(),
project_name: $('input#project_name').val(),
total_harga: $('input#hg').val(),
},
function (data, status) {
snap.pay(data.snap_token, {
onSuccess: function (result) {
location.reload();
},
onPending: function(result) {
location.reload();
},
onError: function (result) {
location.reload();
}
});
});
return false;
}
</script> --}}

@endsection
