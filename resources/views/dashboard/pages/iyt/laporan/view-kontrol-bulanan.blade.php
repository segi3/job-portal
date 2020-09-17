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
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Indikator Laporan</h3>
                        </div>
                        <div class="card-body">


                           
                            
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
