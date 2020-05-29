@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
<style>
    .bg-its-2 {
        background-image: url('{{ asset('img') }}/its-bg-2.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        height: 1000px;
        background-color: rgba(255,255,255,0.4);
        background-blend-mode: lighten;
    }
    </style>
    
@endsection

@section('content')

    <div class="job_details_area bg-its-2">

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

        
            <div class="row justify-content-center">
                <div class="col-lg-6 col-lg-offset-3" style="height: 600px;">
                    <div class="apply_job_form white-bg mt-5">
						<h3 style="text-align:center" class="mb-30">Login Employer</h3>
						<form method="POST" action="{{ route('employer.login') }}">
                        @csrf
							<div class="mt-10">
								<input type="email" name="email" placeholder="Email address"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
							</div>
							<div class="mt-10 mb-5">
								<input type="password" name="password" placeholder="Password" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
							</div>
                            <div class="input-group-icon mt-10">
                                <div class="col-lg">
                                    <div class="text-center">
                                        
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        
                                        {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row mt-4">
                            <div class="col text-center">
                                Belum punya akun? <a href="/register-er">Daftar disini!</a>
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