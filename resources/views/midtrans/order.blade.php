@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')

@endsection

@section('content')

    {{-- <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $order_id }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="job_details_area">
        <div class="container">
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
            <div class="row justify-content-center">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="apply_job_form white-bg mt-5">
                        <p>{{ $order->invoice }}</p>
                        <p>{{ $order->nama_investor }}</p>
                        <p>{{ $order->nama_investasi }}</p>
                        <p>{{ $order->total_harga }}</p>
                        <p>Status : {{ $order->status }}</p>
                        <a class="btn" href="https://app.sandbox.midtrans.com/snap/v2/vtweb/{{ $order->snap_token }}">Menuju halaman pembayaran</a>
					</div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection