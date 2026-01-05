@extends('layouts.app')

@section('title', __('test.results_title') . ' - ' . $ogData['party_name'])

@section('og')
    <meta property="og:title"
        content="{{ __('test.og_result_title', ['party' => $ogData['party_short'], 'score' => $ogData['score']]) }}">
    <meta property="og:description" content="{{ __('test.og_result_description') }}">
    <meta property="og:image" content="{{ asset('images/og_imagen.webp') }}">
    <meta property="og:url" content="{{ route('test.shared', $shareId) }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="{{ __('test.og_result_title', ['party' => $ogData['party_short'], 'score' => $ogData['score']]) }}">
    <meta name="twitter:image" content="{{ asset('images/og_imagen.webp') }}">
@endsection

@php
    $topPartyId = array_key_first($results);
    $shareUrl = route('test.shared', $shareId);
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Card Principal --}}
            <div class="card mb-4">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">🎉 {{ __('test.results_title') }}</h2>

                    <div class="row g-4">
                        {{-- Partido principal --}}
                        <div class="col-lg-6">
                            <div class="text-center p-4 rounded-3 h-100"
                                style="background: {{ $parties[$topPartyId]->color }}15; border: 2px solid {{ $parties[$topPartyId]->color }}30;">
                                <p class="text-muted mb-2">{{ __('test.your_top_party') }}</p>
                                <h3 class="display-6 fw-bold mb-2" style="color: {{ $parties[$topPartyId]->color }};">
                                    {{ $parties[$topPartyId]->name }}
                                </h3>
                                <div class="display-4 fw-bold mb-2" style="color: {{ $parties[$topPartyId]->color }};">
                                    {{ $results[$topPartyId] }}%
                                </div>
                                <small class="text-muted">{{ __('test.affinity') }}</small>

                                <div class="mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        {{ __('test.based_on') }} {{ $answeredCount }} {{ __('test.of') }}
                                        {{ $totalQuestions }} {{ __('test.questions_answered') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Brújula Política --}}
                        <div class="col-lg-6">
                            <div class="text-center p-3 rounded-3 h-100"
                                style="background: #f8f9fa; border: 1px solid #dee2e6;">
                                <h5 class="mb-4">🧭 {{ __('test.your_political_compass') }}</h5>

                                <div class="compass-wrapper mx-auto"
                                    style="width: 200px; height: 200px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        {{-- Cuadrantes con colores neutrales (sin asociación partidista) --}}
                                        <rect x="0" y="0" width="100" height="100" fill="#e74c3c" opacity="0.08" />
                                        <rect x="100" y="0" width="100" height="100" fill="#f39c12" opacity="0.08" />
                                        <rect x="0" y="100" width="100" height="100" fill="#9b59b6" opacity="0.08" />
                                        <rect x="100" y="100" width="100" height="100" fill="#3498db" opacity="0.08" />

                                        {{-- Grid adicional para mejor referencia visual --}}
                                        <line x1="50" y1="0" x2="50" y2="200" stroke="#dee2e6"
                                            stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="150" y1="0" x2="150" y2="200" stroke="#dee2e6"
                                            stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="0" y1="50" x2="200" y2="50" stroke="#dee2e6"
                                            stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="0" y1="150" x2="200" y2="150" stroke="#dee2e6"
                                            stroke-width="0.5" stroke-dasharray="4" />

                                        <line x1="100" y1="0" x2="100" y2="200" stroke="#adb5bd"
                                            stroke-width="1" />
                                        <line x1="0" y1="100" x2="200" y2="100" stroke="#adb5bd"
                                            stroke-width="1" />
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd"
                                            stroke-width="2" />

                                        @php
                                            // Escalar valores (-100 a +100) al rango del SVG (10-190) para evitar bordes
                                            $rawX = $compassPosition['economic'] ?? 0;
                                            $rawY = $compassPosition['social'] ?? 0;
                                            $x = 100 + $rawX * 0.9; // Máximo 190, mínimo 10
                                            $y = 100 - $rawY * 0.9; // Máximo 190, mínimo 10
                                        @endphp
                                        <circle cx="{{ $x }}" cy="{{ $y }}" r="10" fill="#dc3545"
                                            opacity="0.3" />
                                        <circle cx="{{ $x }}" cy="{{ $y }}" r="6" fill="#dc3545"
                                            stroke="#fff" stroke-width="2" />
                                    </svg>

                                    <span class="compass-label"
                                        style="top: -18px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_progressive') }}</span>
                                    <span class="compass-label"
                                        style="bottom: -18px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_conservative') }}</span>
                                    <span class="compass-label"
                                        style="left: -45px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_left') }}</span>
                                    <span class="compass-label"
                                        style="right: -45px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_right') }}</span>
                                </div>

                                {{-- Leyenda de cuadrantes --}}
                                <div class="compass-legend mt-4 small">
                                    <div class="row g-1 text-center">
                                        <div class="col-6">
                                            <span class="d-inline-block rounded px-2 py-1"
                                                style="background: #e74c3c20; font-size: 0.7rem;">
                                                {{ __('test.compass_quadrant_left_progressive') }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="d-inline-block rounded px-2 py-1"
                                                style="background: #f39c1220; font-size: 0.7rem;">
                                                {{ __('test.compass_quadrant_right_progressive') }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="d-inline-block rounded px-2 py-1"
                                                style="background: #9b59b620; font-size: 0.7rem;">
                                                {{ __('test.compass_quadrant_left_conservative') }}
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="d-inline-block rounded px-2 py-1"
                                                style="background: #3498db20; font-size: 0.7rem;">
                                                {{ __('test.compass_quadrant_right_conservative') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-secondary me-1">
                                        {{ __('test.economic') }}:
                                        {{ ($compassPosition['economic'] ?? 0) > 0 ? '+' : '' }}{{ $compassPosition['economic'] ?? 0 }}
                                    </span>
                                    <span class="badge bg-secondary">
                                        {{ __('test.social') }}:
                                        {{ ($compassPosition['social'] ?? 0) > 0 ? '+' : '' }}{{ $compassPosition['social'] ?? 0 }}
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted fst-italic" style="font-size: 0.65rem;">
                                        <i class="bi bi-info-circle me-1"></i>{{ __('test.compass_note') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Posición Ideológica por Categorías --}}
            @if (!empty($categoryScores))
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">📊 {{ __('test.your_profile_by_category') }}</h5>
                        <small class="text-muted">{{ __('test.category_profile_explanation') }}</small>
                    </div>
                    <div class="card-body">
                        @php
                            // Definir etiquetas para cada categoría (slug => [izquierda, derecha])
                            $categoryLabels = [
                                'modelo-territorial' => ['test.cat_label_centralist', 'test.cat_label_autonomist'],
                                'economia-fiscalidad' => ['test.cat_label_interventionist', 'test.cat_label_liberal'],
                                'empleo-trabajo' => ['test.cat_label_worker_rights', 'test.cat_label_business_flex'],
                                'inmigracion' => ['test.cat_label_open_borders', 'test.cat_label_restrictive'],
                                'medio-ambiente' => ['test.cat_label_ecologist', 'test.cat_label_productivist'],
                                'modelo-social' => ['test.cat_label_progressive', 'test.cat_label_conservative'],
                                'educacion-sanidad' => ['test.cat_label_public', 'test.cat_label_private'],
                                'vivienda' => ['test.cat_label_regulate', 'test.cat_label_free_market'],
                                'seguridad-justicia' => ['test.cat_label_garantist', 'test.cat_label_punitive'],
                                'lengua-identidad' => ['test.cat_label_plurilingual', 'test.cat_label_monolingual'],
                                'pensiones-bienestar' => ['test.cat_label_welfare', 'test.cat_label_individual'],
                                'instituciones' => ['test.cat_label_republican', 'test.cat_label_monarchist'],
                                'agricultura-rural' => ['test.cat_label_ecological', 'test.cat_label_intensive'],
                                'europa-mundo' => ['test.cat_label_federalist', 'test.cat_label_sovereignist'],
                            ];
                        @endphp

                        <div class="category-positions">
                            @foreach ($categories as $catId => $category)
                                @if (isset($categoryScores[$catId]))
                                    @php
                                        $score = $categoryScores[$catId]; // -100 a +100
                                        $position = (($score + 100) / 200) * 100; // Convertir a 0-100% para la barra
                                        $labels = $categoryLabels[$category->slug] ?? [
                                            'test.cat_label_left',
                                            'test.cat_label_right',
                                        ];

                                        // Determinar color según posición
                                        if ($score < -30) {
                                            $color = '#e74c3c'; // Rojo - Izquierda fuerte
                                        } elseif ($score < -10) {
                                            $color = '#e67e22'; // Naranja - Izquierda moderada
                                        } elseif ($score <= 10) {
                                            $color = '#95a5a6'; // Gris - Centro
                                        } elseif ($score <= 30) {
                                            $color = '#3498db'; // Azul claro - Derecha moderada
                                        } else {
                                            $color = '#2980b9'; // Azul oscuro - Derecha fuerte
                                        }
                                    @endphp

                                    <div class="category-position-item mb-3 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2"
                                                    style="font-size: 1.3rem;">{{ $category->icon }}</span>
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                            <span class="badge"
                                                style="background-color: {{ $color }}; color: white;">
                                                {{ $score > 0 ? '+' : '' }}{{ $score }}
                                            </span>
                                        </div>

                                        {{-- Barra de posición --}}
                                        <div class="position-bar-container">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="text-muted"
                                                    style="font-size: 0.7rem;">{{ __($labels[0]) }}</small>
                                                <small class="text-muted"
                                                    style="font-size: 0.7rem;">{{ __($labels[1]) }}</small>
                                            </div>
                                            <div class="position-bar"
                                                style="position: relative; height: 12px; background: linear-gradient(to right, #e74c3c, #f39c12, #95a5a6, #3498db, #2980b9); border-radius: 6px;">
                                                {{-- Marcador de posición --}}
                                                <div class="position-marker"
                                                    style="
                                        position: absolute;
                                        left: calc({{ $position }}% - 8px);
                                        top: -4px;
                                        width: 20px;
                                        height: 20px;
                                        background: white;
                                        border: 3px solid {{ $color }};
                                        border-radius: 50%;
                                        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
                                        transition: left 0.3s ease;
                                    ">
                                                </div>
                                                {{-- Línea central --}}
                                                <div
                                                    style="
                                        position: absolute;
                                        left: 50%;
                                        top: 0;
                                        width: 2px;
                                        height: 100%;
                                        background: rgba(255,255,255,0.5);
                                    ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Leyenda --}}
                        <div class="mt-4 p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="bi bi-info-circle me-1"></i>{{ __('test.how_to_read') }}</h6>
                            <div class="row small text-muted">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-1">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #e74c3c; border-radius: 50%; margin-right: 8px;"></span>
                                        <span>{{ __('test.strong_left') }} (-100 a -30)</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #e67e22; border-radius: 50%; margin-right: 8px;"></span>
                                        <span>{{ __('test.moderate_left') }} (-30 a -10)</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #95a5a6; border-radius: 50%; margin-right: 8px;"></span>
                                        <span>{{ __('test.center') }} (-10 a +10)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-1">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #3498db; border-radius: 50%; margin-right: 8px;"></span>
                                        <span>{{ __('test.moderate_right') }} (+10 a +30)</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span
                                            style="display: inline-block; width: 12px; height: 12px; background: #2980b9; border-radius: 50%; margin-right: 8px;"></span>
                                        <span>{{ __('test.strong_right') }} (+30 a +100)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Compartir y Comparar --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <h6 class="mb-2"><i class="bi bi-share me-2"></i>{{ __('test.share_your_results') }}</h6>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" value="{{ $shareUrl }}" id="shareUrl"
                                    readonly>
                                <button class="btn btn-outline-primary" type="button" onclick="copyShareUrl()">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode(__('test.share_text_twitter', ['party' => $parties[$topPartyId]->name, 'percent' => $results[$topPartyId]])) }}&url={{ urlencode($shareUrl) }}"
                                    target="_blank" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode(__('test.share_text_whatsapp', ['party' => $parties[$topPartyId]->name, 'percent' => $results[$topPartyId], 'url' => $shareUrl])) }}"
                                    target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="mb-2"><i class="bi bi-people me-2"></i>{{ __('test.compare_with_friend') }}</h6>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">{{ url('/comparar/' . $shareId) }}/</span>
                                <input type="text" class="form-control" id="friendShareId"
                                    placeholder="{{ __('test.friend_code') }}">
                                <button class="btn btn-primary" type="button" onclick="compareResults()">
                                    <i class="bi bi-arrow-right"></i> {{ __('test.compare') }}
                                </button>
                            </div>
                            <small class="text-muted">{{ __('test.compare_hint') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Todos los Partidos --}}
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">{{ __('test.all_parties') }}</h5>
                </div>
                <div class="card-body">
                    @foreach ($results as $partyId => $score)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-semibold">
                                    <span class="badge me-2" style="background: {{ $parties[$partyId]->color }};">
                                        {{ $parties[$partyId]->short_name }}
                                    </span>
                                    {{ $parties[$partyId]->name }}
                                </span>
                                <span class="fw-bold">{{ $score }}%</span>
                            </div>
                            <div class="progress" style="height: 24px; cursor: pointer;" data-bs-toggle="collapse"
                                data-bs-target="#details-{{ $partyId }}">
                                <div class="progress-bar"
                                    style="width: {{ $score }}%; background: {{ $parties[$partyId]->color }};">
                                </div>
                            </div>

                            <div class="collapse mt-2" id="details-{{ $partyId }}">
                                <div class="card card-body bg-light border">
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <h6 class="text-success"><i
                                                    class="bi bi-check-circle me-1"></i>{{ __('test.you_agree_on') }}</h6>
                                            @if (!empty($partyMatches[$partyId]['matches']))
                                                <ul class="small mb-0 ps-3">
                                                    @foreach ($partyMatches[$partyId]['matches'] as $match)
                                                        <li class="mb-1">{{ Str::limit($match['question'], 60) }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="small text-muted mb-0">{{ __('test.no_strong_matches') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-danger"><i
                                                    class="bi bi-x-circle me-1"></i>{{ __('test.you_disagree_on') }}</h6>
                                            @if (!empty($partyMatches[$partyId]['divergences']))
                                                <ul class="small mb-0 ps-3">
                                                    @foreach ($partyMatches[$partyId]['divergences'] as $div)
                                                        <li class="mb-1">{{ Str::limit($div['question'], 60) }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="small text-muted mb-0">{{ __('test.no_strong_divergences') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Resultados por Categoría (Tabla) --}}
            @if (!empty($resultsByCategory))
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">{{ __('test.results_by_category') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('test.category') }}</th>
                                        @foreach ($results as $partyId => $score)
                                            <th class="text-center" style="color: {{ $parties[$partyId]->color }};">
                                                {{ $parties[$partyId]->short_name }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $catId => $category)
                                        @if (isset($resultsByCategory[$catId]))
                                            <tr>
                                                <td>
                                                    <span
                                                        style="color: {{ $category->color }};">{{ $category->icon }}</span>
                                                    {{ $category->name }}
                                                </td>
                                                @foreach ($results as $partyId => $score)
                                                    @php $catScore = $resultsByCategory[$catId][$partyId] ?? 0; @endphp
                                                    <td class="text-center">
                                                        <span
                                                            class="badge bg-{{ $catScore >= 70 ? 'success' : ($catScore >= 40 ? 'warning' : 'danger') }}">
                                                            {{ $catScore }}%
                                                        </span>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Acciones --}}
            <div class="card mb-4">
                <div class="card-body text-center">
                    <form action="{{ route('test.restart') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-arrow-repeat me-1"></i> {{ __('test.restart') }}
                        </button>
                    </form>

                    <p class="text-muted mt-3 mb-0 small">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ __('test.results_disclaimer') }}
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Trackear que el usuario completó el test
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gtag === 'function') {
                gtag('event', 'test_completed', {
                    'event_category': 'engagement',
                    'event_label': '{{ $ogData['party_short'] ?? 'unknown' }}',
                    'value': {{ $ogData['score'] ?? 0 }}
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function copyShareUrl() {
            const input = document.getElementById('shareUrl');
            input.select();
            navigator.clipboard.writeText(input.value);

            const btn = event.target.closest('button');
            btn.innerHTML = '<i class="bi bi-check"></i>';
            btn.classList.replace('btn-outline-primary', 'btn-success');

            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard"></i>';
                btn.classList.replace('btn-success', 'btn-outline-primary');
            }, 2000);
        }

        function compareResults() {
            const friendId = document.getElementById('friendShareId').value.trim();
            if (friendId) {
                window.location.href = '{{ url('/comparar/' . $shareId) }}/' + friendId;
            }
        }

        localStorage.removeItem('test_progress');
    </script>
@endpush

@push('styles')
    <style>
        .compass-wrapper {
            position: relative;
            margin: 0 auto;
        }

        .compass-label {
            position: absolute;
            font-size: 0.65rem;
            color: #6c757d;
            white-space: nowrap;
        }

        .progress[data-bs-toggle="collapse"]:hover {
            opacity: 0.85;
        }
    </style>
@endpush
