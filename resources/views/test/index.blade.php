@extends('layouts.app')

@section('title', __('test.title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    {{-- Hero Section con imagen --}}
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/hero_banner.webp') }}" alt="{{ __('test.title') }}"
                            class="img-fluid mb-4 rounded-3 shadow-sm"
                            style="max-height: 200px; object-fit: cover; width: 100%;">

                        <h1 class="display-5 fw-bold text-dark mb-3">
                            🗳️ {{ __('test.title') }}
                        </h1>
                        <p class="lead text-muted">
                            {{ __('test.subtitle') }}
                        </p>
                    </div>

                    {{-- Info del test --}}
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center gap-4 flex-wrap justify-content-center">
                            <div class="text-center">
                                <div class="display-6 fw-bold text-primary">{{ $totalQuestions }}</div>
                                <small class="text-muted">{{ __('test.questions') }}</small>
                            </div>
                            <div class="text-center">
                                <div class="display-6 fw-bold text-primary">~{{ $estimatedMinutes }}</div>
                                <small class="text-muted">{{ __('test.minutes') }}</small>
                            </div>
                            <div class="text-center">
                                <div class="display-6 fw-bold text-primary">{{ $parties->count() }}</div>
                                <small class="text-muted">{{ __('test.parties') }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Selección de modo de test --}}
                    <div class="row g-4 mb-5">
                        {{-- Test Rápido --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-2 hover-shadow" style="border-color: #667eea;">
                                <div class="card-body p-4 text-center">
                                    <div class="mb-3">
                                        <span style="font-size: 3rem;">⚡</span>
                                    </div>
                                    <h4 class="card-title fw-bold text-primary mb-3">{{ __('test.mode_quick') }}</h4>

                                    <ul class="list-unstyled text-start mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            {{ __('test.mode_quick_time') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            {{ __('test.mode_quick_desc') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-lightbulb text-warning me-2"></i>
                                            {{ __('test.mode_quick_ideal') }}
                                        </li>
                                    </ul>

                                    <form action="{{ route('test.start') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="mode" value="quick">
                                        <button type="submit" class="btn btn-primary btn-lg px-4 py-2 rounded-pill">
                                            <i class="bi bi-play-fill me-1"></i> {{ __('test.start_quick') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Test Completo --}}
                        <div class="col-md-6">
                            <div class="card h-100 border-2 hover-shadow" style="border-color: #764ba2;">
                                <div class="card-body p-4 text-center">
                                    <div class="mb-3">
                                        <span style="font-size: 3rem;">🎯</span>
                                    </div>
                                    <h4 class="card-title fw-bold mb-3" style="color: #764ba2;">
                                        {{ __('test.mode_complete') }}</h4>

                                    <ul class="list-unstyled text-start mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            {{ __('test.mode_complete_time') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            {{ __('test.mode_complete_desc') }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-lightbulb text-warning me-2"></i>
                                            {{ __('test.mode_complete_ideal') }}
                                        </li>
                                    </ul>

                                    <form action="{{ route('test.start') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="mode" value="complete">
                                        <button type="submit" class="btn btn-lg px-4 py-2 rounded-pill text-white"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="bi bi-bullseye me-1"></i> {{ __('test.start_complete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-muted small text-center mb-4">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ __('test.can_skip') }}
                    </p>

                    {{-- Categorías --}}
                    <h5 class="mb-3">{{ __('test.categories_evaluated') }}:</h5>
                    <div class="row g-2 mb-4">
                        @foreach ($categories as $category)
                            <div class="col-6 col-md-4">
                                <span class="category-badge d-block text-center"
                                    style="background: {{ $category->color }}20; color: {{ $category->color }};">
                                    {{ $category->icon }} {{ $category->name }}
                                    <small class="d-block opacity-75">{{ $category->questions_count }} preg.</small>
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Partidos --}}
                    <h5 class="mb-3">{{ __('test.parties_analyzed') }}:</h5>
                    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                        @foreach ($parties as $party)
                            <span class="badge" style="background: {{ $party->color }}; font-size: 0.9rem;">
                                {{ $party->short_name }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Aviso privacidad --}}
                    <div class="alert alert-light text-center mb-0">
                        <i class="bi bi-shield-check me-1 text-success"></i>
                        {{ __('test.anonymous') }}
                    </div>
                </div>
            </div>

            {{-- Cómo funciona --}}
            <div class="card mt-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">{{ __('test.how_it_works') }}</h5>
                    <div class="row g-3">
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">1️⃣</div>
                            <p class="mb-0 small">{{ __('test.step_1') }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">2️⃣</div>
                            <p class="mb-0 small">{{ __('test.step_2') }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">3️⃣</div>
                            <p class="mb-0 small">{{ __('test.step_3') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush
