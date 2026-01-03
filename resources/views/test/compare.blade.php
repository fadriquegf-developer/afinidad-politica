@extends('layouts.app')

@section('title', __('test.compare_results'))

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11">
        
        <h2 class="text-center mb-4">
            <i class="bi bi-people"></i> {{ __('test.compare_results') }}
        </h2>

        @if($data2)
            {{-- Puntuación de Compatibilidad --}}
            <div class="card mb-4 border-{{ $compatibility['level']['class'] }}">
                <div class="card-body text-center py-5">
                    <div class="display-1 mb-2">{{ $compatibility['level']['emoji'] }}</div>
                    <div class="display-4 fw-bold text-{{ $compatibility['level']['class'] }}">
                        {{ $compatibility['overall'] }}%
                    </div>
                    <h3 class="text-{{ $compatibility['level']['class'] }}">{{ $compatibility['level']['text'] }}</h3>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">
                            🧭 {{ __('test.compass_compatibility') }}: {{ $compatibility['compass'] }}%
                        </span>
                        <span class="badge bg-secondary">
                            📊 {{ __('test.category_compatibility') }}: {{ $compatibility['categories'] }}%
                        </span>
                    </div>
                </div>
            </div>

            {{-- Comparación lado a lado --}}
            <div class="row g-4">
                {{-- Persona 1 --}}
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header text-center" style="background: {{ $data1['topParty']->color }}20;">
                            <h5 class="mb-0">
                                <span class="badge" style="background: {{ $data1['topParty']->color }};">
                                    {{ $data1['topParty']->short_name }}
                                </span>
                                {{ __('test.person') }} 1
                            </h5>
                        </div>
                        <div class="card-body">
                            {{-- Resultado principal --}}
                            <div class="text-center mb-4">
                                <div class="display-5 fw-bold" style="color: {{ $data1['topParty']->color }};">
                                    {{ $data1['topScore'] }}%
                                </div>
                                <p class="mb-0" style="color: {{ $data1['topParty']->color }};">{{ $data1['topParty']->name }}</p>
                            </div>

                            {{-- Brújula --}}
                            <div class="text-center mb-4">
                                <div class="compass-mini mx-auto" style="width: 150px; height: 150px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        <rect x="0" y="0" width="100" height="100" fill="#dc3545" opacity="0.1"/>
                                        <rect x="100" y="0" width="100" height="100" fill="#0d6efd" opacity="0.1"/>
                                        <rect x="0" y="100" width="100" height="100" fill="#6f42c1" opacity="0.1"/>
                                        <rect x="100" y="100" width="100" height="100" fill="#198754" opacity="0.1"/>
                                        <line x1="100" y1="0" x2="100" y2="200" stroke="#adb5bd" stroke-width="1"/>
                                        <line x1="0" y1="100" x2="200" y2="100" stroke="#adb5bd" stroke-width="1"/>
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd" stroke-width="2"/>
                                        @php
                                            $x1 = 100 + ($data1['compass']['economic'] ?? 0);
                                            $y1 = 100 - ($data1['compass']['social'] ?? 0);
                                        @endphp
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="12" fill="{{ $data1['topParty']->color }}" opacity="0.3"/>
                                        <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="8" fill="{{ $data1['topParty']->color }}" stroke="#fff" stroke-width="2"/>
                                    </svg>
                                </div>
                                <small class="text-muted">
                                    E: {{ ($data1['compass']['economic'] ?? 0) > 0 ? '+' : '' }}{{ $data1['compass']['economic'] ?? 0 }} |
                                    S: {{ ($data1['compass']['social'] ?? 0) > 0 ? '+' : '' }}{{ $data1['compass']['social'] ?? 0 }}
                                </small>
                            </div>

                            {{-- Radar --}}
                            <canvas id="radar1" height="200"></canvas>
                        </div>
                        <div class="card-footer text-center bg-white">
                            <small class="text-muted">{{ __('test.code') }}: <code>{{ $data1['shareId'] }}</code></small>
                        </div>
                    </div>
                </div>

                {{-- Persona 2 --}}
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header text-center" style="background: {{ $data2['topParty']->color }}20;">
                            <h5 class="mb-0">
                                <span class="badge" style="background: {{ $data2['topParty']->color }};">
                                    {{ $data2['topParty']->short_name }}
                                </span>
                                {{ __('test.person') }} 2
                            </h5>
                        </div>
                        <div class="card-body">
                            {{-- Resultado principal --}}
                            <div class="text-center mb-4">
                                <div class="display-5 fw-bold" style="color: {{ $data2['topParty']->color }};">
                                    {{ $data2['topScore'] }}%
                                </div>
                                <p class="mb-0" style="color: {{ $data2['topParty']->color }};">{{ $data2['topParty']->name }}</p>
                            </div>

                            {{-- Brújula --}}
                            <div class="text-center mb-4">
                                <div class="compass-mini mx-auto" style="width: 150px; height: 150px; position: relative;">
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        <rect x="0" y="0" width="100" height="100" fill="#dc3545" opacity="0.1"/>
                                        <rect x="100" y="0" width="100" height="100" fill="#0d6efd" opacity="0.1"/>
                                        <rect x="0" y="100" width="100" height="100" fill="#6f42c1" opacity="0.1"/>
                                        <rect x="100" y="100" width="100" height="100" fill="#198754" opacity="0.1"/>
                                        <line x1="100" y1="0" x2="100" y2="200" stroke="#adb5bd" stroke-width="1"/>
                                        <line x1="0" y1="100" x2="200" y2="100" stroke="#adb5bd" stroke-width="1"/>
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd" stroke-width="2"/>
                                        @php
                                            $x2 = 100 + ($data2['compass']['economic'] ?? 0);
                                            $y2 = 100 - ($data2['compass']['social'] ?? 0);
                                        @endphp
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="12" fill="{{ $data2['topParty']->color }}" opacity="0.3"/>
                                        <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="8" fill="{{ $data2['topParty']->color }}" stroke="#fff" stroke-width="2"/>
                                    </svg>
                                </div>
                                <small class="text-muted">
                                    E: {{ ($data2['compass']['economic'] ?? 0) > 0 ? '+' : '' }}{{ $data2['compass']['economic'] ?? 0 }} |
                                    S: {{ ($data2['compass']['social'] ?? 0) > 0 ? '+' : '' }}{{ $data2['compass']['social'] ?? 0 }}
                                </small>
                            </div>

                            {{-- Radar --}}
                            <canvas id="radar2" height="200"></canvas>
                        </div>
                        <div class="card-footer text-center bg-white">
                            <small class="text-muted">{{ __('test.code') }}: <code>{{ $data2['shareId'] }}</code></small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Brújulas superpuestas --}}
            <div class="card mt-4 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">🧭 {{ __('test.compass_comparison') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="compass-combined mx-auto" style="width: 280px; height: 280px; position: relative;">
                                <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                    <rect x="0" y="0" width="100" height="100" fill="#dc3545" opacity="0.1"/>
                                    <rect x="100" y="0" width="100" height="100" fill="#0d6efd" opacity="0.1"/>
                                    <rect x="0" y="100" width="100" height="100" fill="#6f42c1" opacity="0.1"/>
                                    <rect x="100" y="100" width="100" height="100" fill="#198754" opacity="0.1"/>
                                    <line x1="100" y1="0" x2="100" y2="200" stroke="#adb5bd" stroke-width="1"/>
                                    <line x1="0" y1="100" x2="200" y2="100" stroke="#adb5bd" stroke-width="1"/>
                                    <line x1="50" y1="0" x2="50" y2="200" stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4"/>
                                    <line x1="150" y1="0" x2="150" y2="200" stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4"/>
                                    <line x1="0" y1="50" x2="200" y2="50" stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4"/>
                                    <line x1="0" y1="150" x2="200" y2="150" stroke="#dee2e6" stroke-width="0.5" stroke-dasharray="4"/>
                                    <rect x="0" y="0" width="200" height="200" fill="none" stroke="#adb5bd" stroke-width="2"/>
                                    
                                    {{-- Línea entre los dos puntos --}}
                                    <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}" 
                                          stroke="#6c757d" stroke-width="2" stroke-dasharray="5"/>
                                    
                                    {{-- Persona 1 --}}
                                    <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="12" fill="{{ $data1['topParty']->color }}" opacity="0.3"/>
                                    <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="8" fill="{{ $data1['topParty']->color }}" stroke="#fff" stroke-width="2"/>
                                    <text x="{{ $x1 + 12 }}" y="{{ $y1 - 12 }}" font-size="12" fill="{{ $data1['topParty']->color }}">1</text>
                                    
                                    {{-- Persona 2 --}}
                                    <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="12" fill="{{ $data2['topParty']->color }}" opacity="0.3"/>
                                    <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="8" fill="{{ $data2['topParty']->color }}" stroke="#fff" stroke-width="2"/>
                                    <text x="{{ $x2 + 12 }}" y="{{ $y2 - 12 }}" font-size="12" fill="{{ $data2['topParty']->color }}">2</text>
                                </svg>
                                
                                <span class="compass-label" style="top: -20px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_progressive') }}</span>
                                <span class="compass-label" style="bottom: -20px; left: 50%; transform: translateX(-50%);">{{ __('test.compass_conservative') }}</span>
                                <span class="compass-label" style="left: -50px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_left') }}</span>
                                <span class="compass-label" style="right: -50px; top: 50%; transform: translateY(-50%);">{{ __('test.compass_right') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <h6>{{ __('test.compatibility_by_category') }}</h6>
                            @foreach($categories as $category)
                                @if(isset($compatibility['categoryDetails'][$category->id]))
                                    @php $catCompat = $compatibility['categoryDetails'][$category->id]; @endphp
                                    <div class="mb-2">
                                        <div class="d-flex justify-content-between">
                                            <small>{{ $category->icon }} {{ $category->name }}</small>
                                            <small class="fw-bold">{{ $catCompat }}%</small>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-{{ $catCompat >= 70 ? 'success' : ($catCompat >= 40 ? 'warning' : 'danger') }}" 
                                                 style="width: {{ $catCompat }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Compartir comparación --}}
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h6>{{ __('test.share_comparison') }}</h6>
                    <div class="input-group input-group-sm w-75 mx-auto">
                        <input type="text" class="form-control" value="{{ route('test.compare', [$shareId1, $shareId2]) }}" id="compareUrl" readonly>
                        <button class="btn btn-outline-primary" onclick="copyCompareUrl()">
                            <i class="bi bi-clipboard"></i> {{ __('test.copy') }}
                        </button>
                    </div>
                </div>
            </div>

        @else
            {{-- Formulario para introducir el código del amigo --}}
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <span style="font-size: 4rem;">🤝</span>
                    </div>
                    <h4>{{ __('test.compare_intro') }}</h4>
                    <p class="text-muted">{{ __('test.compare_intro_desc') }}</p>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ url('/comparar/' . $shareId1) }}/</span>
                                <input type="text" class="form-control" id="friendCode" placeholder="{{ __('test.friend_code') }}">
                                <button class="btn btn-primary" onclick="goCompare()">
                                    {{ __('test.compare') }} <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            <small class="text-muted">
                                {{ __('test.your_code') }}: <code>{{ $shareId1 }}</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Botón volver --}}
        <div class="text-center mt-4">
            <a href="{{ route('test.shared', $shareId1) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> {{ __('test.back_to_results') }}
            </a>
            <a href="{{ route('test.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-house"></i> {{ __('test.home') }}
            </a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
