@extends('layout')

@section('title', "Job Portal")

@section('stylesheets')
    
@endsection

@section('content')

    <div class="job_details_area bg-its-2">
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
                        <h3>Akun anda belum aktif</h3>
                        <p>Demi keamanan dan untuk mencegah akun spam, akun anda sedang melalui tahap verifikasi.</p>
                        <p>Terimakasih atas pengertian anda.</p>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--  --}}
@endsection