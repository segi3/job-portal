@extends('dashboard.layout')

@section('title', 'Create Mentoring IYT')

@section('stylesheets')
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
        <h1 class="m-0 text-dark">Buat Jadwal Mentoring</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Mentor</li>
            <li class="breadcrumb-item active">Create-IYT-Mentoring</li>
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
                @php
                    $errors=Session::get('error');
                @endphp
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
        <form method="POST" role="form" id="quickForm" action="{{ route('iyt.createMentoring') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Buat Jadwal</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputJudul">{{ __('Judul') }}</label>
                            <input type="text" name="judul" class="form-control" id="inputJudul" value="{{ old('judul') }}" placeholder="Judul Mentoring">
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="">{{ __('Tanggal') }}</label><span class=""></span>
                            <input type="text" name="tanggal" placeholder="dd-mm-yyyy"
                                value="{{ old('tanggal') }}"
                                onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'dd-mm-yyyy'"
                                required
                                class="single-input form-control datepicker">
                        </div>
                        <div class="form-group">
                            <label for="inputLink">{{ __('Link Mentoring') }}</label>
                            <input type="text" name="link" class="form-control" id="inputLink" value="{{ old('link') }}" placeholder="Link Mentoring">
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>
        </form>
    </div>
</section>
@endsection

@section('scripts')

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

@endsection
