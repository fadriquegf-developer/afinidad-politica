@extends('layouts.app')

@section('title', __('test.results_title'))

@php
    $topPartyId = array_key_first($results);
    $shareUrl = route('test.shared', $shareId);
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Resultado principal --}}
            <div class="card mb-4">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4">🎉 {{ __('test.results_title') }}</h2>

                    <div class="row">
                        {{-- Partido principal --}}
                        <div class="col-lg-6">
                            <div class="text-center p-4 rounded-3 h-100" style="background: {{ $parties[$topPartyId]->color }}15;">
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
                                        {{ __('test.based_on') }} {{ $answeredCount }} {{ __('test.of') }} {{ $totalQuestions }} {{ __('test.questions_answered') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Brújula Política --}}
                        <div class="col-lg-6 mt-4 mt-lg-0">
                            <div class="text-center">
                                <h5 class="mb-3">🧭 {{ __('test.your_political_compass') }}</h5>
                                <div class="compass-container mx-auto" style="width: 280px; height: 280px; position: relative;">
                                    {{-- Fondo del compass --}}
                                    <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                        {{-- Cuadrantes con colores --}}
                                        <rect x="0" y="0" width="100" height="100" fill="#e74c3c" opacity="0.15"/>
                                        <rect x="100" y="0" width="100" height="100" fill="#3498db" opacity="0.15"/>
                                        <rect x="0" y="100" width="100" height="100" fill="#9b59b6" opacity="0.15"/>
                                        <rect x="100" y="100" width="100" height="100" fill="#27ae60" opacity="0.15"/>
                                        
                                        {{-- Líneas de ejes --}}
                                        <line x1="100" y1="0" x2="100" y2="200" stroke="#ccc" stroke-width="1"/>
                                        <line x1="0" y1="100" x2="200" y2="100" stroke="#ccc" stroke-width="1"/>
                                        
                                        {{-- Líneas de cuadrícula --}}
                                        <line x1="50" y1="0" x2="50" y2="200" stroke="#eee" stroke-width="0.5"/>
                                        <line x1="150" y1="0" x2="150" y2="200" stroke="#eee" stroke-width="0.5"/>
                                        <line x1="0" y1="50" x2="200" y2="50" stroke="#eee" stroke-width="0.5"/>
                                        <line x1="0" y1="150" x2="200" y2="150" stroke="#eee" stroke-width="0.5"/>
                                        
                                        {{-- Borde --}}
                                        <rect x="0" y="0" width="200" height="200" fill="none" stroke="#ddd" stroke-width="2"/>
                                        
                                        {{-- Punto del usuario --}}
                                        @php
                                            // Convertir de -100/+100 a coordenadas SVG (0-200)
                                            $x = 100 + ($compassPosition['economic'] ?? 0);
                                            $y = 100 - ($compassPosition['social'] ?? 0); // Invertir Y
                                        @endphp
                                        <circle cx="{{ $x }}" cy="{{ $y }}" r="8" fill="#e74c3c" stroke="#fff" stroke-width="2"/>
                                        <circle cx="{{ $x }}" cy="{{ $y }}" r="12" fill="#e74c3c" opacity="0.3"/>
                                    </svg>
                                    
                                    {{-- Etiquetas --}}
                                    <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); font-size: 0.75rem; color: #666;">
                                        {{ __('test.compass_progressive') }}
                                    </div>
                                    <div style="position: absolute; bottom: -25px; left: 50%; transform: translateX(-50%); font-size: 0.75rem; color: #666;">
                                        {{ __('test.compass_conservative') }}
                                    </div>
                                    <div style="position: absolute; left: -60px; top: 50%; transform: translateY(-50%); font-size: 0.75rem; color: #666;">
                                        {{ __('test.compass_left') }}
                                    </div>
                                    <div style="position: absolute; right: -60px; top: 50%; transform: translateY(-50%); font-size: 0.75rem; color: #666;">
                                        {{ __('test.compass_right') }}
                                    </div>
                                </div>
                                
                                {{-- Valores numéricos --}}
                                <div class="mt-3">
                                    <span class="badge bg-secondary me-2">
                                        {{ __('test.economic') }}: 
                                        @if(($compassPosition['economic'] ?? 0) < -20)
                                            {{ __('test.compass_left') }}
                                        @elseif(($compassPosition['economic'] ?? 0) > 20)
                                            {{ __('test.compass_right') }}
                                        @else
                                            {{ __('test.compass_center') }}
                                        @endif
                                        ({{ ($compassPosition['economic'] ?? 0) > 0 ? '+' : '' }}{{ $compassPosition['economic'] ?? 0 }})
                                    </span>
                                    <span class="badge bg-secondary">
                                        {{ __('test.social') }}: 
                                        @if(($compassPosition['social'] ?? 0) > 20)
                                            {{ __('test.compass_progressive') }}
                                        @elseif(($compassPosition['social'] ?? 0) < -20)
                                            {{ __('test.compass_conservative') }}
                                        @else
                                            {{ __('test.compass_center') }}
                                        @endif
                                        ({{ ($compassPosition['social'] ?? 0) > 0 ? '+' : '' }}{{ $compassPosition['social'] ?? 0 }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- URL compartible --}}
            <div class="card mb-4 border-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="mb-2"><i class="bi bi-share me-2"></i>{{ __('test.share_your_results') }}</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $shareUrl }}" id="shareUrl" readonly>
                                <button class="btn btn-outline-primary" type="button" onclick="copyShareUrl()">
                                    <i class="bi bi-clipboard"></i> {{ __('test.copy') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode(__('test.share_text_twitter', ['party' => $parties[$topPartyId]->name, 'percent' => $results[$topPartyId]])) }}&url={{ urlencode($shareUrl) }}" 
                                   target="_blank" class="btn btn-outline-dark">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode(__('test.share_text_whatsapp', ['party' => $parties[$topPartyId]->name, 'percent' => $results[$topPartyId], 'url' => $shareUrl])) }}" 
                                   target="_blank" class="btn btn-outline-success">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" 
                                   target="_blank" class="btn btn-outline-primary">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Todos los partidos --}}
            <div class="card mb-4">
                <div class="card-header">
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
                            <div class="progress" style="height: 25px; cursor: pointer;" 
                                 data-bs-toggle="collapse" 
                                 data-bs-target="#details-{{ $partyId }}"
                                 title="{{ __('test.click_for_details') }}">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $score }}%; background: {{ $parties[$partyId]->color }};">
                                </div>
                            </div>
                            
                            {{-- Detalles --}}
                            <div class="collapse mt-2" id="details-{{ $partyId }}">
                                <div class="card card-body bg-light">
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <h6 class="text-success"><i class="bi bi-check-circle me-1"></i>{{ __('test.you_agree_on') }}</h6>
                                            @if (!empty($partyMatches[$partyId]['matches']))
                                                <ul class="small mb-0 ps-3">
                                                    @foreach ($partyMatches[$partyId]['matches'] as $match)
                                                        <li class="mb-1">
                                                            {{ Str::limit($match['question'], 60) }}
                                                            <span class="badge bg-success ms-1">{{ $match['match_percent'] }}%</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="small text-muted mb-0">{{ __('test.no_strong_matches') }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h6 class="text-danger"><i class="bi bi-x-circle me-1"></i>{{ __('test.you_disagree_on') }}</h6>
                                            @if (!empty($partyMatches[$partyId]['divergences']))
                                                <ul class="small mb-0 ps-3">
                                                    @foreach ($partyMatches[$partyId]['divergences'] as $div)
                                                        <li class="mb-1">
                                                            {{ Str::limit($div['question'], 60) }}
                                                            <span class="badge bg-danger ms-1">{{ $div['match_percent'] }}%</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="small text-muted mb-0">{{ __('test.no_strong_divergences') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Resultados por categoría --}}
            @if (!empty($resultsByCategory))
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('test.results_by_category') }}</h5>
                    </div>
                    <div class="card-body p-0">
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
                                                    <span style="color: {{ $category->color }};">{{ $category->icon }}</span>
                                                    {{ $category->name }}
                                                </td>
                                                @foreach ($results as $partyId => $score)
                                                    @php 
                                                        $catScore = $resultsByCategory[$catId][$partyId] ?? 0;
                                                    @endphp
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $catScore >= 70 ? 'success' : ($catScore >= 40 ? 'warning' : 'danger') }}">
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
            <div class="d-flex justify-content-center gap-3 mb-4">
                <form action="{{ route('test.restart') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-repeat me-1"></i> {{ __('test.restart') }}
                    </button>
                </form>
            </div>

            <p class="text-muted text-center small">
                <i class="bi bi-info-circle me-1"></i>
                {{ __('test.results_disclaimer') }}
            </p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function copyShareUrl() {
    const input = document.getElementById('shareUrl');
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value);
    
    // Feedback visual
    const btn = event.target.closest('button');
    const originalHtml = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check"></i> {{ __("test.copied") }}';
    btn.classList.remove('btn-outline-primary');
    btn.classList.add('btn-success');
    
    setTimeout(() => {
        btn.innerHTML = originalHtml;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline-primary');
    }, 2000);
}

// Limpiar localStorage
localStorage.removeItem('test_progress');
</script>
@endpush

@push('styles')
<style>
.compass-container {
    margin: 20px auto;
}
.progress[data-bs-toggle="collapse"]:hover {
    opacity: 0.85;
}
</style>
@endpush