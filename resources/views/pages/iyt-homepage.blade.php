@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')

@endsection

@section('content')

<div class="catagory_area" style="padding-top: 50px; padding-bottom: 0px;">
    <img src="../../img/iyt-banner.png" alt="" style="width: 100%;">
</div>

<div class="catagory_area w-iyt">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="section_title mb-40" style="margin-bottom: 10px;">
                    <h1>Apa itu ITS Youth Technopreneur?</h1>
                    <p>IYT merupakan kompetisi wirausaha berbasis teknologi tingkat ITS sekaligus program pengembangan usaha Mahasiswa.
                       Mahasiswa ITS yang memiliki ide bisnis ataupun yang baru menjalankan bisnis selama 1 tahun dapat mengikuti kompetisi ini dan jika lolos akan memperoleh pendanaan, pendampingan, monitoring dan evaluasi.
                       Program ini diselenggarakan oleh Subdirektorat Pengembangan Karir dan Kewirausahaan Mahasiswa (PK2M) Direktorat Kemahasiswaan ITS. Program ini dirancang untuk menumbuhkan bibit-bibit wirausahawan berbasis teknologi agar mahasiswa dapat menciptakan produk teknologi inovatif yang dapat berguna di masyarakat.</p>
                    <br>

                </div>
                <div>
                    <a class="boxed-btn3" href="/dashboard/IYT">Daftar ITS Youth Technopreneur!</a>
                    <p class="req-daftar">
                        Sebelum daftar, harus buat akun student terlebih dahulu
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popular_catagory_area bg-white">
    <div class="container">
        <h3>Timeline</h3>
    </div>
</div>

<div class="catagory_area timeline-area">
    <img src="../../img/timeline-iyt.png" alt="" style="width: 100%;">
</div>

<div class="popular_catagory_area bg-white">
    <div class="container">
        <h3>Kualifikasi</h3>
    </div>
</div>

<div class="catagory_area w-iyt">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol>
                    <li>Peserta adalah mahasiswa aktif program studi sarjana (S1/D4) di Institut Teknologi Sepuluh Nopember, dibuktikan dengan Kartu Tanda Mahasiswa (KTM) yang masih berlaku.</li>
                    <li>Setiap tim terdiri dari 1 orang Ketua dan 3-4 orang Anggota (total ada 4-5 orang dalam 1 tim).</li>
                    <li>Setiap tim wajib minimal terdiri dari 2 Departemen yang berbeda.</li>
                    <li>Setiap tim diperbolehkan terdiri dari anggota dari angkatan yangberbeda</li>
                    <li>
                        Tiap tim terbagi menjadi tim Junior dan Senior dengan ketentuan sebagai berikut:
                        <ul>
                            <li><span class="badge-junior">Tim Junior</span>: mahasiswa semester 1-4</li>
                            <li><span class="badge-senior">Tim Senior</span>: mahasiswa semester 4-8</li>
                        </ul>
                    </li>
                    <li>Setiap tim hanya boleh mengirimkan 1 proposal.</li>
                    <li>Setiap peserta membuat rencana bisnis sesuai dengan tema  dan sub tema yang dipilih.</li>
                    <li>Rencana bisnis berupa proposal dan pitch desk dikumpul dalam bentuk .pdf</li>
                    <li>Calon peserta mengumpulkan berkas melalui link <a href="intip.in/PendaftarIYT2020">Pendaftar IYT 2020</a></li>
                    <li>Peserta yang tidak memenuhi syarat dianggap gugur.</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="popular_catagory_area bg-white announce-iyt">
    <div class="container">
        <h3>Pengumuman Lolos</h3>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <th>#</th>
                <th>Nama Kelompok</th>
                <th>Tingkat</th>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>Kelompok 1</td>
                    <td><span class="badge-senior">Senior</span></td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Kelompok 2</td>
                    <td><span class="badge-senior">Senior</span></td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Kelompok 3</td>
                    <td><span class="badge-senior">Senior</span></td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>Kelompok 4</td>
                    <td><span class="badge-senior">Senior</span></td>
                </tr>
                <tr>
                    <th>5</th>
                    <td>Kelompok 5</td>
                    <td><span class="badge-senior">Senior</span></td>
                </tr>
                <tr>
                    <th>6</th>
                    <td>Kelompok 6</td>
                    <td><span class="badge-junior">Junior</span></td>
                </tr>
                <tr>
                    <th>7</th>
                    <td>Kelompok 7</td>
                    <td><span class="badge-junior">Junior</span></td>
                </tr>
                <tr>
                    <th>8</th>
                    <td>Kelompok 8</td>
                    <td><span class="badge-junior">Junior</span></td>
                </tr>
                <tr>
                    <th>9</th>
                    <td>Kelompok 9</td>
                    <td><span class="badge-junior">Junior</span></td>
                </tr>
                <tr>
                    <th>10</th>
                    <td>Kelompok 10</td>
                    <td><span class="badge-junior">Junior</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="popular_catagory_area bg-yellow end-iyt">
    <div class="container">
        <h3>Daftar ITS-IYT Sekarang!</h3>
    </div>
</div>






@endsection

@section('scripts')
{{--  --}}
@endsection
