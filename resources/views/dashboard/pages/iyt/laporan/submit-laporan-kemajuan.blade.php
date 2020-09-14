@extends('dashboard.layout')

@section('title', 'Submit Laporan Kemajuan')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Submit laporan kemajuan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">IYT</li>
                    <li class="breadcrumb-item active">Submit-Laporan-Kemajuan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- main content --}}
<section class="content">
    @if (Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>

    @elseif (Session::has('error'))
    <div class="alert alert-danger" role="alert">

        <strong>Errors:</strong>
        <ul>
            @foreach(Session::get('error') as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (count($errors) > 0)

    <div class="alert alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
            @foreach ($errors as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif
    <div class="container-fluid">
        <form method="POST" role="form" id="form-laporan" action="{{ route('dashboard.iyt.submit-laporan-kemajuan') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Detail Laporan</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="input-bulan">Laporan untuk bulan</label>
                                        <select name="bulan-laporan" class="form-control" id="input-bulan">
                                            <option value="0">-pilih bulan-</option>
                                            <option value="1" {{ (old('bulan-laporan') == '1' ? "selected":"") }}>Januari</option>
                                            <option value="2" {{ (old('bulan-laporan') == '2' ? "selected":"") }}>Februari</option>
                                            <option value="3" {{ (old('bulan-laporan') == '3' ? "selected":"") }}>Maret</option>
                                            <option value="4" {{ (old('bulan-laporan') == '4' ? "selected":"") }}>April</option>
                                            <option value="5" {{ (old('bulan-laporan') == '5' ? "selected":"") }}>Mei</option>
                                            <option value="6" {{ (old('bulan-laporan') == '6' ? "selected":"") }}>Juni</option>
                                            <option value="7" {{ (old('bulan-laporan') == '7' ? "selected":"") }}>Juli</option>
                                            <option value="8" {{ (old('bulan-laporan') == '8' ? "selected":"") }}>Agustus</option>
                                            <option value="9" {{ (old('bulan-laporan') == '9' ? "selected":"") }}>September</option>
                                            <option value="10" {{ (old('bulan-laporan') == '10' ? "selected":"") }}>Oktober</option>
                                            <option value="11" {{ (old('bulan-laporan') == '11' ? "selected":"") }}>November</option>
                                            <option value="12" {{ (old('bulan-laporan') == '12' ? "selected":"") }}>Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="input-tahun">Tahun</label>
                                        <select name="tahun-laporan" class="form-control" id="input-tahun">
                                            <option value="2020" {{ (old('tahun-laporan') == '2020' ? "selected":"") }}>2020</option>
                                            <option value="2021" {{ (old('tahun-laporan') == '2021' ? "selected":"") }}>2021</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="laporan-kemajuan" class="">{{ __('Berkas Laporan kemajuan') }}</label><span
                                    class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="laporan-kemajuan"
                                            for="berkas-laporan-kemajuan">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="berkas-laporan-kemajuan"
                                            id="berkas-laporan-kemajuan" aria-describedby="inputGroupFileAddon03"
                                            accept="application/pdf">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="laporan-rekapitulasi" class="">{{ __('Berkas Laporan rekapitulasi') }}</label><span
                                    class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <label class="custom-file-label" id="laporan-rekapitulasi"
                                            for="berkas-laporan-rekapitulasi">Upload Berkas</label>
                                        <input type="file" class="custom-file-input" name="berkas-laporan-rekapitulasi"
                                            id="berkas-laporan-rekapitulasi" aria-describedby="inputGroupFileAddon03"
                                            accept="application/pdf">
                                    </div>
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
<script type="text/javascript">
    $('#berkas-laporan-rekapitulasi').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#laporan-rekapitulasi').html(fileName);
    });
    $('#berkas-laporan-kemajuan').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#laporan-kemajuan').html(fileName);
    });

</script>



@endsection
