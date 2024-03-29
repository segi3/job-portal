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
                    <h3 style="text-align:center" class="mb-30">Register Akun Employer</h3>
                    <form method="POST" action="{{ route('employer.register') }} " enctype="multipart/form-data">
                        @csrf

                        <div class="mt-10">
                            <label for="name" class="">{{ __('Nama') }}</label><span class="red-str">*</span>
                            <input type="text" name="name" placeholder="Nama dosen / perusahaan"
                                value="{{  old('name')  }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Nama dosen / perusahaan'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="email" class="">{{ __('Email') }}</label><span class="red-str">*</span>
                            <input type="email" name="email" placeholder="Alamat email" value="{{  old('email')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat email'" required
                                class="single-input">
                        </div>
                        <div class="mt-10 mb-4">
                            <label for="password" class="">{{ __('Password') }}</label><span class="red-str">*</span>
                            <input type="password" name="password" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>
                        <div class="mt-10 mb-4">
                            <label for="password_confirmation" class="">{{ __('Konfirmasi Password') }}</label><span
                                class="red-str">*</span>
                            <input type="password" name="password_confirmation" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <label for="address" class="">{{ __('Alamat') }}</label><span class="red-str">*</span>
                            <input type="text" name="address" placeholder="Alamat" value="{{  old('address')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="city" class="">{{ __('Kota') }}</label><span class="red-str">*</span>
                            <input type="text" name="city" placeholder="Kota" value="{{  old('city')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Kota'" required
                                class="single-input">
                        </div>
                        <div class="mt-10 mb-4">
                            <label for="province" class="">{{ __('Provinsi') }}</label><span class="red-str">*</span>
                            <input type="text" name="province" placeholder="Provinsi" value="{{  old('province')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Provinsi'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <label for="website" class="">{{ __('Website') }}</label>
                            <input type="text" name="website" placeholder="Website" value="{{  old('website')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Website'"
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="contact_person" class="">{{ __('Contact Person') }}</label><span
                                class="red-str">*</span>
                            <input type="text" name="contact_person" placeholder="Contact Person"
                                value="{{  old('contact_person')  }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Contact Person'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <label for="contact_no" class="">{{ __('Contact Phone Number') }}</label><span
                                class="red-str">*</span>
                            <input type="text" name="contact_no" placeholder="Nomor HP aktif"
                                value="{{  old('contact_no')  }}" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Nmor HP aktif'" required class="single-input">
                        </div>
                        <div class="mt-10 mb-5">
                            <label for="fax" class="">{{ __('Fax') }}</label>
                            <input type="text" name="fax" placeholder="Fax" value="{{  old('fax')  }}"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fax'" class="single-input">
                        </div>
                        <div class="form-group">
                            <label for="" class="">{{ __('Surat Rekomendasi Instansi/Perusahaan') }}</label><span
                                class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="berkas_verifikasi"
                                        accept="application/pdf" id="berkas_verifikasi"
                                        aria-describedby="inputGroupFileAddon03">
                                    <label class="custom-file-label" id="idberkas" for="berkas_verifikasi">Upload
                                        Berkas</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="">{{ __('Logo Instansi/Perusahaan') }}</label><span
                                class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                            aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo"
                                        accept=".jpeg,.png,.jpg,.gif,.svg" id="logo"
                                        aria-describedby="inputGroupFileAddon03">
                                    <label class="custom-file-label" id="idlogo" for="logo">Upload Image</label>
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
                            Sudah punya akun? <a href="/login-er">Login disini!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="application/javascript">
    $('#logo').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#idlogo').html(fileName);
    });

    $('#berkas_verifikasi').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idberkas').html(fileName2);
    });

</script>
@endsection
