@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    @yield('static-content')
                </div>
            </div>

            {{-- Navegación --}}
            <div class="text-center mt-4">
                <a href="{{ route('test.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> {{ __('test.back_to_home') }}
                </a>
            </div>
        </div>
    </div>
@endsection
