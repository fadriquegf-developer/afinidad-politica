@extends('layouts.app')

@section('title', __('test.results_title'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-5">🎉 {{ __('test.results_title') }}</h2>

                    {{-- Partido principal --}}
                    @php $topPartyId = array_key_first($results); @endphp
                    <div class="text-center mb-5 p-4 rounded-3" style="background: {{ $parties[$topPartyId]->color }}20;">
                        <p class="text-muted mb-2">{{ __('test.your_top_party') }}</p>
                        <h3 class="display-6 fw-bold" style="color: {{ $parties[$topPartyId]->color }};">
                            {{ $parties[$topPartyId]->name }}
                        </h3>
                        <div class="display-4 fw-bold" style="color: {{ $parties[$topPartyId]->color }};">
                            {{ $results[$topPartyId] }}%
                        </div>
                        <small class="text-muted">{{ __('test.affinity') }}</small>
                    </div>

                    {{-- Todos los resultados --}}
                    <div class="mb-5">
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
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $score }}%; background: {{ $parties[$partyId]->color }};"
                                        aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex justify-content-center gap-3">
                        <form action="{{ route('test.restart') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-repeat me-1"></i> {{ __('test.restart') }}
                            </button>
                        </form>
                    </div>

                    <p class="text-muted text-center mt-4 small">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ __('test.anonymous') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
