@extends('layouts.app')

@section('title', __('test.compare_results'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">

            {{-- Header --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-4">
                    <h2 class="mb-2">
                        <i class="bi bi-people-fill text-primary"></i> {{ __('test.compare_results') }}
                    </h2>
                    <p class="text-muted mb-0">{{ __('test.compare_intro') }}</p>
                </div>
            </div>

            @if ($data2)
                {{-- Puntuación de Compatibilidad Principal --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body py-4"
                        style="background: linear-gradient(135deg, {{ $compatibility['level']['class'] === 'success' ? '#d4edda' : ($compatibility['level']['class'] === 'warning' ? '#fff3cd' : '#f8d7da') }} 0%, #ffffff 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <div style="font-size: 5rem;">{{ $compatibility['level']['emoji'] }}</div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="display-3 fw-bold text-{{ $compatibility['level']['class'] }}">
                                    {{ $compatibility['overall'] }}%
                                </div>
                                <h4 class="text-{{ $compatibility['level']['class'] }} mb-0">
                                    {{ $compatibility['level']['text'] }}
                                </h4>
                            </div>
                            <div class="col-md-4 text-center text-md-start mt-3 mt-md-0">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                        <span class="me-2">🧭</span>
                                        <div class="flex-grow-1" style="max-width: 150px;">
                                            <div class="d-flex justify-content-between small">
                                                <span>{{ __('test.compass_compatibility') }}</span>
                                                <strong>{{ $compatibility['compass'] }}%</strong>
                                            </div>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-{{ $compatibility['compass'] >= 70 ? 'success' : ($compatibility['compass'] >= 40 ? 'warning' : 'danger') }}"
                                                    style="width: {{ $compatibility['compass'] }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                        <span class="me-2">📊</span>
                                        <div class="flex-grow-1" style="max-width: 150px;">
                                            <div class="d-flex justify-content-between small">
                                                <span>{{ __('test.category_compatibility') }}</span>
                                                <strong>{{ $compatibility['categories'] }}%</strong>
                                            </div>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-{{ $compatibility['categories'] >= 70 ? 'success' : ($compatibility['categories'] >= 40 ? 'warning' : 'danger') }}"
                                                    style="width: {{ $compatibility['categories'] }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comparación de Resultados Principales --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>{{ __('test.top_affinity') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Persona 1 --}}
                            <div class="col-md-5">
                                <div class="text-center p-3 rounded-3"
                                    style="background: {{ $data1['topParty']->color }}10; border: 2px solid {{ $data1['topParty']->color }}30;">
                                    <span class="badge mb-2"
                                        style="background: {{ $data1['topParty']->color }};">{{ __('test.person') }}
                                        1</span>
                                    <div class="display-5 fw-bold" style="color: {{ $data1['topParty']->color }};">
                                        {{ $data1['topScore'] }}%
                                    </div>
                                    <div class="h5 mb-1" style="color: {{ $data1['topParty']->color }};">
                                        {{ $data1['topParty']->short_name }}
                                    </div>
                                    <small class="text-muted">{{ $data1['topParty']->name }}</small>
                                </div>
                            </div>

                            {{-- VS --}}
                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                <div class="text-center py-3">
                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <span class="fw-bold text-muted">VS</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Persona 2 --}}
                            <div class="col-md-5">
                                <div class="text-center p-3 rounded-3"
                                    style="background: {{ $data2['topParty']->color }}10; border: 2px solid {{ $data2['topParty']->color }}30;">
                                    <span class="badge mb-2"
                                        style="background: {{ $data2['topParty']->color }};">{{ __('test.person') }}
                                        2</span>
                                    <div class="display-5 fw-bold" style="color: {{ $data2['topParty']->color }};">
                                        {{ $data2['topScore'] }}%
                                    </div>
                                    <div class="h5 mb-1" style="color: {{ $data2['topParty']->color }};">
                                        {{ $data2['topParty']->short_name }}
                                    </div>
                                    <small class="text-muted">{{ $data2['topParty']->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Brújulas Políticas --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">🧭 {{ __('test.compass_comparison') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            {{-- Brújula Persona 1 --}}
                            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                                <h6 class="text-muted mb-3">{{ __('test.person') }} 1</h6>
                                <div class="compass-container mx-auto"
                                    style="width: 180px; height: 180px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        <rect x="0" y="0" width="100" height="100" fill="#e74c3c" opacity="0.08" />
                                        <rect x="100" y="0" width="100" height="100" fill="#f39c12" opacity="0.08" />
                                        <rect x="0" y="100" width="100" height="100" fill="#9b59b6" opacity="0.08" />
                                        <rect x="100" y="100" width="100" height="100" fill="#3498db" opacity="0.08" />
                                        <line x1="100" y1="0" x2="100" y2="200" stroke="#adb5bd"
                                            stroke-width="1" />
                                        <line x1="0" y1="100" x2="200" y2="100"
                                            stroke="#adb5bd" stroke-width="1" />
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd"
                                            stroke-width="2" />
                                        @php
                                            $x1 = 100 + ($data1['compass']['economic'] ?? 0) * 0.9;
                                            $y1 = 100 - ($data1['compass']['social'] ?? 0) * 0.9;
                                        @endphp
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="12"
                                            fill="{{ $data1['topParty']->color }}" opacity="0.3" />
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="8"
                                            fill="{{ $data1['topParty']->color }}" stroke="#fff" stroke-width="2" />
                                    </svg>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-secondary">E:
                                        {{ ($data1['compass']['economic'] ?? 0) > 0 ? '+' : '' }}{{ $data1['compass']['economic'] ?? 0 }}</span>
                                    <span class="badge bg-secondary">S:
                                        {{ ($data1['compass']['social'] ?? 0) > 0 ? '+' : '' }}{{ $data1['compass']['social'] ?? 0 }}</span>
                                </div>
                            </div>

                            {{-- Brújula Combinada --}}
                            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                                <h6 class="text-muted mb-3">{{ __('test.combined') }}</h6>
                                <div class="compass-container mx-auto"
                                    style="width: 220px; height: 220px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        <rect x="0" y="0" width="100" height="100" fill="#e74c3c" opacity="0.08" />
                                        <rect x="100" y="0" width="100" height="100" fill="#f39c12"
                                            opacity="0.08" />
                                        <rect x="0" y="100" width="100" height="100" fill="#9b59b6"
                                            opacity="0.08" />
                                        <rect x="100" y="100" width="100" height="100" fill="#3498db"
                                            opacity="0.08" />
                                        <line x1="100" y1="0" x2="100" y2="200"
                                            stroke="#adb5bd" stroke-width="1" />
                                        <line x1="0" y1="100" x2="200" y2="100"
                                            stroke="#adb5bd" stroke-width="1" />
                                        <line x1="50" y1="0" x2="50" y2="200"
                                            stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="150" y1="0" x2="150" y2="200"
                                            stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="0" y1="50" x2="200" y2="50"
                                            stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4" />
                                        <line x1="0" y1="150" x2="200" y2="150"
                                            stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4" />
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd"
                                            stroke-width="2" />

                                        @php
                                            $x2 = 100 + ($data2['compass']['economic'] ?? 0) * 0.9;
                                            $y2 = 100 - ($data2['compass']['social'] ?? 0) * 0.9;
                                        @endphp

                                        {{-- Línea entre puntos --}}
                                        <line x1="{{ $x1 }}" y1="{{ $y1 }}"
                                            x2="{{ $x2 }}" y2="{{ $y2 }}" stroke="#6c757d"
                                            stroke-width="2" stroke-dasharray="5" />

                                        {{-- Persona 1 --}}
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="14"
                                            fill="{{ $data1['topParty']->color }}" opacity="0.3" />
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="10"
                                            fill="{{ $data1['topParty']->color }}" stroke="#fff" stroke-width="2" />
                                        <text x="{{ $x1 }}" y="{{ $y1 + 4 }}" font-size="10"
                                            fill="#fff" text-anchor="middle" font-weight="bold">1</text>

                                        {{-- Persona 2 --}}
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="14"
                                            fill="{{ $data2['topParty']->color }}" opacity="0.3" />
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="10"
                                            fill="{{ $data2['topParty']->color }}" stroke="#fff" stroke-width="2" />
                                        <text x="{{ $x2 }}" y="{{ $y2 + 4 }}" font-size="10"
                                            fill="#fff" text-anchor="middle" font-weight="bold">2</text>
                                    </svg>

                                    <span class="compass-label"
                                        style="top: -20px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_progressive') }}</span>
                                    <span class="compass-label"
                                        style="bottom: -20px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_conservative') }}</span>
                                    <span class="compass-label"
                                        style="left: -45px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_left') }}</span>
                                    <span class="compass-label"
                                        style="right: -45px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_right') }}</span>
                                </div>
                            </div>

                            {{-- Brújula Persona 2 --}}
                            <div class="col-lg-4 text-center">
                                <h6 class="text-muted mb-3">{{ __('test.person') }} 2</h6>
                                <div class="compass-container mx-auto"
                                    style="width: 180px; height: 180px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        <rect x="0" y="0" width="100" height="100" fill="#e74c3c" opacity="0.08" />
                                        <rect x="100" y="0" width="100" height="100" fill="#f39c12"
                                            opacity="0.08" />
                                        <rect x="0" y="100" width="100" height="100" fill="#9b59b6"
                                            opacity="0.08" />
                                        <rect x="100" y="100" width="100" height="100" fill="#3498db"
                                            opacity="0.08" />
                                        <line x1="100" y1="0" x2="100" y2="200"
                                            stroke="#adb5bd" stroke-width="1" />
                                        <line x1="0" y1="100" x2="200" y2="100"
                                            stroke="#adb5bd" stroke-width="1" />
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd"
                                            stroke-width="2" />
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="12"
                                            fill="{{ $data2['topParty']->color }}" opacity="0.3" />
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="8"
                                            fill="{{ $data2['topParty']->color }}" stroke="#fff" stroke-width="2" />
                                    </svg>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-secondary">E:
                                        {{ ($data2['compass']['economic'] ?? 0) > 0 ? '+' : '' }}{{ $data2['compass']['economic'] ?? 0 }}</span>
                                    <span class="badge bg-secondary">S:
                                        {{ ($data2['compass']['social'] ?? 0) > 0 ? '+' : '' }}{{ $data2['compass']['social'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comparación por Categorías --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">📊 {{ __('test.compatibility_by_category') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                @if (isset($compatibility['categoryDetails'][$category->id]))
                                    @php
                                        $catCompat = $compatibility['categoryDetails'][$category->id];
                                        $score1 = $data1['categoryScores'][$category->id] ?? 50;
                                        $score2 = $data2['categoryScores'][$category->id] ?? 50;
                                    @endphp
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="p-3 rounded-3 h-100" style="background: #f8f9fa;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span>{{ $category->icon }} {{ $category->name }}</span>
                                                <span
                                                    class="badge bg-{{ $catCompat >= 70 ? 'success' : ($catCompat >= 40 ? 'warning' : 'danger') }}">
                                                    {{ $catCompat }}%
                                                </span>
                                            </div>
                                            <div class="progress mb-2" style="height: 8px;">
                                                <div class="progress-bar bg-{{ $catCompat >= 70 ? 'success' : ($catCompat >= 40 ? 'warning' : 'danger') }}"
                                                    style="width: {{ $catCompat }}%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between small text-muted">
                                                <span style="color: {{ $data1['topParty']->color }}">P1:
                                                    {{ $score1 }}%</span>
                                                <span style="color: {{ $data2['topParty']->color }}">P2:
                                                    {{ $score2 }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Gráficos Radar Comparativos --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-header bg-white border-0 pt-3">
                        <h5 class="mb-0">📈 {{ __('test.profile_comparison') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <div class="text-center mb-3">
                                    <span class="badge" style="background: {{ $data1['topParty']->color }};">
                                        {{ __('test.person') }} 1 - {{ $data1['topParty']->short_name }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center"
                                    style="position: relative; height: 320px; width: 100%;">
                                    <canvas id="radar1"></canvas>
                                </div>
                                <div class="text-center mt-2">
                                    <small class="text-muted">{{ __('test.code') }}:
                                        <code>{{ $data1['shareId'] }}</code></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-center mb-3">
                                    <span class="badge" style="background: {{ $data2['topParty']->color }};">
                                        {{ __('test.person') }} 2 - {{ $data2['topParty']->short_name }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center"
                                    style="position: relative; height: 320px; width: 100%;">
                                    <canvas id="radar2"></canvas>
                                </div>
                                <div class="text-center mt-2">
                                    <small class="text-muted">{{ __('test.code') }}:
                                        <code>{{ $data2['shareId'] }}</code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Compartir comparación --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h6 class="mb-1"><i class="bi bi-share me-2"></i>{{ __('test.share_comparison') }}
                                </h6>
                                <small class="text-muted">{{ __('test.share_comparison_desc') }}</small>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ route('test.compare', [$shareId1, $shareId2]) }}" id="compareUrl"
                                        readonly>
                                    <button class="btn btn-primary btn-sm" onclick="copyCompareUrl()">
                                        <i class="bi bi-clipboard"></i> {{ __('test.copy') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Formulario para introducir el código del amigo --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <span style="font-size: 5rem;">🤝</span>
                        </div>
                        <h3 class="mb-2">{{ __('test.compare_intro') }}</h3>
                        <p class="text-muted mb-4">{{ __('test.compare_intro_desc') }}</p>

                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6">
                                <div class="input-group input-group-lg mb-3">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person-plus"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="friendCode"
                                        placeholder="{{ __('test.friend_code') }}"
                                        onkeypress="if(event.key === 'Enter') goCompare()">
                                    <button class="btn btn-primary px-4" onclick="goCompare()">
                                        {{ __('test.compare') }} <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="alert alert-light border mb-0">
                                    <small>
                                        <i class="bi bi-info-circle me-1"></i>
                                        {{ __('test.your_code') }}: <code
                                            class="user-select-all">{{ $shareId1 }}</code>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Botones de navegación --}}
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('test.shared', $shareId1) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('test.back_to_results') }}
                        </a>
                        <a href="{{ route('test.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-house me-1"></i> {{ __('test.home') }}
                        </a>
                        <a href="{{ route('test.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-repeat me-1"></i> {{ __('test.take_test_again') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if ($data2)
            // Configuración común del radar
            const radarOptions = {
                responsive: true,
                maintainAspectRatio: true,
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
            };

            const labels = [
                @foreach ($categories as $category)
                    '{{ $category->icon }} {{ Str::limit($category->name, 12) }}',
                @endforeach
            ];

            // Radar Persona 1
            new Chart(document.getElementById('radar1'), {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: [
                            @foreach ($categories as $catId => $category)
                                {{ $data1['categoryScores'][$catId] ?? 50 }},
                            @endforeach
                        ],
                        backgroundColor: '{{ $data1['topParty']->color }}33',
                        borderColor: '{{ $data1['topParty']->color }}',
                        borderWidth: 2,
                        pointBackgroundColor: '{{ $data1['topParty']->color }}',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: radarOptions
            });

            // Radar Persona 2
            new Chart(document.getElementById('radar2'), {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: [
                            @foreach ($categories as $catId => $category)
                                {{ $data2['categoryScores'][$catId] ?? 50 }},
                            @endforeach
                        ],
                        backgroundColor: '{{ $data2['topParty']->color }}33',
                        borderColor: '{{ $data2['topParty']->color }}',
                        borderWidth: 2,
                        pointBackgroundColor: '{{ $data2['topParty']->color }}',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: radarOptions
            });

            function copyCompareUrl() {
                const input = document.getElementById('compareUrl');
                input.select();
                navigator.clipboard.writeText(input.value);

                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i> {{ __('test.copied') }}';
                btn.classList.replace('btn-primary', 'btn-success');

                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.classList.replace('btn-success', 'btn-primary');
                }, 2000);
            }
        @endif

        function goCompare() {
            const code = document.getElementById('friendCode').value.trim();
            if (code) {
                window.location.href = '{{ url('/comparar/' . $shareId1) }}/' + code;
            }
        }
    </script>
@endpush

@push('styles')
    <style>
        .compass-label {
            position: absolute;
            font-size: 0.7rem;
            color: #6c757d;
            white-space: nowrap;
            font-weight: 500;
        }

        .compass-container {
            margin: 10px auto;
        }

        .card {
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 10px;
        }

        code {
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 4px;
            color: #e83e8c;
        }
    </style>
@endpush
