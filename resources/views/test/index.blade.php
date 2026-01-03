@extends('layouts.app')

@section('title', __('test.title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bold text-dark mb-3">
                            🗳️ {{ __('test.title') }}
                        </h1>
                        <p class="lead text-muted">
                            {{ __('test.subtitle') }}
                        </p>
                    </div>

                    <form action="{{ route('test.start') }}" method="POST" x-data="{ mode: 2 }">
                        @csrf

                        {{-- Selector de modo --}}
                        <h5 class="text-center mb-4">{{ __('test.choose_mode') }}</h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-4">
                                <div class="card h-100 cursor-pointer" :class="mode === 1 ? 'border-primary border-2' : ''"
                                    @click="mode = 1" style="cursor:pointer;">
                                    <div class="card-body text-center">
                                        <div class="display-6 mb-2">⚡</div>
                                        <h5 class="card-title">{{ __('test.mode_quick') }}</h5>
                                        <p class="text-muted mb-1">10 {{ __('test.questions') }}</p>
                                        <small class="text-muted">~3 {{ __('test.minutes') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 cursor-pointer" :class="mode === 2 ? 'border-primary border-2' : ''"
                                    @click="mode = 2" style="cursor:pointer;">
                                    <div class="card-body text-center">
                                        <div class="display-6 mb-2">⚖️</div>
                                        <h5 class="card-title">{{ __('test.mode_normal') }}</h5>
                                        <p class="text-muted mb-1">20 {{ __('test.questions') }}</p>
                                        <small class="text-muted">~6 {{ __('test.minutes') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 cursor-pointer" :class="mode === 3 ? 'border-primary border-2' : ''"
                                    @click="mode = 3" style="cursor:pointer;">
                                    <div class="card-body text-center">
                                        <div class="display-6 mb-2">🎯</div>
                                        <h5 class="card-title">{{ __('test.mode_complete') }}</h5>
                                        <p class="text-muted mb-1">30 {{ __('test.questions') }}</p>
                                        <small class="text-muted">~10 {{ __('test.minutes') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="mode" x-model="mode">

                        {{-- Categorías --}}
                        <h5 class="mb-3">{{ __('test.categories_evaluated') }}:</h5>
                        <div class="row g-2 mb-4">
                            @foreach ($categories as $category)
                                <div class="col-6 col-md-4">
                                    <span class="category-badge d-block text-center"
                                        style="background: {{ $category->color }}20; color: {{ $category->color }};">
                                        {{ $category->icon }} {{ $category->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Partidos --}}
                        <h5 class="mb-3">{{ __('test.parties_analyzed') }}:</h5>
                        <div class="d-flex flex-wrap gap-2 mb-5">
                            @foreach ($parties as $party)
                                <span class="badge" style="background: {{ $party->color }}; font-size: 0.9rem;">
                                    {{ $party->short_name }}
                                </span>
                            @endforeach
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                {{ __('test.start_test') }} <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>

                    <p class="text-muted text-center mt-4 small">
                        <i class="bi bi-shield-check me-1"></i>
                        {{ __('test.anonymous') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
