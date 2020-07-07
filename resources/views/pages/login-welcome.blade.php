@extends('layout')

@section('title', "Selamat Datang!")

@section('stylesheets')
<style>
    .vh {
        height: 100vh;
    }

    .bg-its-1 {
        background-image: url('{{ asset('img') }}/its-bg-1.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(255,255,255,0.4);
        background-blend-mode: lighten;
    }
    .bg-login-1 {
        background:
            linear-gradient(
                rgb(93, 188, 210, 0.65),
                rgb(93, 188, 210, 0.65)
            ),
            url('{{ asset('img') }}/bg-login-1.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    .bg-login-2 {
        background:
            linear-gradient(
                rgb(93, 188, 210, 0.65),
                rgb(93, 188, 210, 0.65)
            ),
            url('{{ asset('img') }}/bg-login-2.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    .bg-login-3 {
        background:
            linear-gradient(
                rgb(93, 188, 210, 0.65),
                rgb(93, 188, 210, 0.65)
            ),
            url('{{ asset('img') }}/bg-login-3.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
    p.text-search {
        font-weight: 400;
        color: #ffffff;
        font-size: 16px;
        margin-bottom: 30px;
        margin-top: 12px;
    }
    h3.text-search-title {
        color: rgb(1, 56, 128);
    }
    .container-tr {
        -moz-border-radius:10px;  /* for Firefox */
        -webkit-border-radius:10px; /* for Webkit-Browsers */
        border-radius:10px; /* regular */
        background-color: rgba(255, 255, 255, 0.4);
    }
    .btn-daftar {
        background: #ffc415;
        color: #fff;
        display: block;
        padding: 13px 29px 13px 29px;
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        font-weight: 500;
        border: 0;
        border: 1px solid transparent;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
        color: #fff !important;
        text-transform: capitalize;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        cursor: pointer;
    }
    .btn-daftar:hover {
        color:#ffffff !important;
        border: 1px solid rgb(255, 196, 21);
        background: rgb(255, 196, 21, 0.5);
    }
    .btn-login {
        background: #0069d9;
        color: #fff;
        display: block;
        padding: 13px 29px 13px 29px;
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        font-weight: 500;
        border: 0;
        border: 1px solid transparent;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
        color: #fff !important;
        text-transform: capitalize;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        cursor: pointer;
    }
    .btn-login:hover {
        color:#ffffff !important;
        border: 1px solid rgb(0, 105, 217);
        background: rgb(0, 105, 217, 0.5);
    }
    .no-margin
    {
        margin: 0px !important;
    }
</style>
    
@endsection

@section('content')

            {{-- @if (Session::has('success'))

				<div class="alert alert-success" role="alert">
					<strong>Success:</strong> {{ Session::get('success') }}
				</div> --}}

            


    {{-- <div class="job_details_area bg-its-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                </div>
                <div class="col-lg-4">
                    <div class="apply_job_form white-bg">
                        <h4 style="text-align:center" class="mb-30">Selamat datang di portal ITS JobX!</h3>
                        <p>
                            Anda mahasiswa ITS sedang mencari pekerjaan atau ingin menawarkan jasa?
                        </p>
                        <div class="row">
                            <div class="col-8">
                                <form method="GET" action="/register-st" class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Daftar akun student') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-4 pl-0">
                                <form method="GET" action="/login-st" class="mb-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <p>
                            Anda dosen ITS atau perusahaan ingin menawarkan pekerjaan kepada mahasiswa ITS?
                        </p>
                        <div class="row">
                            <div class="col-8 pr-0">
                                <form method="GET" action="/register-er" class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Daftar akun employer') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                <form method="GET" action="/login-er" class="mb-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <p>
                            Anda sedang mencari jasa oleh mahasiswa ITS?
                        </p>
                        <div class="row">
                            <div class="col-8">
                                <form method="GET" action="register-gs" class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Daftar akun guest') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-4 pl-0">
                                <form method="GET" action="/login-gs" class="mb-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </form>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="job_details_area py-0 vh">
        
            @if (Session::has('error'))
            <div class="container">
                <div class="container" style="z-index: 99 !important; position: absolute; top: 100px;">
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                </div>
            </div>
            @endif
       
        <div class="row no-margin">
            <div class="col-lg-4 py-5 bg-login-1" style="height: 100vh;">
                
                <div class="container pt-5">
                    <div class="searching_text pt-5">
                        <div class="container-tr">
                        <h2 class="text-search-title ml-4 pt-4">Mencari pekerjaan?</h2>
                        <p class="text-search pb-5 mx-4">Kami memberikan kemudahan bagi mahasiswa ITS untuk mencari pekerjaan dan memasang kredensial</p>
                        </div>
                        <div class="row pt-5">
                            <div class="col-8">
                                <a href="/register-st" class="btn-daftar">Daftar akun student</a>
                            </div>
                            <div class="col-4 pl-0">
                                <a href="/login-st" class="btn-login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4 py-5 bg-login-2" style="height: 100vh;">
                <div class="container pt-5">
                    <div class="searching_text pt-5">
                        <div class="container-tr">
                        <h2 class="text-search-title ml-4 pt-4">Mencari seorang ahli?</h2>
                        <p class="text-search pb-5 mx-4">Kami memberikan platform bagi employer untuk mencari tenaga ahli yang anda dibutuhkan</p>
                        </div>
                        <div class="row pt-5">
                            <div class="col-8 pr-0">
                                <a href="/register-er" class="btn-daftar">Daftar akun employer</a>
                            </div>
                            <div class="col-4">
                                <a href="/login-er" class="btn-login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 py-5 bg-login-3" style="height: 100vh;">
                <div class="container pt-5">
                    <div class="text-search pt-5">
                        <div class="container-tr">
                        <h2 class="text-search-title ml-4 pt-4">Mencari mahasiswa dengan kredensial?</h2>
                        <p class="text-search pb-5 mx-4">Kami memberikan kemudahan bagi siapapun yang mencari seorang dengan kredensial yang anda cari</p>
                        </div>
                        <div class="row pt-5">
                            <div class="col-8">
                                <a href="/register-gs" class="btn-daftar">Daftar akun guest</a>
                            </div>
                            <div class="col-4 pl-0">
                                <a href="/login-gs" class="btn-login">Login</a>
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