@if($data2)
// Configuración común del radar
const radarOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        r: {
            beginAtZero: true,
            max: 100,
            ticks: { display: false },
            grid: { color: '#dee2e6' },
            angleLines: { color: '#dee2e6' },
            pointLabels: { font: { size: 9 } }
        }
    },
    plugins: { legend: { display: false } }
};

const labels = [
    @foreach($categories as $category)
        '{{ $category->icon }}',
    @endforeach
];

// Radar Persona 1
new Chart(document.getElementById('radar1'), {
    type: 'radar',
    data: {
        labels: labels,
        datasets: [{
            data: [
                @foreach($categories as $catId => $category)
                    {{ $data1['categoryScores'][$catId] ?? 50 }},
                @endforeach
            ],
            backgroundColor: '{{ $data1['topParty']->color }}33',
            borderColor: '{{ $data1['topParty']->color }}',
            borderWidth: 2
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
                @foreach($categories as $catId => $category)
                    {{ $data2['categoryScores'][$catId] ?? 50 }},
                @endforeach
            ],
            backgroundColor: '{{ $data2['topParty']->color }}33',
            borderColor: '{{ $data2['topParty']->color }}',
            borderWidth: 2
        }]
    },
    options: radarOptions
});

function copyCompareUrl() {
    const input = document.getElementById('compareUrl');
    input.select();
    navigator.clipboard.writeText(input.value);
    event.target.closest('button').innerHTML = '<i class="bi bi-check"></i> {{ __("test.copied") }}';
}
@endif

function goCompare() {
    const code = document.getElementById('friendCode').value.trim();
    if (code) {
        window.location.href = '{{ url("/comparar/" . $shareId1) }}/' + code;
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
}
.compass-combined {
    margin: 30px auto;
}
</style>
@endpush
