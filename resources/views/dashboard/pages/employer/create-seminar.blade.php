@extends('dashboard.layout')

@section('title', 'Create Seminar')

@section('stylesheets')
    {{--  --}}
    {{-- <!--  jQuery --> --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
{{-- <!-- Bootstrap Date-Picker Plugin --> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create new seminar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Seminars</li>
            <li class="breadcrumb-item active">Create-Seminar</li>
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
        <form method="POST" role="form" id="quickForm" action="{{ route('dashboard.employer.createSeminar') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Deskripsi Umum Seminar</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama Seminar</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Nama Seminar">
                        </div>
                        <div class="form-group">
                            <label for="inputLocation">Lokasi</label>
                            <input type="text" name="location" class="form-control" id="inputLocation" placeholder="Lokasi">
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
                            <label for="inputDescription">Deskripsi Seminar</label>
                            <textarea type="text" name="description" class="form-control" id="inputDescription" placeholder="Deskripsi Seminar"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputTarget">Target Audience Seminar</label>
                            <textarea type="text" name="target" class="form-control" id="inputTarget" placeholder="Target Audience Seminar"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputMateri">Materi Seminar</label>
                            <textarea type="text" name="materi" class="form-control" id="inputMateri" placeholder="Materi Seminar"></textarea>
                        </div>

                        <div class="form-group">
                                <label for="waktu" class="">{{ __('Waktu Seminar') }}</label><span class=""></span>
                                <input type="text" name="waktu" placeholder="dd-mm-yyyy" value="{{ old('waktu') }}"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'dd-mm-yyyy'" required
                                    class="single-input form-control datepicker">
                            </div>

                        <div class="form-group">
                            <label for="contact_no" class="">{{ __('Surat Bukti penyewaan Tempat') }}</label><span class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="custom-file">
                                  <label class="custom-file-label" id="idberkas" for="berkas_sewa">Upload Berkas</label>
                                  <input type="file" class="custom-file-input" name="berkas_sewa" id="berkas_sewa" aria-describedby="inputGroupFileAddon03" accept="application/pdf"> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact_no" class="">{{ __('Profil Pembicara') }}</label><span class="red-str">*</span>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="custom-file">
                                  <label class="custom-file-label" id="idprofil" for="profil_pemb">Upload Berkas</label>
                                  <input type="file" class="custom-file-input" name="profil_pemb" id="profil_pemb" aria-describedby="inputGroupFileAddon03" accept="application/pdf">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="" class="">{{ __('Poster Seminar') }}</label><span class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                      </button>
                                    </div>
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="poster" accept="image/*" id="poster" aria-describedby="inputGroupFileAddon03">
                                      <label class="custom-file-label" id="idposter" for="poster">Upload Image</label>
                                    </div>
                                </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kontak dan biaya</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCP">Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" id="inputCP" placeholder="Contact Person">
                        </div>
                        <div class="form-group">
                            <label for="inputMobileNoCP">Contact Number</label>
                            <input type="text" name="contact_no" class="form-control" id="inputMobileNoCP" placeholder="Contact Number">
                        </div>
                        <div class="form-group">
                            <label for="inputFee">Fee</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="fee" class="form-control" id="inputFee" placeholder="Masukkan 0 jika tidak memungut biaya">
                            </div>
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

<script type="text/javascript">
    $('#berkas_sewa').change(function(e){
		var fileName = e.target.files[0].name;
        // dd(fileName);
		$('#idberkas').html(fileName);
	});
    $('#profil_pemb').change(function (e1) {
        var fileName1 = e1.target.files[0].name;
        // dd(fileName1);
        $('#idprofil').html(fileName1);
    });
  
    $('#poster').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idposter').html(fileName2);
    });
    </script>
    
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
          location: {
            required: true,
            maxlength: 255,
          },
          category: {
            required: true,
          },
          description: {
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
          fee: {
            required: true,
            maxlength: 11,
            digits: true,
          },
          berkas_sewa: {
            required: true,
            extension: "pdf",
          },
          profil_pemb: {
            required: true,
            extension: "pdf",
          },
          target: {
            required: true,
            maxlength: 255,
          },
          materi: {
            required: true,
            maxlength: 255,
          },
          waktu: {
            required: true,
          },
          poster: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Silahkan masukkan nama seminar",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          location: {
            required: "Silahkan pilih kategori seminar",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          category: {
            required: "Silahkan pilih tipe pekerjaan"
          },
          description: {
            required: "Silahkan masukkan deskripsi seminar",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          contact_person: {
            required: "Silahkan masukkan nama kontak yang dapat dihubungi",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          contact_no: {
            required: "Silahkan masukkan nomor kontak yang dapat dihubungi",
            maxlength: "Tidak dapat melebihi 14 karakter"
          },
         fee: {
            required: "Silahkan masukkan fee seminar",
            maxlength: "Tidak dapat melebihi 11 karakter",
            digits: "Hanya masukkan angka"
          },
          berkas_sewa: {
            required: "File dibutuhkan",
            extension: "Format file tidak sesuai",
          },
          profil_pemb: {
            required: "File dibutuhkan",
            extension: "Format file tidak sesuai",
          },
          target: {
            required: "Silahkan masukkan target audience seminar",
            maxlength: "Tidak dapat melebihi 255 karakter",
          },
          materi: {
            required: "Silahkan masukkan materi seminar",
            maxlength: "Tidak dapat melebihi 255 karakter",
          },
          waktu: {
            required: "Dibutuhkan",
          },
          poster: {
            required: "File poster dibutuhkan",
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
