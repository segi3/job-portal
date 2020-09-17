@extends('dashboard.layout')

@section('title', 'Laporan Progres Bulanan')

@section('stylesheets')

@endsection

@section('content')
{{-- content header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Laporan Bulanan kelompok {{ $data_kelompok->nama_kelompok }}</h1>
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
                                <div class="col-lg-12">
                                    <div>
                                        nama kelompok : {{ $data_kelompok->nama_kelompok }}
                                    </div>
                                    <div>
                                        nama ketua : {{ $data_kelompok->nama_ketua }}
                                    </div>
                                    <div>
                                        laporan untuk : bulan {{ $laporan->bulan }} tahun {{ $laporan->tahun }}
                                    </div>
                                    <div>
                                        laporan keuangan : <a href="#">link download berkas</a>
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
                                        <p>
                                            {{ $laporan->indikator_1a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="1b">Bagaimanakah peran masing-masing bagian?</label>
                                        <p>
                                            {{ $laporan->indikator_1b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="1c">Apa sajakah kesepakatan yang telah dibuat?</label>
                                        <p>
                                            {{ $laporan->indikator_1c }}
                                        </p>                                    
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
                                        <p>
                                            {{ $laporan->indikator_2a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="2b">Bagaimana membeli stok bahan baku ketika diawal usaha?</label>
                                        <p>
                                            {{ $laporan->indikator_2b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="2c">Hal apa sajakah yang perlu dipertimbangkan?</label>
                                        <p>
                                            {{ $laporan->indikator_2c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_3a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="3b">Bagaimana membuat proses produksi efisien?</label>
                                        <p>
                                            {{ $laporan->indikator_3b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="3c">Apakah alat produksi mutlak harus dimiliki diawal usaha?</label>
                                        <p>
                                            {{ $laporan->indikator_3c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_4a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="4b">Bagaimana strategi distribusi ke konsumen (delivery order)?</label>
                                        <p>
                                            {{ $laporan->indikator_4b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="4c">Berapa minimum produk bisa diantar?</label>
                                        <p>
                                            {{ $laporan->indikator_4c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_5a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="5b">Berapa budget marketing tiap bulan?</label>
                                        <p>
                                            {{ $laporan->indikator_5b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="5c">Bagaimana mengukur keberhasilan marketing yang dilakukan?</label>
                                        <p>
                                            {{ $laporan->indikator_5c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_6a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="6b">Bagaimana mengetahui tingkat kepuasan konsumen?</label>
                                        <p>
                                            {{ $laporan->indikator_6b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="6c">Pelayanan apa yang diberikan setelah barang terjual?</label>
                                        <p>
                                            {{ $laporan->indikator_6c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_7a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="7b">Apa yang menjadi pertimbangan arah RnD?</label>
                                        <p>
                                            {{ $laporan->indikator_7b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="7c">Siapakah yang melakukan program RnD?</label>
                                        <p>
                                            {{ $laporan->indikator_7c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_8a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="8b">Barang-barang apa saja yang dibeli saat start up?</label>
                                        <p>
                                            {{ $laporan->indikator_8b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="8c">Bagaimana cara menghemat biaya start up?</label>
                                        <p>
                                            {{ $laporan->indikator_8c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_9a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="9b">Apakah perlu kita memilih posisi strategis?</label>
                                        <p>
                                            {{ $laporan->indikator_9b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="9c">Apa pertimbangan memilih lokasi?</label>
                                        <p>
                                            {{ $laporan->indikator_9c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_10a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="10b">Apa sajakah yang harus dicatat?</label>
                                        <p>
                                            {{ $laporan->indikator_10b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="10c">Bagaimana mengurangi faktor resiko, pencatatan tidak sama dengan barang yang terjual? </label>
                                        <p>
                                            {{ $laporan->indikator_10c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_11a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="11b">Apakah tips memilih logo yang tepat?</label>
                                        <p>
                                            {{ $laporan->indikator_11b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="11c">Apa tagline-nya? Dan apa pengaruhnya dengan positioning?</label>
                                        <p>
                                            {{ $laporan->indikator_11c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_12a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="12b">Bagaimana cara perhitungan gaji karyawan diawal?</label>
                                        <p>
                                            {{ $laporan->indikator_12b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="12c">Bagaimana cara mengontrol karyawan? </label>
                                        <p>
                                            {{ $laporan->indikator_12c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_13a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="13b">Seberapa besar profit yang bisa diambil?</label>
                                        <p>
                                            {{ $laporan->indikator_13b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="13c">Apabila ada pesaing dengan harga murah, apa yang harus dilakukan?</label>
                                        <p>
                                            {{ $laporan->indikator_13c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_14a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="14b">Apakah keuntungan & kerugian punya badan hukum?</label>
                                        <p>
                                            {{ $laporan->indikator_14b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="14c">Apakah sudah mendaftarkan merek? Bgaiamana caranya?</label>
                                        <p>
                                            {{ $laporan->indikator_14c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_15a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="15b">Bagaiamana strategi menghadapi mereka?</label>
                                        <p>
                                            {{ $laporan->indikator_15b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="15c">Apakah pernah terjadi konflik?</label>
                                        <p>
                                            {{ $laporan->indikator_15c }}
                                        </p>
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
                                        <p>
                                            {{ $laporan->indikator_16a }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="16b">Seberapa besar laba ditahan untuk keberlangsungan usaha?</label>
                                        <p>
                                            {{ $laporan->indikator_16b }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="16c">Apakah ada pengaruh kinerja antara owner yang digaji dengan tidak digaji?</label>
                                        <p>
                                            {{ $laporan->indikator_16c }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('scripts')

@endsection
