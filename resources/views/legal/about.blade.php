@extends('layouts.static')

@section('title', __('about.title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-people me-2"></i>{{ __('about.title') }}</h1>

    <div class="about-content">
        
        {{-- Misión --}}
        <div class="text-center mb-5">
            <div class="display-1 mb-3">🗳️</div>
            <h2 class="h3">{{ __('about.mission_title') }}</h2>
            <p class="lead">{{ __('about.mission_desc') }}</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">🎯</div>
                    <h3 class="h5">{{ __('about.value_neutrality') }}</h3>
                    <p class="mb-0 text-muted">{{ __('about.value_neutrality_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">🔒</div>
                    <h3 class="h5">{{ __('about.value_privacy') }}</h3>
                    <p class="mb-0 text-muted">{{ __('about.value_privacy_desc') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded-3 bg-light h-100">
                    <div class="display-4 mb-3">📖</div>
                    <h3 class="h5">{{ __('about.value_transparency') }}</h3>
                    <p class="mb-0 text-muted">{{ __('about.value_transparency_desc') }}</p>
                </div>
            </div>
        </div>

        <h2>{{ __('about.why_title') }}</h2>
        <p>{{ __('about.why_intro') }}</p>
        <p>{{ __('about.why_frustration') }}</p>
        <ul>
            <li>{{ __('about.why_biased') }}</li>
            <li>{{ __('about.why_no_regional') }}</li>
            <li>{{ __('about.why_not_adapted') }}</li>
            <li>{{ __('about.why_data_collection') }}</li>
        </ul>

        <h2>{{ __('about.who_title') }}</h2>
        <p>{{ __('about.who_desc') }}</p>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>{{ __('about.independence') }}:</strong> {{ __('about.independence_desc') }}
            {{ __('about.self_funded') }}
        </div>

        <h2>{{ __('about.principles_title') }}</h2>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>{{ __('about.principle_data') }}</strong>
                        <p class="mb-0 text-muted small">{{ __('about.principle_data_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>{{ __('about.principle_free') }}</strong>
                        <p class="mb-0 text-muted small">{{ __('about.principle_free_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>{{ __('about.principle_multilingual') }}</strong>
                        <p class="mb-0 text-muted small">{{ __('about.principle_multilingual_desc') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="me-3 text-success fs-4">✓</span>
                    <div>
                        <strong>{{ __('about.principle_improvement') }}</strong>
                        <p class="mb-0 text-muted small">{{ __('about.principle_improvement_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h2>{{ __('about.contact_title') }}</h2>
        <p>{{ __('about.contact_intro') }}</p>
        <p>{!! __('about.contact_email', ['email' => '<a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>']) !!}</p>
    </div>
@endsection

@push('styles')
<style>
    .about-content h2 {
        font-size: 1.3rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
        border-bottom: 2px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .about-content ul {
        margin-bottom: 1rem;
    }
    .about-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush