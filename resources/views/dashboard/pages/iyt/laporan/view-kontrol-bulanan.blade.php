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
                <h1 class="m-0 text-dark">Kontrol Bulanan kelompok {{ $data_kelompok->nama_kelompok }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">IYT</li>
                    <li class="breadcrumb-item active">{{ $data_kelompok->nama_kelompok }}</li>
                    <li class="breadcrumb-item active">Kontrol-Bulanan</li>
                    <li class="breadcrumb-item active">{{ $laporan->bulan }}-{{ $laporan->tahun }}</li>
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
                                        laporan rekapitulasi : <a href="#">link download berkas</a>
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
                                <div class="indikator-v">
                                    <div class="penilaian-v">
                                        <p>
                                            a. Apakah usaha masih berjalan?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_1a }} ({{ $laporan->nilai_1a }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_1a)) !!}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="penilaian">
                                        <p>
                                            b. Apakah anda masih akan melanjutkan usaha ini?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_1b }} ({{ $laporan->nilai_1b }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_1b)) !!}
                                            </p>
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
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_2a }} ({{ $laporan->nilai_2a }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_2a)) !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            b. Apakah ada upaya untuk memperbaiki pelaksanaan?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_2b }} ({{ $laporan->nilai_2b }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_2b)) !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            c. Bagaimanakah hasil usaha setelah dilakukan perbaikan?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_2c }} ({{ $laporan->nilai_2c }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_2c)) !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            d. Apakah ada usaha pengembangan?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_2d }} ({{ $laporan->nilai_2d }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_2d)) !!}
                                            </p>
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
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_3a }} ({{ $laporan->nilai_3a }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_3a)) !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="penilaian">
                                        <p>
                                            b. Bagaimana kondisi aset anda?
                                        </p>
                                        <div class="sub-penilaian-v">
                                            <p>
                                                {{ $laporan->indikator_3b }} ({{ $laporan->nilai_3b }})
                                            </p>
                                        </div>
                                        <div class="sub-penilaian-v">
                                            <span class="komentar-judul">
                                                Komentar
                                            </span>
                                            <p>
                                                {!! nl2br(e($laporan->komentar_3b)) !!}
                                            </p>
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
                                    <div class="penilaian">
                                        <p>
                                            <a href="#">Link download file</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>

                @if (session('role') == 'mentor')
                <div class="col-lg-12">
                    <form method="POST" role="form" id="quickForm" action="{{ route('laporan.kontrol-bulanan.update') }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Rekomendasi Reviewer</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if( $laporan->rekomendasi_reviewer == "belum_review" )
                                        <span class="red-no-review">Laporan belum di review oleh mentor</span>
                                        @endif
                                        <div class="konten-review">
                                            <div class="komentar-judul">
                                                Rekomendasi Reviewer:
                                            </div>
                                            <div>
                                                <div class="form-check">
                                                    <input type="radio" id="radio-lanjut" name="rekomendasi-reviewer" value="lanjut"  {{ ($laporan->rekomendasi_reviewer=="lanjut")? "checked" : "" }}>
                                                    <label class="form-check-label" for="radio-lanjut">
                                                        Lanjut
                                                    </label>
                                                  </div>
                                                <div class="form-check">
                                                    <input type="radio" id="radio-tidak-lanjut" name="rekomendasi-reviewer" value="tidak_lanjut" {{ ($laporan->rekomendasi_reviewer=="tidak_lanjut")? "checked" : "" }} >
                                                    <label class="form-check-label" for="radio-tidak-lanjut">
                                                        Tidak Lanjut
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="konten-review">
                                            
                                            <div class="komentar-judul">
                                                Alasan Reviewer:
                                            </div>
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Team work" id="cb-1"
                                                        name="alasan_reviewer[]"
                                                        @if(in_array('Team work', $laporan->alasan_reviewer))
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="form-check-label" for="cb-1">
                                                        Team work
                                                    </label>
                                                </div>
        
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Ketua tidak mendukung" id="cb-2"
                                                        name="alasan_reviewer[]"
                                                        @if(in_array('Ketua tidak mendukung', $laporan->alasan_reviewer))
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="form-check-label" for="cb-2">
                                                        Ketua tidak mendukung
                                                    </label>
                                                </div>
        
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Sulit mengatur waktu" id="cb-3"
                                                        name="alasan_reviewer[]"
                                                        @if(in_array('Sulit mengatur waktu', $laporan->alasan_reviewer))
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="form-check-label" for="cb-3">
                                                        Sulit mengatur waktu
                                                    </label>
                                                </div>
        
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Tidak ada bimbingan" id="cb-4"
                                                        name="alasan_reviewer[]"
                                                        @if(in_array('Tidak ada bimbingan', $laporan->alasan_reviewer))
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="form-check-label" for="cb-4">
                                                        Tidak ada bimbingan
                                                    </label>
                                                </div>
        
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Tidak ada semangat" id="cb-5"
                                                        name="alasan_reviewer[]"
                                                        @if(in_array('Tidak ada semangat', $laporan->alasan_reviewer))
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="form-check-label" for="cb-5">
                                                        Tidak ada semangat
                                                    </label>
                                                </div>
        
                                                <div class="form-group" style="margin-top: 25px;">
                                                    <label for="textarea-alasan">Alasan lain:</label>
                                                    <textarea type="text" name="alasan_reviewer[]" class="form-control" id="textarea-alasan"
                                                    placeholder="Alasan reviewer ... ">{{ end($laporan->alasan_reviewer) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    
                                        <input type="hidden" name="laporan_id" value="{{ $laporan->id }}" />

                                        <div>
                                            @if( $mentor != null )
                                            <span>terakhir di review oleh: {{ $mentor->name }}</span>
                                            @else
                                            <span>Belum di review oleh mentor</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="submitbtn btn btn-primary">Update Review</button>
                            </div>
                        </div>

                    </form>
                </div>
                @else
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Rekomendasi dari Reviewer</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <span class="komentar-judul">
                                            Rekomendasi Reviewer: 
                                        </span>
                                        
                                        @if( $laporan->rekomendasi_reviewer == "lanjut" )
                                            <span>Lanjut</span>
                                        @elseif( $laporan->rekomendasi_reviewer == "tidak_lanjut" )
                                            <span class="red-no-review">Tidak Lanjut</span>
                                        @else
                                            <span class="red-no-review"> Belum di review</span>
                                        @endif
                                    </div>

                                    <div class="komentar-judul" style="margin-top: 20px;">
                                        Alasan Reviewer:
                                    </div>
                                    @if( $laporan->rekomendasi_reviewer == "belum_review" )
                                        <span class="red-no-review">Laporan belum di review oleh mentor</span>
                                    @else
                                    <div>
                                        @foreach($laporan->alasan_reviewer as $alasan)
                                            <div>{!! nl2br(e($alasan)) !!}</div>
                                        @endforeach
                                    </div>

                                    <div style="margin-top: 25px;">
                                        @if( $mentor != null )
                                        <span>terakhir di review oleh: {{ $mentor->name }}</span>
                                        @else
                                        <span>Belum di review oleh mentor</span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="submitbtn btn btn-primary">Update Review</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
    </div>
</section>
@endsection

@section('scripts')

@endsection
