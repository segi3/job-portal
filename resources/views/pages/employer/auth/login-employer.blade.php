@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')

    <div class="job_details_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="apply_job_form white-bg">
						<h3 style="text-align:center" class="mb-30">Login</h3>
						<form method="POST" action="{{ route('employer.login') }}">
                        @csrf
							<div class="mt-10">
								<input type="email" name="email" placeholder="Email address"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="password" name="password" placeholder="Password" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
							</div>
                            <div class="input-group-icon mt-10">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                        <a href="/register">Don't have an account?</a>
                                    </div>
                                </div>
                            </div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--  --}}
@endsection