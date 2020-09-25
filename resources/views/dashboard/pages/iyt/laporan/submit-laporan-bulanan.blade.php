@extends('dashboard.layout')

@section('title', 'Submit Laporan Progres Bulanan')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Submit laporan bulanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">IYT</li>
                    <li class="breadcrumb-item active">Submit-Laporan-Bulanan</li>
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
        <form method="POST" role="form" id="form-laporan" action="{{ route('dashboard.iyt.submit-laporan-bulanan') }}" enctype="multipart/form-data">
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
                            <div>
                                Dowload Cover Laporan Keuangan <a href="/download/cover-laporan-keuangan">disini</a>
                            </div>
                            <div class="form-group">
                                <label for="laporan-keuangan" class="">{{ __('Berkas Laporan Keuangan') }}</label><span class="red-str">*</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                      </button>
                                    </div>
                                    <div class="custom-file">
                                      <label class="custom-file-label" id="laporan-keuangan" for="berkas-laporan-keuangan">Upload Berkas</label>
                                      <input type="file" class="custom-file-input" name="berkas-laporan-keuangan" id="berkas-laporan-keuangan" aria-describedby="inputGroupFileAddon03" accept="application/pdf"> 
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

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        1. Manajemen Tim
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Organigram antara anggota tim</li>
                                        <li>Memiliki Job Description antara anggota tim (untuk dimasukkan dalam buku SOP)</li>
                                        <li>Memiliki komitmen tertulis antara anggota tim</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="1alabel">Bagaimanakah struktur usaha?</label>
                                        <textarea type="text" name="indikator-1a" class="form-control" id="1alabel"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-1a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="1b">Bagaimanakah peran masing-masing bagian?</label>
                                        <textarea type="text" name="indikator-1b" class="form-control" id="1b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-1b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="1c">Apa sajakah kesepakatan yang telah dibuat?</label>
                                        <textarea type="text" name="indikator-1c" class="form-control" id="1c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-1c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        2. Stok Bahan Baku
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Format Buku Cek Stok (untuk dimasukkan dalam buku SOP)</li>
                                        <li>Memiliki Rencana Belanja Bahan Baku Rutin</li>
                                        <li>Memiliki SOP Pembelian-Penyimpanan-Distribusi (untuk dimasukkan dalam buku SOP)</li>
                                        <li>Memiliki List Supplier Bahan Baku (untuk 1 item, diusahakan minimal ada 2 supplier)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="2a">Seberapa banyak kita membeli stok?</label>
                                        <textarea type="text" name="indikator-2a" class="form-control" id="2a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-2a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="2b">Bagaimana membeli stok bahan baku ketika diawal usaha?</label>
                                        <textarea type="text" name="indikator-2b" class="form-control" id="2b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-2b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="2c">Hal apa sajakah yang perlu dipertimbangkan?</label>
                                        <textarea type="text" name="indikator-2c" class="form-control" id="2c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-2c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        3. Proses Produksi
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki SOP Produksi Efisien</li>
                                        <li>Memiliki List Rencana Investasi Peralatan yang dapat meningkatkan efisiensi produksi</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="3a">Siapakah yg sebaiknya diawal melakukan proses produksi?</label>
                                        <textarea type="text" name="indikator-3a" class="form-control" id="3a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-3a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="3b">Bagaimana membuat proses produksi efisien?</label>
                                        <textarea type="text" name="indikator-3b" class="form-control" id="3b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-3b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="3c">Apakah alat produksi mutlak harus dimiliki diawal usaha?</label>
                                        <textarea type="text" name="indikator-3c" class="form-control" id="3c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-3c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        4. Distribusi Produk
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Perhitungan Biaya Distribusi Bahan Baku & Barang Jadi (untuk konsumen)</li>
                                        <li>Memiliki Armada Distribusi (hak milik/sewa)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="4a">Bagaimana distribusi bahan baku ke rumah produksi?</label>
                                        <textarea type="text" name="indikator-4a" class="form-control" id="4a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-4a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="4b">Bagaimana strategi distribusi ke konsumen (delivery order)?</label>
                                        <textarea type="text" name="indikator-4b" class="form-control" id="4b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-4b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="4c">Berapa minimum produk bisa diantar?</label>
                                        <textarea type="text" name="indikator-4c" class="form-control" id="4c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-4c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        5. Marketing
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Rencana Strategi Marketing Standar & Strategi Marketing Bulanan (atau eventual) selama setahun</li>
                                        <li>Memiliki Budget Marketing yang sesuai dengan impact yang ingin dicapai</li>
                                        <li>Memiliki Metode Pengukuran Keberhasilan Marketing</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="5a">Apa sajakah strategi marketing yang dilakukan?</label>
                                        <textarea type="text" name="indikator-5a" class="form-control" id="5a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-5a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="5b">Berapa budget marketing tiap bulan?</label>
                                        <textarea type="text" name="indikator-5b" class="form-control" id="5b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-5b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="5c">Bagaimana mengukur keberhasilan marketing yang dilakukan?</label>
                                        <textarea type="text" name="indikator-5c" class="form-control" id="5c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-5c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        6. Customer Service
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki List FAQ (Frequently Asked Question) mengenai segala hal yang berhubungan dengan pelayanan konsumen (untuk dimasukkan dalam Buku SOP)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="6a">Apa yang dilakukan kalau ada konsumen marah?</label>
                                        <textarea type="text" name="indikator-6a" class="form-control" id="6a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-6a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="6b">Bagaimana mengetahui tingkat kepuasan konsumen?</label>
                                        <textarea type="text" name="indikator-6b" class="form-control" id="6b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-6b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="6c">Pelayanan apa yang diberikan setelah barang terjual?</label>
                                        <textarea type="text" name="indikator-6c" class="form-control" id="6c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-6c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        7. Research and Development (RnD)
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Rencana Pengembangan Produk Selama Satu Tahun (mengapa 1 tahun karena berhubungan dengan budgetting plan & tutup buku akhir tahun)</li>
                                        <li>Memiliki SDM RnD</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="7a">Seperti apakah program pengembangan produk?</label>
                                        <textarea type="text" name="indikator-7a" class="form-control" id="7a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-7a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="7b">Apa yang menjadi pertimbangan arah RnD?</label>
                                        <textarea type="text" name="indikator-7b" class="form-control" id="7b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-7b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="7c">Siapakah yang melakukan program RnD?</label>
                                        <textarea type="text" name="indikator-7c" class="form-control" id="7c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-7c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        8. Alokasi Pendanaan Start Up
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Budgetting Plan Selama 1 bulan awal (detail per hari) dan juga Selama 1 Tahun (Per bulan)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="8a">Berapa biaya yang digunakan untuk start up?</label>
                                        <textarea type="text" name="indikator-8a" class="form-control" id="8a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-8a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="8b">Barang-barang apa saja yang dibeli saat start up?</label>
                                        <textarea type="text" name="indikator-8b" class="form-control" id="8b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-8b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="8c">Bagaimana cara menghemat biaya start up?</label>
                                        <textarea type="text" name="indikator-8c" class="form-control" id="8c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-8c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        9. Lokasi Perusahaan
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Rumah Produksi Khusus yang berbeda dengan lokasi penjualan (bisa juga sebagai gudang)</li>
                                        <li>Memiliki List Target Lokasi yang diinginkan (Alamat lengkap & CP yang bisa dihubungi)</li>
                                        <li>Memiliki Standar Pemilihan Lokasi (untuk dimasukkan dalam Buku SOP)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="9a">Dimanakah proses produksi berjalan saat diawal?</label>
                                        <textarea type="text" name="indikator-9a" class="form-control" id="9a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-9a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="9b">Apakah perlu kita memilih posisi strategis?</label>
                                        <textarea type="text" name="indikator-9b" class="form-control" id="9b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-9b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="9c">Apa pertimbangan memilih lokasi?</label>
                                        <textarea type="text" name="indikator-9c" class="form-control" id="9c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-9c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        10. Pencatatan Keuangan
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Menggunakan komputerisasi dalam pencatatan keuangan (minimal ms Excel, lebih dianjurkan software akuntansi)</li>
                                        <li>Memiliki Buku Jurnal Tertulis (minimal tentang uang keluar masuk)</li>
                                        <li>Memiliki Rekening Tabungan Bisnis</li>
                                        <li>Memiliki Sistem Validasi Omset-Stok (untuk memastikan kejujuran karyawan)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="10a">Bagaimanakah format pencatatan keuangan yang dilakukan?</label>
                                        <textarea type="text" name="indikator-10a" class="form-control" id="10a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-10a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="10b">Apa sajakah yang harus dicatat?</label>
                                        <textarea type="text" name="indikator-10b" class="form-control" id="10b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-10b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="10c">Bagaimana mengurangi faktor resiko, pencatatan tidak sama dengan barang yang terjual? </label>
                                        <textarea type="text" name="indikator-10c" class="form-control" id="10c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-10c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        11. Brand, Tagline, dan Positioning Usaha
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Marketing Tools (Logo, Brosur, Namecard, dll)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="11a">Apa alasan memilih brand saat ini?</label>
                                        <textarea type="text" name="indikator-11a" class="form-control" id="11a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-11a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="11b">Apakah tips memilih logo yang tepat?</label>
                                        <textarea type="text" name="indikator-11b" class="form-control" id="11b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-11b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="11c">Apa tagline-nya? Dan apa pengaruhnya dengan positioning?</label>
                                        <textarea type="text" name="indikator-11c" class="form-control" id="11c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-11c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        12. Management Karyawan
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki standar kriteria karyawan </li>
                                        <li>Mengetahui besaran gaji karyawan</li>
                                        <li>Memiliki alat ukur kinerja karyawan</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="12a">Bagaimana cara merekrut karyawan?</label>
                                        <textarea type="text" name="indikator-12a" class="form-control" id="12a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-12a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="12b">Bagaimana cara perhitungan gaji karyawan diawal?</label>
                                        <textarea type="text" name="indikator-12b" class="form-control" id="12b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-12b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="12c">Bagaimana cara mengontrol karyawan? </label>
                                        <textarea type="text" name="indikator-12c" class="form-control" id="12c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-12c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        13. Harga Jual dan Profit
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki simulasi budgetting Plan dan Proyeksi Keuntungan (dianjurkan menggunakan Ms Excel)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="13a">Bagaimana cara menentukan harga jual?</label>
                                        <textarea type="text" name="indikator-13a" class="form-control" id="13a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-13a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="13b">Seberapa besar profit yang bisa diambil?</label>
                                        <textarea type="text" name="indikator-13b" class="form-control" id="13b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-13b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="13c">Apabila ada pesaing dengan harga murah, apa yang harus dilakukan?</label>
                                        <textarea type="text" name="indikator-13c" class="form-control" id="13c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-13c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        14. Legalitas Usaha
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki Badan Usaha (CV, UD, Koperasi, atau PT)</li>
                                        <li>Telah melakukan daftar merk (atas nama pribadi atau badan usaha) availabilitas merk bisa di cek pada website dgip.go.id</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="14a">Apakah dari awal sudah berbadan hukum?</label>
                                        <textarea type="text" name="indikator-14a" class="form-control" id="14a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-14a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="14b">Apakah keuntungan & kerugian punya badan hukum?</label>
                                        <textarea type="text" name="indikator-14b" class="form-control" id="14b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-14b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="14c">Apakah sudah mendaftarkan merek? Bgaiamana caranya?</label>
                                        <textarea type="text" name="indikator-14c" class="form-control" id="14c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-14c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        15. Pesaing
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Memiliki List Kompetitor lengkap dengan deskripsinya (termasuk SWOT mereka)</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="15a">Apa sajakah pesaing usaha ini?</label>
                                        <textarea type="text" name="indikator-15a" class="form-control" id="15a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-15a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="15b">Bagaiamana strategi menghadapi mereka?</label>
                                        <textarea type="text" name="indikator-15b" class="form-control" id="15b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-15b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="15c">Apakah pernah terjadi konflik?</label>
                                        <textarea type="text" name="indikator-15c" class="form-control" id="15c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-15c')  }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="proses-bisnis">
                                <div class="catatan-pertanyaan">
                                    <p>
                                        16. Penghasilan Owner
                                    </p>
                                    Catatan:
                                    <ul>
                                        <li>Ada kesepakatan yang tertuang dalam komitmen terlulis di awal mengenai formulasi gaji owner-laba ditahan, bagi hasil akhir tahun, dll</li>
                                    </ul>
                                </div>
                                <div class="pertanyaan">
                                    <div class="form-group">
                                        <label for="16a">Bagaimana cara menentukan gaji owner?</label>
                                        <textarea type="text" name="indikator-16a" class="form-control" id="16a"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-16a')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="16b">Seberapa besar laba ditahan untuk keberlangsungan usaha?</label>
                                        <textarea type="text" name="indikator-16b" class="form-control" id="16b"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-16b')  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="16c">Apakah ada pengaruh kinerja antara owner yang digaji dengan tidak digaji?</label>
                                        <textarea type="text" name="indikator-16c" class="form-control" id="16c"
                                            placeholder="Indikator ketercapaian ... ">{{  old('indikator-16c')  }}</textarea>
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
                "indikator-1c": {
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
                "indikator-3a": {
                    required: true,
                },
                "indikator-3b": {
                    required: true,
                },
                "indikator-3c": {
                    required: true,
                },
                "indikator-4a": {
                    required: true,
                },
                "indikator-4b": {
                    required: true,
                },
                "indikator-4c": {
                    required: true,
                },
                "indikator-5a": {
                    required: true,
                },
                "indikator-5b": {
                    required: true,
                },
                "indikator-5c": {
                    required: true,
                },
                "indikator-6a": {
                    required: true,
                },
                "indikator-6b": {
                    required: true,
                },
                "indikator-6c": {
                    required: true,
                },
                "indikator-7a": {
                    required: true,
                },
                "indikator-7b": {
                    required: true,
                },
                "indikator-7c": {
                    required: true,
                },
                "indikator-8a": {
                    required: true,
                },
                "indikator-8b": {
                    required: true,
                },
                "indikator-8c": {
                    required: true,
                },
                "indikator-9a": {
                    required: true,
                },
                "indikator-9b": {
                    required: true,
                },
                "indikator-9c": {
                    required: true,
                },
                "indikator-10a": {
                    required: true,
                },
                "indikator-10b": {
                    required: true,
                },
                "indikator-10c": {
                    required: true,
                },
                "indikator-11a": {
                    required: true,
                },
                "indikator-11b": {
                    required: true,
                },
                "indikator-11c": {
                    required: true,
                },
                "indikator-12a": {
                    required: true,
                },
                "indikator-12b": {
                    required: true,
                },
                "indikator-12c": {
                    required: true,
                },
                "indikator-13a": {
                    required: true,
                },
                "indikator-13b": {
                    required: true,
                },
                "indikator-13c": {
                    required: true,
                },
                "indikator-14a": {
                    required: true,
                },
                "indikator-14b": {
                    required: true,
                },
                "indikator-14c": {
                    required: true,
                },
                "indikator-15a": {
                    required: true,
                },
                "indikator-15b": {
                    required: true,
                },
                "indikator-15c": {
                    required: true,
                },
                "indikator-16a": {
                    required: true,
                },
                "indikator-16b": {
                    required: true,
                },
                "indikator-16c": {
                    required: true,
                },
            },
            messages: {
                "indikator-1a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-1b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-1c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-2a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-2b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-2c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-3a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-3b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-3c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-4a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-4b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-4c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-5a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-5b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-5c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-6a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-6b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-6c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-7a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-7b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-7c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-8a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-8b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-8c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-9a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-9b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-9c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-10a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-10b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-10c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-11a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-11b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-11c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-12a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-12b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-12c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-13a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-13b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-13c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-14a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-14b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-14c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-15a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-15b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-15c": {
                    required: "Silahkan isi indikator"
                },
                "indikator-16a": {
                    required: "Silahkan isi indikator"
                },
                "indikator-16b": {
                    required: "Silahkan isi indikator"
                },
                "indikator-16c": {
                    required: "Silahkan isi indikator"
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
    $('#berkas-laporan-keuangan').change(function(e){
		var fileName = e.target.files[0].name;
        // dd(fileName);
        $('#laporan-keuangan').html(fileName);
	});
</script>



@endsection
