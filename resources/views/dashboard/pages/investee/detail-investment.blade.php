@extends('dashboard.layout')

@section('title', 'Detail Project Investment')

@section('stylesheets')
    {{--  --}}
@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail Project Investment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard/investee">Home</a></li>
            <li class="breadcrumb-item active">Manage-Investment</li>
            <li class="breadcrumb-item active">Detail Project Investment</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- main content --}}
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <form method="POST" role="form" id="quickForm" enctype="multipart/form-data"
            action="{{ route('dashboard.student.createService') }}">
            @csrf
            <div class="row">
            <div class="col-lg-6">
                    <div class="card card-primary h-100">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Laporan Progres Project</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="deskripsi_laporan">Deskripsi Laporan</label>
                                <input type="text" name="deskripsi_laporan" value="{{ old('deskripsi_laporan') }}"
                                    class="form-control" id="deskripsi_laporan" placeholder="Deskripsi Laporan">
                                {{-- <input type="text"> --}}
                            </div>
                            <div class="form-group">
                                <label for="keterangan_tambahan">Keterangan tambahan</label>
                                <input type="hidden" id="project_id" name="project_id" value="3487">
                                <input type="text" name="keterangan_tambahan" value="{{ old('keterangan_tambahan') }}"
                                    class="form-control" id="keterangan_tambahan" placeholder="Keterangan tambahan">
                            </div>
                            <div class="form-group">
                                <label for="tgl" class="">{{ __('Tanggal') }}</label><span class=""></span>
                                <input type="text" name="tgl" placeholder="dd-mm-yyyy"
                                    value="{{ old('tgl') }}" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'dd-mm-yyyy'" required
                                    class="single-input form-control datepicker">
                            </div>
                            <div class="form-group">
                                <label for="berkas_laporan" class="">{{ __('Berkas Laporan Progres') }}</label><span
                                    class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="idlabelpropin"
                                            for="berkas_laporan">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="berkas_laporan"
                                            id="berkas_laporan" accept="application/pdf"
                                            aria-describedby="inputGroupFileAddon03">
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Investment Project List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                            <tr>
                                <th>Nama Investasi</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Lembar Terbeli</th>
                                <th>Lembar Total</th>
                                <th style="width: 87px">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($investment as $inv)
                            <tr>
                                <td>{{ $inv->nama_investasi }}</td>
                                <td>{{ $inv->tgl_jatuh_tempo }}</td>
                                <td>{{ $inv->lembar_terbeli }}</td>
                                <td>{{ $inv->lembar_total }}</td>
                                <td>
                                    <a class="tn btn-sm btn-block btn-info" href="{{ url('/dashboard/investee/detail-investment/'.$inv->id) }}" role="button">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investment->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Investment Project List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                            <tr>
                                <th>Nama Investasi</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Lembar Terbeli</th>
                                <th>Lembar Total</th>
                                <th style="width: 87px">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($investment as $inv)
                            <tr>
                                <td>{{ $inv->nama_investasi }}</td>
                                <td>{{ $inv->tgl_jatuh_tempo }}</td>
                                <td>{{ $inv->lembar_terbeli }}</td>
                                <td>{{ $inv->lembar_total }}</td>
                                <td>
                                    <a class="tn btn-sm btn-block btn-info" href="{{ url('/dashboard/investee/detail-investment/'.$inv->id) }}" role="button">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investment->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
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
                deskripsi_laporan: {
                    required: true,
                },
                project_id: {
                    required: true,
                },
                keterangan_tambahan: {
                    required: true,
                },
                tgl: {
                    required: true,
                    // maxlength: 255,
                },
                berkas_laporan: {
                    required: true,
                    extension: "pdf",
                },

            },
            messages: {
                deskripsi_laporan: {
                    required: "Deskripsi Laporan Progres diperlukan",
                },
                keterangan_tambahan: {
                    required: "Keterangan Tambahan Laporan Progres diperlukan",
                },
                tgl: {
                    required: "Dibutuhkan",
                    // maxlength: 255,
                },
                berkas_laporan: {
                    required: "Dibutuhkan",
                    extension: "File format tidak sesuai"
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
    $('#berkas_laporan').change(function (e2) {
        var fileName2 = e2.target.files[0].name;
        // dd(fileName2);
        $('#idlabelpropin').html(fileName2);
    });

</script>

@endsection