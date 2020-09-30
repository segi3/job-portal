@extends('dashboard.layout')

@section('title', 'IYT Edit Batch')

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
        <h1 class="m-0 text-dark">Edit IYT Batch</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Manage-IYT</li>
            <li class="breadcrumb-item active">Edit IYT Batch</li>
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
    <div class="container-fluid">
        <form method="POST" role="form" id="quickForm" enctype="multipart/form-data" action="{{ route('iyt.editBatch',$batch->id) }}">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Batch/Open Registration for IYT</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputSalaryHigh">Judul IYT</label>
                            <input type="text" name="name" class="form-control" id="idName" placeholder="Judul" value="IYT ITS" readonly>
                        </div>
                        <div class="form-group">
                          <label for="inputSalaryLow">Tahun IYT</label>
                          <input type="text" name="batch" class="form-control" id="idBatch" placeholder="Tahun" value="{{$batch->batch}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="duedate" class="">Tanggal Pembukaan Pendaftaran</label><span class=""></span>
                        <input type="text" name="start_date" placeholder="dd-mm-yyyy"
                            value="{{ $startDate }}" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'dd-mm-yyyy'" required
                            class="single-input form-control datepicker" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="duedate" class="">Tanggal Penutupan Pendaftaran</label><span class=""></span>
                        <input type="text" name="end_date" placeholder="dd-mm-yyyy"
                            value="{{ $endDate }}" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'dd-mm-yyyy'" required
                            class="single-input form-control datepicker" autocomplete="off">
                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="submitbtn btn btn-warning">Edit</button>
                    </div>
                </div>
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
