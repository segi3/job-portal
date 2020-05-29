@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
	<style>
		.red-str {
			color: red;
		}
    </style>

    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endsection

@section('content')

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

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="apply_job_form white-bg">
						<h3 style="text-align:center" class="mb-30">Register Akun Student</h3>
						<form method="POST" action="{{ route('student.register') }}">
						@csrf
                            <div class="mt-10">
                                <label for="email" class="">{{ __('Email') }}</label><span class="red-str"> *</span>
                                <input type="email" name="email" placeholder="Alamat email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat email'" required class="single-input">
                            </div>
                            <div class="mt-10 mb-5">
                                <label for="password" class="">{{ __('Password') }}</label><span class="red-str"> *</span>
                                <input type="password" name="password" placeholder="Password" 
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
                            </div>


							<div class="mt-10">
								<label for="name" class="">{{ __('Nama') }}</label><span class="red-str"> *</span>
								<input type="text" name="name" placeholder="Nama Panjang"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama panjang'" required class="single-input">
                            </div>
                            <div class="mt-10">
								<label for="nrp" class="">{{ __('NRP') }}</label><span class="red-str"> *</span>
								<input type="text" name="nrp" placeholder="NRP"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'NRP'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <label for="gender" class="">{{ __('Jenis kelamin') }}</label><span class="red-str"> *</span>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gender" id="genderopt1" value="L">
                                    <label for="genderopt1" class="form-check-label">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gender" id="genderopt2" value="P">
                                    <label for="genderopt2" class="form-check-label">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="mt-10">
								<label for="birthday" class="">{{ __('Tanggal lahir') }}</label><span class="red-str"> *</span>
								<input type="text" name="birthday" placeholder="dd-mm-yyyy"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'dd-mm-yyyy'" required class="single-input form-control datepicker">
                            </div>
                            <div class="mt-10 mb-5">
								<label for="mobile_no" class="">{{ __('Nomor HP') }}</label><span class="red-str"> *</span>
								<input type="text" name="mobile_no" placeholder="Nomor HP aktif"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nomor HP aktif'" required class="single-input">
                            </div>
							

							<div class="mt-10">
								<label for="address" class="">{{ __('Alamat') }}</label><span class="red-str"> *</span>
								<input type="text" name="address" placeholder="Alamat" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'" required class="single-input">
							</div>
							<div class="mt-10">
								<label for="city" class="">{{ __('Kota') }}</label><span class="red-str"> *</span>
								<input type="text" name="city" placeholder="Kota" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Kota'" required class="single-input">
							</div>
							<div class="mt-10 mb-5">
								<label for="province" class="">{{ __('Provinsi') }}</label><span class="red-str"> *</span>
								<input type="text" name="province" placeholder="Provinsi" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Provinsi'" required class="single-input">
							</div>


							<div class="mt-10">
								<label for="hobby" class="">{{ __('hobby') }}</label><span class="red-str"> *</span>
								<input type="text" name="hobby" placeholder="hobby" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'hobby'" required class="single-input">
							</div>
							<div class="mt-10">
                                <label for="skill" class="">{{ __('Skill') }}</label><span class="red-str"> *</span>
								<textarea name="skill" class="single-textarea" placeholder="Skill" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'Skill'" required></textarea>
                            </div>
                            <div class="mt-10">
                                <label for="achievment" class="">{{ __('Achievment') }}</label><span class="red-str"> *</span>
								<textarea name="achievment" class="single-textarea" placeholder="Achievment" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'Achievment'" required></textarea>
                            </div>
                            <div class="mt-10 mb-5">
                                <label for="experience" class="">{{ __('Experience') }}</label><span class="red-str"> *</span>
								<textarea name="experience" class="single-textarea" placeholder="Experience" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'Experience'" required></textarea>
							</div>
							
							
                            <div class="input-group-icon mt-10">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            {{ __('Daftar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
						</form>
						<div class="row mt-4">
                            <div class="col text-center">
                                Sudah punya akun? <a href="/login-st">Login disini!</a>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(function(){
     $(".datepicker").datepicker({
         format: 'dd-mm-yyyy',
         autoclose: true,
         todayHighlight: true,
     });
    });
   </script>
@endsection