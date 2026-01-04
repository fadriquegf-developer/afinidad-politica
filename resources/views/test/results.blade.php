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

            {{-- Gráfico Radar por Categorías --}}
            @if (!empty($categoryScores))
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">📊 {{ __('test.your_profile_by_category') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <canvas id="radarChart" height="300"></canvas>
                            </div>
                            <div class="col-lg-5">
                                <div class="radar-legend mt-3 mt-lg-0">
                                    @foreach ($categories as $catId => $category)
                                        @if (isset($categoryScores[$catId]))
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="me-2"
                                                    style="font-size: 1.2rem;">{{ $category->icon }}</span>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between">
                                                        <small>{{ $category->name }}</small>
                                                        <small class="fw-bold">{{ $categoryScores[$catId] }}%</small>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar"
                                                            style="width: {{ $categoryScores[$catId] }}%; background: {{ $category->color }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
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
        // Gráfico Radar
        @if (!empty($categoryScores))
            const radarCtx = document.getElementById('radarChart').getContext('2d');
            new Chart(radarCtx, {
                type: 'radar',
                data: {
                    labels: [
                        @foreach ($categories as $catId => $category)
                            @if (isset($categoryScores[$catId]))
                                '{{ $category->icon }} {{ Str::limit($category->name, 15) }}',
                            @endif
                        @endforeach
                    ],
                    datasets: [{
                        label: '{{ __('test.your_position') }}',
                        data: [
                            @foreach ($categories as $catId => $category)
                                @if (isset($categoryScores[$catId]))
                                    {{ $categoryScores[$catId] }},
                                @endif
                            @endforeach
                        ],
                        backgroundColor: 'rgba(220, 53, 69, 0.2)',
                        borderColor: 'rgba(220, 53, 69, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(220, 53, 69, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(220, 53, 69, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 25,
                                display: false
                            },
                            grid: {
                                color: '#dee2e6'
                            },
                            angleLines: {
                                color: '#dee2e6'
                            },
                            pointLabels: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        @endif

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
