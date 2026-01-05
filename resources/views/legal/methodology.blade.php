@extends('layouts.static')

@section('title', __('methodology.title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-graph-up me-2"></i>{{ __('methodology.title') }}</h1>

    <p class="lead mb-4">{{ __('methodology.subtitle') }}</p>

    <div class="methodology-content">

        {{-- Resumen visual --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">📝</div>
                    <h5>{{ __('methodology.summary_questions') }}</h5>
                    <small class="text-muted">{{ __('methodology.summary_questions_desc') }}</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">🏛️</div>
                    <h5>{{ __('methodology.summary_parties') }}</h5>
                    <small class="text-muted">{{ __('methodology.summary_parties_desc') }}</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">📊</div>
                    <h5>{{ __('methodology.summary_positions') }}</h5>
                    <small class="text-muted">{{ __('methodology.summary_positions_desc') }}</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 rounded-3 bg-light h-100">
                    <div class="display-4 mb-2">🎯</div>
                    <h5>{{ __('methodology.summary_neutral') }}</h5>
                    <small class="text-muted">{{ __('methodology.summary_neutral_desc') }}</small>
                </div>
            </div>
        </div>

        <h2>1. {{ __('methodology.sources_title') }}</h2>
        <p>{!! __('methodology.sources_intro') !!}</p>
        <ul>
            <li>{{ __('methodology.sources_programs') }}</li>
            <li>{{ __('methodology.sources_documents') }}</li>
            <li>{{ __('methodology.sources_votes') }}</li>
            <li>{{ __('methodology.sources_declarations') }}</li>
        </ul>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>{{ __('methodology.important') }}:</strong> {{ __('methodology.sources_warning') }}
        </div>

        <h2>2. {{ __('methodology.questions_title') }}</h2>
        <p>{{ __('methodology.questions_intro') }}</p>
        <ul>
            <li><strong>{{ __('methodology.questions_neutrality') }}:</strong>
                {{ __('methodology.questions_neutrality_desc') }}</li>
            <li><strong>{{ __('methodology.questions_clarity') }}:</strong> {{ __('methodology.questions_clarity_desc') }}
            </li>
            <li><strong>{{ __('methodology.questions_relevance') }}:</strong>
                {{ __('methodology.questions_relevance_desc') }}</li>
            <li><strong>{{ __('methodology.questions_differentiation') }}:</strong>
                {{ __('methodology.questions_differentiation_desc') }}</li>
        </ul>

        <h3>{{ __('methodology.scale_title') }}</h3>
        <p>{{ __('methodology.scale_intro') }}</p>
        <div class="row g-2 mb-4">
            <div class="col text-center">
                <div class="p-2 rounded bg-danger text-white">1</div>
                <small>{{ __('methodology.scale_1') }}</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-warning">2</div>
                <small>{{ __('methodology.scale_2') }}</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-secondary text-white">3</div>
                <small>{{ __('methodology.scale_3') }}</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-info text-white">4</div>
                <small>{{ __('methodology.scale_4') }}</small>
            </div>
            <div class="col text-center">
                <div class="p-2 rounded bg-success text-white">5</div>
                <small>{{ __('methodology.scale_5') }}</small>
            </div>
        </div>

        <h2>3. {{ __('methodology.positions_title') }}</h2>
        <p>{!! __('methodology.positions_intro') !!}</p>
        <ul>
            <li><strong>{{ __('methodology.weight_high') }}:</strong> {{ __('methodology.weight_high_desc') }}</li>
            <li><strong>{{ __('methodology.weight_medium') }}:</strong> {{ __('methodology.weight_medium_desc') }}</li>
            <li><strong>{{ __('methodology.weight_low') }}:</strong> {{ __('methodology.weight_low_desc') }}</li>
        </ul>

        <h2>4. {{ __('methodology.algorithm_title') }}</h2>
        <p>{{ __('methodology.algorithm_intro') }}</p>

        {!! __('methodology.algorithm_factors') !!}

        <div class="bg-light p-4 rounded-3 mb-4">
            <p class="mb-2"><strong>{{ __('methodology.algorithm_per_question') }}</strong></p>
            <code>{{ __('methodology.algorithm_difference') }}</code><br>
            <code>{{ __('methodology.algorithm_score') }}</code><br>
            <code>{{ __('methodology.algorithm_conviction') }}</code><br>
            <code>{{ __('methodology.algorithm_weight') }}</code>

            <p class="mt-3 mb-2"><strong>{{ __('methodology.algorithm_total') }}</strong></p>
            <code>{{ __('methodology.algorithm_affinity') }}</code>
        </div>

        <h3>{{ __('methodology.conviction_title') }}</h3>
        <p>{{ __('methodology.conviction_intro') }}</p>
        <ul>
            <li><strong>{{ __('methodology.conviction_extreme') }}</strong></li>
            <li><strong>{{ __('methodology.conviction_moderate') }}</strong></li>
            <li><strong>{{ __('methodology.conviction_neutral') }}</strong></li>
        </ul>

        <p class="mt-4"><strong>{{ __('methodology.example') }}:</strong></p>
        <ul>
            <li>{{ __('methodology.example_your_answer') }}</li>
            <li>{{ __('methodology.example_party_position') }}</li>
            <li>{{ __('methodology.example_weight') }}</li>
            <li>{{ __('methodology.example_difference') }}</li>
            <li>{{ __('methodology.example_base_score') }}</li>
            <li>{{ __('methodology.example_conviction') }}</li>
            <li>{{ __('methodology.example_total_weight') }}</li>
            <li>{{ __('methodology.example_score') }}</li>
            <li>{{ __('methodology.example_max') }}</li>
            <li><strong>{{ __('methodology.example_percent') }}</strong></li>
        </ul>

        <h2>5. {{ __('methodology.compass_title') }}</h2>
        <p>{{ __('methodology.compass_intro') }}</p>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 border h-100">
                    <h5>↔️ {{ __('methodology.compass_economic_axis') }}</h5>
                    <p class="mb-0">
                        <strong>{{ __('methodology.compass_left') }}:</strong>
                        {{ __('methodology.compass_left_desc') }}<br>
                        <strong>{{ __('methodology.compass_right') }}:</strong> {{ __('methodology.compass_right_desc') }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded-3 border h-100">
                    <h5>↕️ {{ __('methodology.compass_social_axis') }}</h5>
                    <p class="mb-0">
                        <strong>{{ __('methodology.compass_progressive') }}:</strong>
                        {{ __('methodology.compass_progressive_desc') }}<br>
                        <strong>{{ __('methodology.compass_conservative') }}:</strong>
                        {{ __('methodology.compass_conservative_desc') }}
                    </p>
                </div>
            </div>
        </div>

        <p>{{ __('methodology.compass_categories_intro') }}</p>
        <ul>
            <li><strong>{{ __('methodology.compass_economic_axis') }}:</strong>
                {{ __('methodology.compass_economic_categories') }}</li>
            <li><strong>{{ __('methodology.compass_social_axis') }}:</strong>
                {{ __('methodology.compass_social_categories') }}</li>
        </ul>

        <h3>{{ __('methodology.compass_algorithm_title') }}</h3>
        <p>{!! __('methodology.compass_algorithm_intro') !!}</p>
        {!! __('methodology.compass_algorithm_steps') !!}

        <div class="alert alert-secondary">
            <i class="bi bi-lightbulb me-2"></i>
            <strong>{{ __('methodology.example') }}:</strong> {{ __('methodology.compass_algorithm_example') }}
        </div>

        <p><strong>{{ __('methodology.compass_algorithm_benefit') }}</strong></p>

        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>{{ __('methodology.note') }}:</strong> {{ __('methodology.compass_note') }}
        </div>

        <h2>6. {{ __('methodology.limitations_title') }}</h2>
        <p>{{ __('methodology.limitations_intro') }}</p>
        <ul>
            <li>{{ __('methodology.limitations_nuances') }}</li>
            <li>{{ __('methodology.limitations_simplification') }}</li>
            <li>{{ __('methodology.limitations_programs') }}</li>
            <li>{{ __('methodology.limitations_discriminating') }}</li>
            <li>{{ __('methodology.limitations_promises') }}</li>
        </ul>

        <h2>7. {{ __('methodology.opensource_title') }}</h2>
        <p>{{ __('methodology.opensource_intro') }}</p>
        <ul>
            <li>{{ __('methodology.opensource_questions') }}</li>
            <li>{{ __('methodology.opensource_positions') }}</li>
            <li>{{ __('methodology.opensource_algorithm') }}</li>
        </ul>

        <h2>8. {{ __('methodology.contact_title') }}</h2>
        <p>{!! __('methodology.contact_desc', [
            'email' => '<a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>',
        ]) !!}</p>
        <p>{{ __('methodology.contact_sources') }}</p>
    </div>
@endsection

@push('styles')
    <style>
        .methodology-content h2 {
            font-size: 1.3rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }

        .methodology-content h3 {
            font-size: 1.1rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #555;
        }

        .methodology-content code {
            background: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            color: #e83e8c;
            display: inline-block;
            margin: 2px 0;
        }
    </style>
@endpush
