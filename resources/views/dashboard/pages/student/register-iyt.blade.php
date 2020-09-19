@extends('dashboard.layout')

@section('title', 'Daftar ITS Youth Technopreneur')

@section('stylesheets')
{{--  --}}
<style>
.flex-container{
    display: flex;
}
#idKategori{
    display: inline-block;
    width: 200px;
}
#idSemester{
    display: inline-block;
    width: 200px;
}
.ket{
    color: grey;
    font-size: 13px;
}
</style>

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
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
                <h1 class="m-0 text-dark">Daftar ITS Youth Technopreneur</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/IYT">Home</a></li>
                    <li class="breadcrumb-item active">IYT</li>
                    <li class="breadcrumb-item active">Daftar-IYT</li>
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
        <form method="POST" role="form" id="quickForm" enctype="multipart/form-data"
            action="{{ route('post-register-iyt') }}">
            @csrf
            <div class="row">
                {{-- Deskripsi Investasi --}}
                <div class="col-lg-12 mt-4">
                    <div class="card card-primary h-100">
                        <div class="card-header">
                            <h3 class="card-title">Data Kelompok</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputNamaKetua">Nama Ketua Kelompok:</label>
                                <input type="text" name="namaketua" value="{{ old('namaketua') }}"
                                    class="form-control" id="inputNamaKetua" placeholder="Nama Ketua Kelompok">
                                {{-- <input type="text"> --}}
                            </div>
                            <div>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Nama Kelompok:</label>
                                <input type="text" name="namakelompok" value="{{ old('namakelompok') }}"
                                    class="form-control" id="inputNamaKelompok" placeholder="Nama Kelompok">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Tahun: {{ $batch->batch }}</label> 
                                <input type="hidden" name="batch" value="{{ $batch->id }}"
                                    class="form-control" id="idBatch">
                            </div>
                            <div class="flex-container">
                            <div class="form-group" style="flex-basis: 48%;">
                                <label for="inputNamaKelompok">Tahun Masuk Kuliah:</label>
                                <input type="text" name="tahunmasuk" value="{{ old('tahunmasuk') }}"
                                    class="form-control" id="tahunmasuk" placeholder="Tahun Masuk Kuliah"
                                    onChange="gantiTahun(this)">
                                {{-- <input type="text"> --}}
                            </div>
                            <div style="flex-basis: 4%;"></div>
                            <div class="form-group" style="flex-basis: 48%;">
                                <label for="inputNamaKelompok">Tahun Lulus Kuliah:</label>
                                <input type="text" name="tahunlulus" value="{{ old('tahunlulus') }}"
                                    class="form-control" id="tahunlulus" placeholder="Tahun Lulus Kuliah">
                                {{-- <input type="text"> --}}
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok" class="labelform">Kategori:</label>
                                <select class="form-control" name="kategori" id="idKategori">
                                    <option></option>
                                    <option value="Junior">Junior</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok"  class="labelform">Semester:</label>
                                <select class="form-control" name="semester" id="idSemester">
                                </select>
                            </div>
                            
                            <p class="ket">Kategori Junior untuk semester 1-4, Kategori Senior untuk Semester 5 ke atas.</p>
                            <div class="flex-container">
                            <div class="form-group" style="flex-basis: 48%;">
                                <label for="contact_no" class="">{{ __('Berkas Proposal Bisnis:') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="idlabelpropin"
                                            for="proposalbisnis">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="proposalbisnis"
                                            id="proposalbisnis" accept="application/pdf"
                                            aria-describedby="inputGroupFileAddon03">
                                    </div>
                                </div>
                            </div>
                            <div style="flex-basis: 4%;">
                            </div>
                            <div class="form-group" style="flex-basis: 48%;">
                                <label for="contact_no" class="">{{ __('Berkas Pitch Desk:') }}</label><span
                                    class=""></span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="idlabelpitchdesk" for="pitchdesk">Upload
                                            Berkas</label>
                                        <input type="file" class="custom-file-input" name="pitchdesk"
                                            id="pitchdesk" accept="application/pdf"
                                            aria-describedby="inputGroupFileAddon03">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <input type="checkbox" name="termspolicy" id="termpolicy">
                            <label>Saya Menyetujui Syarat dan Ketentuan dari ITSJobX</label><br /><br />
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

<script>
    $('#quickForm').submit(function () {
        if (!$('#termpolicy')[0].checked) {
            alert('Anda harus menyutujui syarat dan ketentuan yang berlaku.');
            return false;
        }
    });

</script>

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
                namaketua: {
                    required: true,
                },
                namakelompok: {
                    required: true,
                },
                termspolicy: {
                    required: true,
                },
                proposalbisnis: {
                    required: true,
                    extension: "pdf",
                },
                pitchdesk: {
                    required: true,
                    extension: "pdf",
                },
                tahunmasuk: {
                    required: true,
                    digits: true,
                    maxlength: 4,
                },
                tahunlulus: {
                    required: true,
                    digits: true,
                    maxlength: 4,
                },
                kategori:{
                    required: true;
                }
                semester:{
                    required: true;
                }
                batch:{
                    required: true;
                }
            },
            messages: {
                namaketua: {
                    required: "Nama investasi diperlukan",
                },
                namakelompok: {
                    required: "Nama Bank Diperlukan",
                },
                proposalbisnis: {
                    required: "Dibutuhkan",
                    extension: "File format tidak sesuai"
                },
                pitchdesk: {
                    required: "Dibutuhkan",
                    extension: "File format tidak sesuai"
                },
                termspolicy: {
                    required: "Anda belum menyetujui syarat dan ketentuan"
                },
                tahunmasuk:{
                    required: "Silahkan masukkan nominal",
                    digits: "Hanya masukkan angka",
                    maxlength: "Tidak dapat melebihi 4 digit"
                },
                tahunlulus:{
                    required: "Silahkan masukkan nominal",
                    digits: "Hanya masukkan angka",
                    maxlength: "Tidak dapat melebihi 4 digit"
                },
                kategori:{
                    required: "Kategori diperlukan";
                }
                semester:{
                    required: "Semester diperlukan";
                }
                batch:{
                    required: "Batch diperlukan";
                }
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


{{-- Upload Name --}}
<script>
    $('#proposalbisnis').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idlabelpropin').html(fileName2);
    });

    $('#pitchdesk').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idlabelpitchdesk').html(fileName2);
    });

// Select2

$(document).ready(function () {
    $("#idKategori").change(function () {
    var el = $(this);
    if (el.val() === "Junior") {
        $("#idSemester").find('option').remove();
        $("#idSemester").append("<option></option>");
        $("#idSemester").append("<option value=1 >1</option>");
        $("#idSemester").append("<option value=2 >2</option>");
        $("#idSemester").append("<option value=3 >3</option>");
        $("#idSemester").append("<option value=4 >4</option>");
    } else if (el.val() === "Senior") {
        $("#idSemester").find('option').remove();
        $("#idSemester").append("<option></option>");
        $("#idSemester").append("<option value=5 >5</option>");
        $("#idSemester").append("<option value=6 >6</option>");
        $("#idSemester").append("<option value=7 >7</option>");
        $("#idSemester").append("<option value=8 >8</option>");
    }
    });
});

$(document).ready(function() {
    $('#idKategori').select2({
        placeholder: "Pilih Kategori",
        allowClear: true
    });
});

  function gantiTahun(input1) {
    var input2 = document.getElementById('tahunlulus');
    input2.value = parseInt(input1.value,10)+4;
  }
</script>
@endsection
