@extends('dashboard.layout')

@section('title', 'Create Funding Invesment')

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
                <h1 class="m-0 text-dark">Create Funding investment</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard/investee">Home</a></li>
                    <li class="breadcrumb-item active">Manage-Investment</li>
                    <li class="breadcrumb-item active">Create-Funding-Investment</li>
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
            action="{{ route('dashboard.investee.createFundingInvestment') }}">
            @csrf
            <div class="row">
                {{-- Deskripsi Investasi --}}
                <div class="col-lg-6 mt-4">
                    <div class="card card-primary h-100">
                        <div class="card-header">
                            <h3 class="card-title">Deskripsi Investasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputNamaInvestasi">Nama/Judul Investasi</label>
                                <input type="text" name="namainvestasi" value="{{ old('namainvestasi') }}"
                                    class="form-control" id="inputNamaInvestasi" placeholder="Nama/Judul Investasi">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="targetdana">{{ __('Target Dana') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" name="targetdana" value="{{ old('targetdana') }}"
                                        class="form-control" id="idtargetdana"
                                        placeholder="Masukkan hanya nominal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duedate" class="">{{ __('Jatuh Tempo') }}</label><span class=""></span>
                                <input type="text" name="duedate" placeholder="dd-mm-yyyy"
                                    value="{{ old('duedate') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'dd-mm-yyyy'" required
                                    class="single-input form-control datepicker">
                            </div>

                        </div>
                    </div>
                </div>
                {{-- Dekskripsi Bisnis --}}
                <div class="col-lg-6 mt-4">
                  <div class="card h-100">
                      <div class="card-header">
                          <h3 class="card-title">Deskripsi Bisnis</h3>
                      </div>
                      <div class="card-body">
                          <div class="form-group">
                              <label for="inputDescription">Deskripsi Bisnis</label>
                              <textarea type="text" name="description" value="{{ old('description') }}"
                                  class="form-control" id="inputDescription"
                                  placeholder="Deskripsi Bisnis"></textarea>
                          </div>
                          <div class="form-group">
                              <label for="inputNamaBank">Nama Bank</label>
                              <input type="text" name="namabank" value="{{ old('namabank') }}" class="form-control"
                                  id="inputBank" placeholder="Nama Bank">
                              {{-- <input type="text"> --}}
                          </div>
                          <div class="form-group">
                              <label for="inputNoRek">Nomor Rekening Bank</label>
                              <input type="text" name="nomorrekening" value="{{ old('nomorrekening') }}"
                                  class="form-control" id="inputNoRek" placeholder="Masukan hanya angka">
                              {{-- <input type="text"> --}}
                          </div>
                          <div class="form-group">
                              <label for="inputAN">Atas nama</label>
                              <input type="text" name="atasnama" value="{{ old('atasnama') }}" class="form-control"
                                  id="inputAN" placeholder="Pemilik rekening">
                              {{-- <input type="text"> --}}
                          </div>
                      </div>
                  </div>
              </div>

                {{-- Berkas Validasi --}}
                <div class="col-lg-6 mt-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Berkas Validasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="contact_no" class="">{{ __('Berkas Proposal Investasi') }}</label><span
                                    class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="idlabelpropin"
                                            for="proposalinvestasi">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="proposalinvestasi"
                                            id="proposalinvestasi" accept="application/pdf"
                                            aria-describedby="inputGroupFileAddon03">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact_no" class="">{{ __('Berkas Laporan Keuangan') }}</label><span
                                    class=""></span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="idlabellapkeu"
                                            for="laporankeuangan">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="laporankeuangan"
                                            id="laporankeuangan" accept="application/pdf"
                                            aria-describedby="inputGroupFileAddon03">
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox" name="termspolicy" id="termpolicy">
                            <label>Anda Menyetujui Syarat dan Ketentuan dari ITSJobX</label><br /><br />
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
                namainvestasi: {
                    required: true,
                },
                termspolicy: {
                    required: true,
                },
                description: {
                    required: true,
                },
                namabank: {
                    required: true,
                },
                nomorrekening: {
                    required: true,
                    digits: true,
                },
                atasnama: {
                    required: true,
                },
                targetdana: {
                    required: true,
                    digits: true,
                },
                duedate: {
                    required: true,
                    // maxlength: 255,
                },
                proposalinvestasi: {
                    required: true,
                    extension: "pdf",
                },
                laporankeuangan: {
                    required: true,
                    extension: "pdf",
                },

            },
            messages: {
                namainvestasi: {
                    required: "Nama investasi diperlukan",
                },
                description: {
                    required: "Deskripsi Bisnis Diperlukan",
                },
                namabank: {
                    required: "Nama Bank Diperlukan",
                },
                nomorrekening: {
                    required: "Nomor Rekening Diperlukan",
                    digits: "Hanya Masukan Angka"
                },
                atasnama: {
                    required: "Nama Pemilik Rekening Diperlukan",
                },
                targetdana: {
                    required: "Target dana yang ingin dicapai",
                    digits: "Hanya masukkan angka"
                },
                duedate: {
                    required: "Dibutuhkan",
                    // maxlength: 255,
                },
                proposalinvestasi: {
                    required: "Dibutuhkan",
                    extension: "File format tidak sesuai"
                },
                laporankeuangan: {
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

{{-- Date Picker --}}
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

{{-- Upload Name --}}
<script>
    $('#proposalinvestasi').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idlabelpropin').html(fileName2);
    });

    $('#laporankeuangan').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idlabellapkeu').html(fileName2);
    });

</script>

@endsection
