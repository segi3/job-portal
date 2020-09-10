@extends('dashboard.layout')

@section('title', 'Daftar ITS Youth Technopreneur')

@section('stylesheets')
{{--  --}}
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
                            <div class="form-group">
                                <label for="inputNamaKelompok">Nama Kelompok:</label>
                                <input type="text" name="namakelompok" value="{{ old('namakelompok') }}"
                                    class="form-control" id="inputNamaKelompok" placeholder="Nama Kelompok">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Batch:</label>
                                <select class="form-control" name="batch" id="idBatch">
                                    <option></option>
                                    @foreach ($iyt as $i)
                                        <option value="{{ $i->id }}">{{ $i->batch }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Tahun Masuk Kuliah</label>
                                <input type="text" name="tahunmasuk" value="{{ old('tahunmasuk') }}"
                                    class="form-control" id="inputNamaKelompok" placeholder="Tahun Masuk Kuliah">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Tahun Lulus Kuliah:</label>
                                <input type="text" name="tahunlulus" value="{{ old('tahunlulus') }}"
                                    class="form-control" id="inputNamaKelompok" placeholder="Tahun Lulus Kuliah">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Kategori:</label>
                                <select class="form-control" name="kategori" id="idKategori">
                                    <option></option>
                                    <option value="Junior">Junior</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaKelompok">Semester:</label>
                                <select class="form-control" name="semester" id="idSemester">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
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
                            <input type="checkbox" name="termspolicy" id="termpolicy">
                            <label>Saya Menyetujui Syarat dan Ketentuan dari ITSJobX</label><br /><br />
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="submitbtn btn btn-success">Daftar</button>
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

$(document).ready(function() {
    $('#idBatch').select2({
        placeholder: "Pilih Batch",
        allowClear: true
    });
});

$(document).ready(function () {
    $("#idKategori").change(function () {
    var el = $(this);
    if (el.val() === "Junior") {
        $("#idSemester").append("<option value=1 >1</option>");
        $("#idSemester").append("<option value=2 >2</option>");
        $("#idSemester").append("<option value=3 >3</option>");
        $("#idSemester").append("<option value=4 >4</option>");
    } else if (el.val() === "Senior") {
        $("#idSemester").append("<option value=5 >5</option>");
        $("#idSemester").append("<option value=6 >6</option>");
        $("#idSemester").append("<option value=7 >7</option>");
        $("#idSemester").append("<option value=8 >8</option>");
    }
});

});
</script>

@endsection
