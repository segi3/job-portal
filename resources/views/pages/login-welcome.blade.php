@extends('layout')

@section('title', "Selamat Datang!")

@section('stylesheets')
<style>
.bg-its-1 {
        background-image: url('{{ asset('img') }}/its-bg-1.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: rgba(255,255,255,0.4);
        background-blend-mode: lighten;
    }
</style>
    
@endsection

@section('content')

    <div class="job_details_area bg-its-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                </div>
                <div class="col-lg-4">
                    <div class="apply_job_form white-bg">
                        <h4 style="text-align:center" class="mb-30">Selamat datang di portal JobX ITS!</h3>
                        <p>
                            Anda mahasiswa ITS sedang mencari pekerjaan atau ingin menjual jasa?
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
    </div>
@endsection

@section('scripts')
    {{--  --}}
@endsection