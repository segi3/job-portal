@extends('dashboard.layout')

@section('title', "Dashboard!")

@section('stylesheets')
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<style>
    .red-str {
        color:red;
    }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Registrasi Investee</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Register-Investee</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
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
    <div class="container-fluid">
        <form method="POST" role="form" id="quickForm" action="{{ route('post-register-investee') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penjelasan investee</h5>

                            <p class="card-text">
                                Investee adalah tempat dimana investor melakukan penanaman modal atau melakukan penyertaan modal
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Informasi Startup</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Akun investee dibuat atas akun student anda.</p>

                            <div class="form-group">
                                <label for="inputName">Nama startup</label><span class="red-str">*</span>
                                <input value="" type="text" name="name" class="form-control" id="inputName"
                                    placeholder="Nama Startup">
                            </div>

                            <h6 class="card-title"><strong>Nama Pemilik</strong></h6>
                            <p class="card-text">{{ $student->name }}</p>

                            <h6 class="card-title"><strong>Email</strong></h6>
                            <p class="card-text">{{ $student->email }}</p>

                            <h6 class="card-title"><strong>NRP</strong></h6>
                            <p class="card-text">{{ $student->nrp }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Alamat Startup</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputAddress">Alamat</label><span class="red-str">*</span>
                                <input value="" type="text" name="address" class="form-control" id="inputAddress"
                                    placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <label for="inputCity">Kota</label><span class="red-str">*</span>
                                <input value="" type="text" name="city" class="form-control" id="inputCity"
                                    placeholder="Kota">
                            </div>
                            <div class="form-group">
                                <label for="inputProvince">Provinsi</label><span class="red-str">*</span>
                                <input value="" type="text" name="province" class="form-control" id="inputProvince"
                                    placeholder="Provinsi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Kontak Tambahan</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputContact">Nama Kontak</label><span class="red-str">*</span>
                                <input value="" type="text" name="contact_person" class="form-control" id="inputContact"
                                    placeholder="Nama Kontak">
                            </div>
                            <div class="form-group">
                                <label for="inputContactNo">Nomor Kontak</label><span class="red-str">*</span>
                                <input value="" type="text" name="contact_no" class="form-control" id="inputContactNo"
                                    placeholder="Nomor Kontak">
                            </div>
                            <div class="form-group">
                                <label for="inputFax">Fax</label>
                                <input value="" type="text" name="fax" class="form-control" id="inputFax"
                                    placeholder="Fax">
                            </div>
                        </div>
                        <button type="submit" class="submit btn btn-success">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
{{-- jquery-validation --}}
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                //   alert( "Form successful submitted!" );
                console.log('')
                if ($('#quickForm').valid()) {
                    $('#quickForm')[0].submit();
                }

            }
        });
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                address: {
                    required: true,
                    maxlength: 255,
                },
                city: {
                    required: true,
                    maxlength: 255,
                },
                province: {
                    required: true,
                    maxlength: 255,
                },
                contact_person: {
                    required: true,
                    maxlength: 255,
                },
                contact_no: {
                    required: true,
                    maxlength: 14,
                },
            },
            messages: {
                name: {
                    required: "Nama startup tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                address: {
                    required: "Alamat tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                city: {
                    required: "Kota tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                province: {
                    required: "Provinsi masukkan posisi pekerjaan",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                contact_person: {
                    required: "Nama kontak tidak bolek kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                contact_no: {
                    required: "Nomor kontak tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 14 karakter"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

</script>

@endsection
