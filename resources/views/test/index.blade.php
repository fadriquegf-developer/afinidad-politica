@extends('layouts.app')

@section('title', __('test.title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    {{-- Hero Section con imagen --}}
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/hero_banner.png') }}" alt="{{ __('test.title') }}"
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

                    {{-- Botón de inicio --}}
                    <div class="text-center mb-5">
                        <form action="{{ route('test.start') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">
                                <i class="bi bi-play-fill me-2"></i>{{ __('test.start_test') }}
                            </button>
                        </form>
                        <p class="text-muted small mt-2">
                            {{ __('test.can_skip') }}
                        </p>
                    </div>

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
