@extends('dashboard.layout')

@section('title', 'Create Service')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create new service</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-Services</li>
            <li class="breadcrumb-item active">Create-Service</li>
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
        <form method="POST" role="form" id="quickForm" action="{{ route('dashboard.student.createService') }}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Deskripsi Umum Jasa</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama Jasa</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Nama Jasa">
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
                            <label for="inputDescription">Deskripsi Jasa</label>
                            <textarea type="text" name="description" class="form-control" id="inputDescription" placeholder="Deskripsi Jasa"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                {{-- <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">RSVP</h3>
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
                </div> --}}
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
          description: {
            required: true,
            maxlength: 255,
          },
        },
        messages: {
          name: {
            required: "Silahkan masukkan nama jasa",
            maxlength: "Tidak dapat melebihi 255 karakter"
          },
          category: {
            required: "Silahkan pilih tipe jasa"
          },
          description: {
            required: "Silahkan masukkan deskripsi jasa",
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