@extends('dashboard.layout')

@section('title', 'Submit Laporan Kontrol Bulanan')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Submit kontrol bulanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">IYT</li>
                    <li class="breadcrumb-item active">Submit-Kontrol-Bulanan</li>
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
        <form method="POST" role="form" id="form-laporan" action="{{ route('dashboard.iyt.submit-kontrol-bulanan') }}"
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
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                        </select>
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
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Indikator Laporan</h3>
                        </div>
                        <div class="card-body">
                            <div class="aspek">
                                <div class="judul-aspek">
                                    <p>
                                        1. Proses kegiatan usaha IYT
                                    </p>
                                </div>
                                <div class="indikator">
                                    <div class="penilaian">
                                        <p>
                                            a. Apakah usaha masih berjalan?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1a" id="pilihan-1a-4"
                                                    value="4.Berjalan dengan keuntungan dan terus meningkat" {{ (old('indikator-1a') == '4.Berjalan dengan keuntungan dan terus meningkat' ? "checked":"") }}>
                                                <label for="pilihan-1a-4">[Nilai=4] Berjalan dengan keuntungan dan terus
                                                    meningkat</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1a" id="pilihan-1a-3"
                                                    value="3.Berjalan dengan keuntungan stabil" {{ (old('indikator-1a') == '3.Berjalan dengan keuntungan stabil' ? "checked":"") }}>
                                                <label for="pilihan-1a-3">[Nilai=3] Berjalan dengan keuntungan stabil</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1a" id="pilihan-1a-2"
                                                    value="2.Berjalan tetapi rugi" {{ (old('indikator-1a') == '2.Berjalan tetapi rugi' ? "checked":"") }}>
                                                <label for="pilihan-1a-2">[Nilai=2] Berjalan tetapi rugi</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1a" id="pilihan-1a-1"
                                                    value="1.Tidak berjalan" {{ (old('indikator-1a') == '1.Tidak berjalan' ? "checked":"") }}>
                                                <label for="pilihan-1a-1">[Nilai=1] Tidak berjalan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-1a">Komentar</label>
                                            <textarea type="text" name="komentar-1a" class="form-control" id="komentar-1a"
                                                placeholder="Apa alasannya jika tidak berjalan? Jika untung / rugi berapa jumlahnya?">{{  old('komentar-1a')  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            b. Apakah anda masih akan melanjutkan usaha ini?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1b" id="pilihan-1b-4"
                                                    value="4.Saya lanjutkan dan terus saya kembangkan" {{ (old('indikator-1b') == '4.Saya lanjutkan dan terus saya kembangkan' ? "checked":"") }}>
                                                <label for="pilihan-1b-4">[Nilai=4] Saya lanjutkan dan terus saya kembangkan</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1b" id="pilihan-1b-3"
                                                    value="3.Saya lanjutkan seadanya dulu" {{ (old('indikator-1b') == '3.Saya lanjutkan seadanya dulu' ? "checked":"") }}>
                                                <label for="pilihan-1b-3">[Nilai=3] Saya lanjutkan seadanya dulu</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1b" id="pilihan-1b-2"
                                                    value="2.Saya lanjutkan tetapi dengan beberapa syarat" {{ (old('indikator-1b') == '2.Saya lanjutkan tetapi dengan beberapa syarat' ? "checked":"") }}>
                                                <label for="pilihan-1b-2">[Nilai=2] Saya lanjutkan tetapi dengan beberapa syarat</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-1b" id="pilihan-1b-1"
                                                    value="1.Tidak saya lanjutkan" {{ (old('indikator-1b') == '1.Tidak saya lanjutkan' ? "checked":"") }}>
                                                <label for="pilihan-1b-1">[Nilai=1] Tidak saya lanjutkan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-1b">Komentar</label>
                                            <textarea type="text" name="komentar-1b" class="form-control" id="komentar-1b"
                                                placeholder="Apa alasannya?">{{  old('komentar-1b')  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="aspek">
                                <div class="judul-aspek">
                                    <p>
                                        2. Kejelasan Mekanisme Pelaksanaan
                                    </p>
                                </div>
                                <div class="indikator">
                                    <div class="penilaian">
                                        <p>
                                            a. Apakah Apakah rancangan yang dibuat dalam proposal IYT bisa dilaksanakan?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2a" id="pilihan-2a-4"
                                                    value="4.Berjalan tepat sesuai dengan proposal IYT" {{ (old('indikator-2a') == '4.Berjalan tepat sesuai dengan proposal IYT' ? "checked":"") }}>
                                                <label for="pilihan-2a-4">[Nilai=4] Berjalan tepat sesuai dengan proposal IYT</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2a" id="pilihan-2a-3"
                                                    value="3.Berjalan dengan sedikit modifikasi proposal IYT" {{ (old('indikator-2a') == '3.Berjalan dengan sedikit modifikasi proposal IYT' ? "checked":"") }}>
                                                <label for="pilihan-2a-3">[Nilai=3] Berjalan dengan sedikit modifikasi proposal IYT</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2a" id="pilihan-2a-2"
                                                    value="2.Berjalan dengan banyak modifikasi proposal IYT" {{ (old('indikator-2a') == '2.Berjalan dengan banyak modifikasi proposal IYT' ? "checked":"") }}>
                                                <label for="pilihan-2a-2">[Nilai=2] Berjalan dengan banyak modifikasi proposal IYT</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2a" id="pilihan-2a-1"
                                                    value="1.Tidak berjalan" {{ (old('indikator-2a') == '1.Tidak berjalan' ? "checked":"") }}>
                                                <label for="pilihan-2a-1">[Nilai=1] Tidak berjalan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-2a">Komentar</label>
                                            <textarea type="text" name="komentar-2a" class="form-control" id="komentar-2a"
                                                placeholder="Apa modifikasinya?">{{  old('komentar-2a')  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            b. Apakah ada upaya untuk memperbaiki pelaksanaan?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2b" id="pilihan-2b-4"
                                                    value="4.Sudah diperbaiki dan sudah ada rencana perbaikan" {{ (old('indikator-2b') == '4.Sudah diperbaiki dan sudah ada rencana perbaikan' ? "checked":"") }}>
                                                <label for="pilihan-2b-4">[Nilai=4] Sudah diperbaiki dan sudah ada rencana perbaikan</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2b" id="pilihan-2b-3"
                                                    value="3.Akan diperbaiki dan sudah ada rencana perbaikan" {{ (old('indikator-2b') == '3.Akan diperbaiki dan sudah ada rencana perbaikan' ? "checked":"") }}>
                                                <label for="pilihan-2b-3">[Nilai=3] Akan diperbaiki dan sudah ada rencana perbaikan</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2b" id="pilihan-2b-2"
                                                    value="2.Akan dperbaiki tapi belum ada rencana perbaikan" {{ (old('indikator-2b') == '2.Akan dperbaiki tapi belum ada rencana perbaikan' ? "checked":"") }}>
                                                <label for="pilihan-2b-2">[Nilai=2] Akan dperbaiki tapi belum ada rencana perbaikan</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2b" id="pilihan-2b-1"
                                                    value="1.Tidak ada upaya perbaikan" {{ (old('indikator-2b') == '1.Tidak ada upaya perbaikan' ? "checked":"") }}>
                                                <label for="pilihan-2b-1">[Nilai=1] Tidak ada upaya perbaikan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-2b">Komentar</label>
                                            <textarea type="text" name="komentar-2b" class="form-control" id="komentar-2b"
                                                placeholder="Apa langkah perbaikannya?">{{  old('komentar-2b')  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            c. Bagaimanakah hasil usaha setelah dilakukan perbaikan?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2c" id="pilihan-2c-4"
                                                    value="4.Profit meningkat" {{ (old('indikator-2c') == '4.Profit meningkat' ? "checked":"") }}>
                                                <label for="pilihan-2c-4">[Nilai=4] Profit meningkat</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2c" id="pilihan-2c-3"
                                                    value="3.Profit stabil" {{ (old('indikator-2c') == '3.Profit stabil' ? "checked":"") }}>
                                                <label for="pilihan-2c-3">[Nilai=3] Profit stabil</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2c" id="pilihan-2c-2"
                                                    value="2.Profit menurun" {{ (old('indikator-2c') == '2.Profit menurun' ? "checked":"") }}>
                                                <label for="pilihan-2c-2">[Nilai=2] Profit menurun</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2c" id="pilihan-2c-1"
                                                    value="1.Tidak profit" {{ (old('indikator-2c') == '1.Tidak profit' ? "checked":"") }}>
                                                <label for="pilihan-2c-1">[Nilai=1] Tidak profit</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-2c">Komentar</label>
                                            <textarea type="text" name="komentar-2c" class="form-control" id="komentar-2c"
                                                placeholder="Apa alasannya?">{{  old('komentar-2c')  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            d. Apakah ada usaha pengembangan?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2d" id="pilihan-2d-4"
                                                    value="4.Sudah dilakukan pengembangan bisnis dan ada rencana pengembangan bisnis" {{ (old('indikator-2d') == '4.Sudah dilakukan pengembangan bisnis dan ada rencana pengembangan bisnis' ? "checked":"") }}>
                                                <label for="pilihan-2d-4">[Nilai=4] Sudah dilakukan pengembangan bisnis dan ada rencana pengembangan bisnis</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2d" id="pilihan-2d-3"
                                                    value="3.Sudah ada pengembangan bisnis tetapi tidak ada rencana pengembangan bisnis" {{ (old('indikator-2d') == '3.Sudah ada pengembangan bisnis tetapi tidak ada rencana pengembangan bisnis' ? "checked":"") }}>
                                                <label for="pilihan-2d-3">[Nilai=3] Sudah ada pengembangan bisnis tetapi tidak ada rencana pengembangan bisnis</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2d" id="pilihan-2d-2"
                                                    value="2.Belum ada pengembangan bisnis tetapi sudah ada rencana pengembangan bisnis" {{ (old('indikator-2d') == '2.Belum ada pengembangan bisnis tetapi sudah ada rencana pengembangan bisnis' ? "checked":"") }}>
                                                <label for="pilihan-2d-2">[Nilai=2] Belum ada pengembangan bisnis tetapi sudah ada rencana pengembangan bisnis</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-2d" id="pilihan-2d-1"
                                                    value="1.Tidak ada rencana pengembangan bisnis" {{ (old('indikator-2d') == '1.Tidak ada rencana pengembangan bisnis' ? "checked":"") }}>
                                                <label for="pilihan-2d-1">[Nilai=1] Tidak ada rencana pengembangan bisnis</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-2d">Komentar</label>
                                            <textarea type="text" name="komentar-2d" class="form-control" id="komentar-2d"
                                                placeholder="Apa wujud pengembangan bisnis">{{  old('komentar-2d')  }}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="aspek">
                                <div class="judul-aspek">
                                    <p>
                                        3. Kondisi finansial
                                    </p>
                                </div>
                                <div class="indikator">
                                    <div class="penilaian">
                                        <p>
                                            a. Apakah kondisi keuangan bisnis anda sehat?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3a" id="pilihan-3a-4"
                                                    value="4.Sangat sehat dan tercatat rapih" {{ (old('indikator-3a') == '4.Sangat sehat dan tercatat rapih' ? "checked":"") }}>
                                                <label for="pilihan-3a-4">[Nilai=4] Sangat sehat dan tercatat rapih</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3a" id="pilihan-3a-3"
                                                    value="3.Sehat tetapi tidak tercatat" {{ (old('indikator-3a') == '3.Sehat tetapi tidak tercatat' ? "checked":"") }}>
                                                <label for="pilihan-3a-3">[Nilai=3] Berjalan dengan keuntungan stabil</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3a" id="pilihan-3a-2"
                                                    value="2.Tidak sehat dan tercatat rapi" {{ (old('indikator-3a') == '2.Tidak sehat dan tercatat rapi' ? "checked":"") }}>
                                                <label for="pilihan-3a-2">[Nilai=2] Tidak sehat dan tercatat rapi</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3a" id="pilihan-3a-1"
                                                    value="1.Tidak sehat dan tidak tercatat rapih" {{ (old('indikator-3a') == '1.Tidak sehat dan tidak tercatat rapih' ? "checked":"") }}>
                                                <label for="pilihan-3a-1">[Nilai=1] Tidak sehat dan tidak tercatat rapih</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-3a">Komentar</label>
                                            <textarea type="text" name="komentar-3a" class="form-control" id="komentar-3a"
                                                placeholder="Berapa omzetnya? Berapa keuntungannya? mintalah cashflow / laporan keuangan">{{  old('komentar-3a')  }}</textarea>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            b. Bagaimana kondisi aset anda?
                                        </p>
                                        <div class="form-group">
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3b" id="pilihan-3b-4"
                                                    value="4.Banyak set dan terinventarisir" {{ (old('indikator-3b') == '4.Banyak set dan terinventarisir' ? "checked":"") }}>
                                                <label for="pilihan-3b-4">[Nilai=4] Banyak set dan terinventarisir</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3b" id="pilihan-3b-3"
                                                    value="3.Banyak aset tetapi tidak terinventarisir" {{ (old('indikator-3b') == '3.Banyak aset tetapi tidak terinventarisir' ? "checked":"") }}>
                                                <label for="pilihan-3b-3">[Nilai=3] Banyak aset tetapi tidak terinventarisir</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3b" id="pilihan-3b-2"
                                                    value="2.Tidak banyak aset tetapi terinventarisir" {{ (old('indikator-3b') == '2.Tidak banyak aset tetapi terinventarisir' ? "checked":"") }}>
                                                <label for="pilihan-3b-2">[Nilai=2] Tidak banyak aset tetapi terinventarisir</label>
                                            </div>
                                            <div class="sub-indikator">
                                                <input type="radio" name="indikator-3b" id="pilihan-3b-1"
                                                    value="1.Tidak ada aset" {{ (old('indikator-3b') == '1.Tidak ada aset' ? "checked":"") }}>
                                                <label for="pilihan-3b-1">[Nilai=1] Tidak ada aset</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar-3b">Komentar</label>
                                            <textarea type="text" name="komentar-3b" class="form-control" id="komentar-3b"
                                                placeholder="Sebutkan aset yang dimiliki dan nilai aset tersebut">{{  old('komentar-3b')  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="aspek">
                                <div class="judul-aspek">
                                    <p>
                                        4. Dokumentasi lokasi, produk, proses pengolahan, dan pelaksana IYT
                                    </p>
                                </div>
                                <div class="indikator">
                                    <div class="form-group">
                                        <div class="sub-indikator">
                                            <input type="radio" name="indikator-4" id="pilihan-4-1"
                                                value="Ada" {{ (old('indikator-4') == 'Ada' ? "checked":"") }}>
                                            <label for="pilihan-4-1">Ada</label>
                                        </div>
                                        <div class="sub-indikator">
                                            <input type="radio" name="indikator-4" id="pilihan-4-2"
                                                value="Tidak ada" {{ (old('indikator-4') == 'Tidak ada' ? "checked":"") }}>
                                            <label for="pilihan-4-2">Tidak ada</label>
                                        </div>
                                    </div>
                                    <div>
                                        Jika terdapat lebih dari satu file silahkan digabung menjadi satu pdf terlebih dahulu
                                    </div>
                                    <div class="form-group">
                                        <label for="dokumentasi" class="">{{ __('File dokumentasi') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="custom-file">
                                                <label class="custom-file-label" id="dokumentasi"
                                                    for="berkas-dokumentasi">Upload Berkas</label>
                                                <input type="file" class="custom-file-input" name="berkas-dokumentasi"
                                                    id="berkas-dokumentasi" aria-describedby="inputGroupFileAddon03"
                                                    accept="application/pdf">
                                            </div>
                                        </div>
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
{{-- jquery-validation --}}
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('dashboard_resources') }}/plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                // alert( "Form successful submitted!" );
                // console.log('masuk');
                if ($('#form-laporan').valid()) {
                    $('#form-laporan')[0].submit();
                }

            }
        });
        $('#form-laporan').validate({
            rules: {
                "indikator-1a": {
                    required: true,
                },
                "indikator-1b": {
                    required: true,
                },
                "indikator-2a": {
                    required: true,
                },
                "indikator-2b": {
                    required: true,
                },
                "indikator-2c": {
                    required: true,
                },
                "indikator-2d": {
                    required: true,
                },
                "indikator-3a": {
                    required: true,
                },
                "indikator-3b": {
                    required: true,
                },
                "indikator-4": {
                    required: true,
                },
                "komentar-1a": {
                    required: true,
                },
                "komentar-1b": {
                    required: true,
                },
                "komentar-2a": {
                    required: true,
                },
                "komentar-2b": {
                    required: true,
                },
                "komentar-2c": {
                    required: true,
                },
                "komentar-2d": {
                    required: true,
                },
                "komentar-3a": {
                    required: true,
                },
                "komentar-3b": {
                    required: true,
                },
            },
            messages: {
                "indikator-1a": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-1b": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-2a": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-2b": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-2c": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-2d": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-3a": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-3b": {
                    required: "Silahkan pilih indikator"
                },
                "indikator-4": {
                    required: "Silahkan pilih indikator"
                },
                "komentar-1a": {
                    required: "Silahkan isi alasan"
                },
                "komentar-1b": {
                    required: "Silahkan isi alasan"
                },
                "komentar-2a": {
                    required: "Silahkan isi alasan"
                },
                "komentar-2b": {
                    required: "Silahkan isi alasan"
                },
                "komentar-2c": {
                    required: "Silahkan isi alasan"
                },
                "komentar-2d": {
                    required: "Silahkan isi alasan"
                },
                "komentar-3a": {
                    required: "Silahkan isi alasan"
                },
                "komentar-3b": {
                    required: "Silahkan isi alasan"
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

<script type="text/javascript">
    $('#berkas-laporan-rekapitulasi').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#laporan-rekapitulasi').html(fileName);
    });
    $('#berkas-dokumentasi').change(function (e) {
        var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#dokumentasi').html(fileName);
    });

</script>



@endsection
