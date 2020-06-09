@extends('dashboard.layout')

@section('title', 'Create Job')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create new job</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Jobs</li>
            <li class="breadcrumb-item active">Create-Jobs</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
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
        <form method="POST" role="form" id="quickForm" action="{{ route('dashboard.employer.createJob') }}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Deskripsi Umum Job</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama pekerjaan</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Nama Pekerjaan">
                        </div>

                        <div class="form-group">
                            <label for="inputKategori">Kategori</label>
                            <select name="category" class="form-control" id="inputKategori">
                                <option value="1">Pertanian</option>
                                <option value="2">Pertambangan</option>
                                <option value="3">Industri Dasar dan Kimia</option>
                                <option value="4">Aneka Industri</option>
                                <option value="5">Industri Barang Konsumsi</option>
                                <option value="6">Properti, Real Estate dan Konstruksi</option>
                                <option value="7">Infrastruktur, Utilitas dan Transportasi</option>
                                <option value="8">Finansial</option>
                                <option value="9">Perdagangan, Jasa dan Transportasi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputJobType">Tipe pekerjaan</label>
                            <select name="job_type" class="form-control" id="inputJobType">
                                <option value="remote">Remote</option>
                                <option value="part-time">Part-time</option>
                                <option value="freelance">Freelance</option>
                                <option value="internship">Internship</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputPosition">Posisi Pekerjaan/jabatan</label>
                            <input type="text" name="position" class="form-control" id="inputPosition" placeholder="Posisi Pekerjaan/jabatan">
                        </div>

                        <div class="form-group">
                            <label for="inputLocation">Lokasi Pekerjaan</label>
                            <input type="text" name="location" class="form-control" id="inputLocation" placeholder="Lokasi Pekerjaan">
                        </div>

                        <div class="form-group">
                            <label for="inputDescription">Deskripsi Pekerjaan</label>
                            <textarea type="text" name="description" class="form-control" id="inputDescription" placeholder="Deskripsi Pekerjaan"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Deskripsi Skill</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="inputMinQualification">Minimal Qualification</label>
                            <textarea type="text" name="minimal_qualification" class="form-control" id="inputMinQualification" placeholder="Kualifikasi minimal pekerjaan"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputReqSkill">Required skill</label>
                            <textarea type="text" name="required_skill" class="form-control" id="inputReqSkill" placeholder="Kemampuan yang dibutuhkan unuk pekerjaan"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputExtraSKill">Extra Skill</label>
                            <textarea type="text" name="extra_skill" class="form-control" id="inputExtraSKill" placeholder="Kemampuan tambahan yang dapat membantu pekerjaan"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bayaran Pekerjaan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputSalaryHigh">Range Salary Tinggi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="expected_salary_high" class="form-control" id="inputSalaryHigh" placeholder="Masukkan hanya nominal">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="inputSalaryLow">Range Salary Rendah</label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                              </div>
                              <input type="text" name="expected_salary_low" class="form-control" id="inputSalaryLow" placeholder="Masukkan hanya nominal">
                          </div>
                      </div>
                        <div class="form-group">
                            <label for="inputKompensasi">Kompensasi</label>
                            <input type="text" name="kompensasi" class="form-control" id="inputKompensasi" placeholder="Fasilitas yang ditawarkan">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
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
            if($('#quickForm').valid()){
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
          category: {
            required: true,
          },
          job_type: {
            required: true,
          },
          position: {
            required: true,
            maxlength: 255,
          },
          location: {
            required: true,
            maxlength: 255,
          },
          description: {
            required: true,
          },
          minimal_qualification: {
            required: true,
            maxlength: 255,
          },
          required_skill: {
            required: true,
            maxlength: 255,
          },
          extra_skill: {
            maxlength: 255,
          },
          expected_salary_high: {
            required: true,
            digits: true,
            maxlength: 11,
          },
          expected_salary_low: {
            required: true,
            digits: true,
            maxlength: 11,
          },
        //   kompensasi: {
        //     maxlength: 255,
        //   },
        },
        messages: {
          name: {
            required: "Silahkan masukkan nama pekerjaan",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          category: {
            required: "Silahkan pilih kategori pekerjaan"
          },
          job_type: {
            required: "Silahkan pilih tipe pekerjaan"
          },
          position: {
            required: "Silahkan masukkan posisi pekerjaan",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          location: {
            required: "Silahkan masukkan lokasi pekerjaan",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          description: {
            required: "Silahkan masukkan deskripsi pekerjaan"
          },
          minimal_qualification: {
            required: "Silahkan masukkan kualifikasi minimal",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          required_skill: {
            required: "Silahkan masukkan kemampuan yang dibutuhkan",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          extra_skill: {
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          expected_salary_high: {
            required: "Silahkan masukkan nominal",
            digits: "Hanya masukkan angka",
            maxlength: "Tidak dapat melebihi 11 karakter"
          },
          expected_salary_low: {
            required: "Silahkan masukkan nominal",
            digits: "Hanya masukkan angka",
            maxlength: "Tidak dapat melebihi 11 karakter"
          },
        //   kompensasi: {
        //     maxlength: "Tidak dapat melebihi 255 karakter"
        //   },
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
