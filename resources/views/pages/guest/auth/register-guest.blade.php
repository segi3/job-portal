@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
<style>
    .red-str {
        color: red;
    }

</style>
@endsection

@section('content')

<div class="job_details_area">

    <div class="container">


        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (Session::has('success'))

                <div class="alert alert-success" role="alert">
                    <strong>Success:</strong> {{ Session::get('success') }}
                </div>

                @elseif (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach (Session::get('error') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="apply_job_form white-bg">
                    <h3 style="text-align:center" class="mb-30">Register Akun Guest</h3>
                    <form method="POST" action="{{ route('guest.register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-10">
                            <label for="email" class="">{{ __('Email') }}</label><span class="red-str">*</span>
                            <input type="email" name="email" placeholder="Alamat email" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Alamat email'" required class="single-input">
                        </div>
                        <div class="mt-10 mb-5">
                            <label for="password" class="">{{ __('Password') }}</label><span class="red-str">*</span>
                            <input type="password" name="password" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>
                        <div class="mt-10 mb-5">
                            <label for="password_confirmation" class="">{{ __('Konfirmasi Password') }}</label><span
                                class="red-str">*</span>
                            <input type="password" name="password_confirmation" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <label for="name" class="">{{ __('Nama') }}</label><span class="red-str">*</span>
                            <input type="text" name="name" placeholder="Nama lengkap" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Nama lengkap'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="status" class="">{{ __('Status') }}</label><span class="red-str"> *</span>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="statusopt1"
                                    value="lajang">
                                <label for="statusopt1" class="form-check-label">
                                    Lajang
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status" id="statusopt2"
                                    value="menikah">
                                <label for="statusopt2" class="form-check-label">
                                    Sudah menikah
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <label for="pekerjaan" class="">{{ __('Pekerjaan') }}</label><span class="red-str">*</span>
                            <input type="text" name="pekerjaan" placeholder="Pekerjaan" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Pekerjaan'" required class="single-input">
                        </div>
                        <div class="mt-10 mb-5">
                            <label for="mobile_no" class="">{{ __('Nomor HP aktif') }}</label><span
                                class="red-str">*</span>
                            <input type="text" name="mobile_no" placeholder="Nomor HP aktif"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nomor HP aktif'" required
                                class="single-input">
                        </div>
                        <div class="form-group">
                            <label for="contact_no" class="">{{ __('Berkas Verifikasi') }}</label><span
                                class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkas" id="berkas"
                                        aria-describedby="inputGroupFileAddon03">
                                    <label class="custom-file-label" id='idberkas' for="logo">Upload Berkas</label>
                                </div>
                            </div>
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
                            Sudah punya akun? <a href="/login-gs">Login disini!</a>
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
<script type="application/javascript">
    $('#berkas').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idberkas').html(fileName2);
    });

</script>
@endsection
