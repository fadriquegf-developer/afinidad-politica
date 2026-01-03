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

                    <div class="row g-4 mb-5">
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">📝</div>
                            <h5>{{ $totalQuestions }} {{ __('test.questions') }}</h5>
                            <small class="text-muted">{{ __('test.about_current_topics') }}</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">⏱️</div>
                            <h5>~10 {{ __('test.minutes') }}</h5>
                            <small class="text-muted">{{ __('test.to_complete') }}</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="display-6 mb-2">🎯</div>
                            <h5>{{ $parties->count() }} {{ __('test.parties') }}</h5>
                            <small class="text-muted">{{ __('test.analyzed') }}</small>
                        </div>
                    </div>

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

                    <h5 class="mb-3">{{ __('test.parties_analyzed') }}:</h5>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        @foreach ($parties as $party)
                            <span class="badge" style="background: {{ $party->color }}; font-size: 0.9rem;">
                                {{ $party->short_name }}
                            </span>
                        @endforeach
                    </div>

                    <form action="{{ route('test.start') }}" method="POST">
                        @csrf
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
