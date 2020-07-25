@extends('dashboard.layout')

@section('title', "Edit Profile")

@section('stylesheets')
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit-Profile</li>
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
        <form method="POST" role="form" id="quickForm" action="{{ route('student.profile.update') }}">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">General Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Nama</label>
                                <input value="{{  $student->name  }}" type="text" name="name" class="form-control"
                                    id="inputName" placeholder="Nama" disabled>
                            </div>

                            <div class="form-group">
                                <label for="inputGender">Gender</label>
                                <select name="gender" class="form-control" id="inputGender">
                                    @if($student->gender == 'L')
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                    @elseif($student->gender == 'P')
                                    <option value="P">Perempuan</option>
                                    <option value="L">Laki-Laki</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputNRP">NRP</label>
                                <input value="{{  $student->nrp  }}" type="text" name="nrp" class="form-control"
                                    id="inputNRP" placeholder="NRP" disabled>
                            </div>

                            <div class="form-group">
                                <label for="inputBD">Birthdate</label>
                                <input type="text" name="birthday" placeholder="dd-mm-yyyy"
                                    class="single-input form-control datepicker" id="inputBD"
                                    value="{{  $student->birthdate  }}">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input value="{{  $student->address  }}" type="text" name="address" class="form-control"
                                    id="inputAddress" placeholder="Address">
                            </div>

                            <div class="form-group">
                                <label for="inputCity">City</label>
                                <input value="{{  $student->city  }}" type="text" name="city" class="form-control"
                                    id="inputCity" placeholder="City">
                            </div>

                            <div class="form-group">
                                <label for="inputProvince">Province</label>
                                <input value="{{  $student->province  }}" type="text" name="province"
                                    class="form-control" id="inputProvince" placeholder="Province">
                            </div>

                            <div class="form-group">
                                <label for="inputHobby">Hobby</label>
                                <textarea type="text" name="hobby" class="form-control" id="inputHobby"
                                    placeholder="Hobby">{{  $student->hobby  }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputSKill">Skill</label>
                                <textarea type="text" name="skill" class="form-control" id="inputSKill"
                                    placeholder="Skill">{{  $student->skill  }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputAchievment">Achievment</label>
                                <textarea type="text" name="achievment" class="form-control" id="inputAchievment"
                                    placeholder="Achievment">{{  $student->achievment  }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputExperience">Experience</label>
                                <textarea type="text" name="experience" class="form-control" id="inputExperience"
                                    placeholder="Experience">{{  $student->experience  }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input value="{{  $student->email  }}" type="text" name="email"
                                            class="form-control" id="inputEmail" placeholder="Email" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMobileNo">Mobile Number</label>
                                        <input value="{{  $student->mobile_no  }}" type="text" name="mobile_no"
                                            class="form-control" id="inputMobileNo" placeholder="Mobile Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="submit btn btn-block btn-success" style="height: 45px;">Save
                                Changes</button>
                            {{-- <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Save Changes</h5>
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="submitbtn btn-block btn-success">Submit</button>
                            </div> --}}
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </form>
</div>
@endsection

@section('scripts')


<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });

</script>

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
                email: {
                    required: true,
                    maxlength: 255,
                },
                nrp: {
                    required: true,
                    maxlength: 14,
                },
                gender: {
                    required: true,
                },
                birthday: {
                    required: true,
                },
                mobile_no: {
                    required: true,
                    maxlength: 14,
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
                hobby: {
                    required: true,
                    maxlength: 255,
                },
                skill: {
                    required: true,
                    maxlength: 255,
                },
                achievment: {
                    required: true,
                    maxlength: 255,
                },
                experience: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                name: {
                    required: "Nama tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                email: {
                    required: "Email tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                nrp: {
                    required: "Nrp tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 14 karakter"
                },
                gender: {
                    required: "Silahkan masukkan posisi pekerjaan"
                },
                birthday: {
                    required: "Tanggal lahir tidak boleh kosong"
                },
                mobile_no: {
                    required: "Silahkan masukkan deskripsi pekerjaan"
                },
                minimal_qualification: {
                    required: "Nomor HP tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 14 karakter"
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
                    required: "Provinsi tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                hobby: {
                    required: "Hobi tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                skill: {
                    required: "Skill/kemampuan tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                achievment: {
                    required: "Penghargaan tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
                },
                experience: {
                    required: "Pengalaman pekerjaan tidak boleh kosong",
                    maxlength: "Tidak dapat melebihi 255 karakter"
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
