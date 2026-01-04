@extends('layouts.static')

@section('title', __('faq.title'))

@push('schema')
    <script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
        {
            "@@type": "Question",
            "name": "{{ __('faq.q1_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q1_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q2_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q2_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q3_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q3_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q4_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q4_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q5_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q5_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q6_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q6_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q7_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q7_schema') }}"
            }
        },
        {
            "@@type": "Question",
            "name": "{{ __('faq.q8_title') }}",
            "acceptedAnswer": {
                "@@type": "Answer",
                "text": "{{ __('faq.q8_schema') }}"
            }
        }
    ]
}
</script>
@endpush

@section('static-content')
    <h1 class="mb-4">
        <i class="bi bi-question-circle me-2 text-primary"></i>
        {{ __('faq.title') }}
    </h1>

    <p class="lead text-muted mb-5">
        {{ __('faq.subtitle') }}
    </p>

    <div class="accordion" id="faqAccordion">

        {{-- Pregunta 1 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    <i class="bi bi-shield-check me-2 text-success"></i>
                    {{ __('faq.q1_title') }}
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q1_answer', ['privacy_link' => '<a href="' . route('legal.privacy') . '">' . __('faq.privacy_policy') . '</a>']) !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 2 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    <i class="bi bi-calculator me-2 text-info"></i>
                    {{ __('faq.q2_title') }}
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q2_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 3 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    <i class="bi bi-list-ol me-2 text-warning"></i>
                    {{ __('faq.q3_title') }}
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q3_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 4 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    <i class="bi bi-flag me-2 text-danger"></i>
                    {{ __('faq.q4_title') }}
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q4_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 5 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    <i class="bi bi-translate me-2 text-primary"></i>
                    {{ __('faq.q5_title') }}
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q5_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 6 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                    <i class="bi bi-share me-2 text-success"></i>
                    {{ __('faq.q6_title') }}
                </button>
            </h2>
            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q6_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 7 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                    <i class="bi bi-compass me-2 text-info"></i>
                    {{ __('faq.q7_title') }}
                </button>
            </h2>
            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q7_answer') !!}
                </div>
            </div>
        </div>

        {{-- Pregunta 8 --}}
        <div class="accordion-item border-0 mb-3 shadow-sm">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                    <i class="bi bi-building me-2 text-secondary"></i>
                    {{ __('faq.q8_title') }}
                </button>
            </h2>
            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {!! __('faq.q8_answer') !!}
                </div>
            </div>
        </div>

    </div>

    {{-- CTA --}}
    <div class="text-center mt-5 p-4 bg-light rounded">
        <h4>{{ __('faq.cta_title') }}</h4>
        <p class="text-muted">{{ __('faq.cta_subtitle') }}</p>
        <a href="{{ route('test.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-play-fill me-2"></i>{{ __('faq.cta_button') }}
        </a>
    </div>
@endsection