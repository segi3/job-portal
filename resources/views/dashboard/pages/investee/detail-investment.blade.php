@extends('dashboard.layout')

@section('title', 'Detail Project Investment')

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
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Investment Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td>Nama Investasi</td>
                                    <td>: {{ $investment->nama_investasi }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Bisnis</td>
                                    <td>: {{ $investment->deskripsi_bisnis }}</td>
                                </tr>
                                <tr>
                                    <td>Harga saham</td>
                                    <td>: {{ $investment->harga_saham }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Jatuh Tempo</td>
                                    <td>: {{ $investment->tgl_jatuh_tempo }}</td>
                                </tr>
                                <tr>
                                    <td>Lembar terbeli</td>
                                    <td>: {{ $investment->lembar_terbeli }}</td>
                                </tr>
                                <tr>
                                    <td>Lembar total</td>
                                    <td>: {{ $investment->lembar_total }}</td>
                                </tr>
                                <tr>
                                    <td>ROI</td>
                                    <td>: {{ $investment->roi_bot }}% - {{ $investment->roi_top }}% </td>
                                </tr>
                                <tr>
                                    <td>No Rekening</td>
                                    <td>: {{ $investment->bank }} {{ $investment->no_rekening }} ({{ $investment->atas_nama }})</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Investor List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>                  
                            <tr>
                                <th>Nama Investor</th>
                                <th>Email Investor</th>
                                <!-- <th>No Handphone</th> -->
                                <th>Lembar beli</th>
                                <th>Total harga</th>
                                <th>Tanggal investasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($investor as $invest)
                            <tr>
                                <td>{{ $invest->nama_investor }}</td>
                                <td>{{ $invest->email_investor }}</td>
                                {{-- <!-- <td>{{ $detinvestor->mobile_no }}</td> --> --}}
                                <td>{{ $invest->lembar_beli }}</td>
                                <td>{{ $invest->total_harga }}</td>
                                <td>{{ $invest->order_date}}</td>
                                <td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $investor->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> --}}
                    </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <form method="POST" role="form" id="quickForm" enctype="multipart/form-data"
                action="{{ route('dashboard.investee.upload-progress', $investment->id) }}">
                @csrf
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
                            <div class="col text-center">
                            <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                        </div>
                        </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Progress Project List Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @foreach($listprogres as $list)
                    <ul class="list-group">
                        <li class="list-group-item" data-toggle="modal" data-target="#modal-{{ $list->id }}">{{ $list->deskripsi_laporan }} ({{ $list->tgl }})</li>
                            <div class="modal fade" id="modal-{{ $list->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Progress Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>{{ $list->tgl }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi Laporan</td>
                                                        <td>{{ $list->deskripsi_laporan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan tambahan</td>
                                                        <td>{{ $list->keterangan_tambahan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berkas Laporan</td>
                                                        <td>
                                                            <form action="{{ route('dashboard.investee.download-progress', $list->id) }}" method="get">
                                                                <button type="submit" class="btn btn-sm btn-block btn-primary mr-4">Download</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                          <!-- /.modal-content -->
                                </div>
                                        <!-- /.modal-dialog -->
                            </div>
                              <!-- /.modal -->
                    </ul>
                    @endforeach
                    </div>
                    <!-- card-body -->
                    <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $listprogres->links() }}
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
                    required: "Berkas Dibutuhkan",
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