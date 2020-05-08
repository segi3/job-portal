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
						<h3 style="text-align:center" class="mb-30">REGISTER</h3>
						<form method="POST" action="{{ route('employer.register') }}">
                        @csrf
							<div class="mt-10">
								<input type="text" name="name" placeholder="Name"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required
									class="single-input">
							</div>

							<div class="mt-10">
								<input type="email" name="email" placeholder="Email address"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="address" placeholder="Address" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required class="single-input">
							</div>
							<div class="mt-10">
							<div class="mt-10">
								<input type="text" name="city" placeholder="City" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="province" placeholder="Province" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Province'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="website" placeholder="Website" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Website'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="contact_person" placeholder="Contact Person" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contact Person'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="contact_no" placeholder="Contact No" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contact No'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="fax" placeholder="Fax" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fax'" required class="single-input">
							</div>
							<div class="mt-10">
								<input type="password" name="password" placeholder="Password" 
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
							</div>
                            <div class="input-group-icon mt-10">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
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