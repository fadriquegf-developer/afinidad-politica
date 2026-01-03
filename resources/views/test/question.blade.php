@extends('layouts.app')

@section('title', __('test.question') . ' ' . $number . ' ' . __('test.of') . ' ' . $total)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-3 p-md-5">
                    {{-- Progreso --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="category-badge"
                                style="background: {{ $category->color }}20; color: {{ $category->color }};">
                                {{ $category->icon }} {{ $category->name }}
                            </span>
                            <span class="text-muted">
                                {{ $number }} {{ __('test.of') }} {{ $total }}
                            </span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ ($number / $total) * 100 }}%; background: {{ $category->color }};"></div>
                        </div>
                    </div>

                    {{-- Pregunta --}}
                    @php
                        $locale = app()->getLocale();
                        $textField = 'text_' . $locale;
                        $questionText =
                            $locale !== 'es' && $question->$textField ? $question->$textField : $question->text;
                    @endphp
                    <h4 class="mb-4 text-center lh-base">{{ $questionText }}</h4>

                    {{-- Explicaciones colapsables --}}
                    <div class="text-center mb-4" x-data="{ showExplanation: false, showSimple: false }">
                        @if ($question->explanation)
                            <button type="button" class="btn btn-link btn-sm text-muted"
                                @click="showExplanation = !showExplanation">
                                <i class="bi bi-question-circle me-1"></i>{{ __('test.what_means') }}
                            </button>

                            <div x-show="showExplanation" x-transition class="alert alert-light text-start mt-2">
                                {{ $question->explanation }}

                                @if ($question->explanation_simple)
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-link btn-sm p-0 text-muted"
                                            @click="showSimple = !showSimple">
                                            {{ __('test.still_not_clear') }}
                                        </button>
                                        <div x-show="showSimple" x-transition class="alert alert-info mt-2 mb-0">
                                            🧒 {{ $question->explanation_simple }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Respuestas - Click directo envía --}}
                    <div class="d-flex justify-content-center gap-2 gap-md-3 mb-3">
                        @foreach ([1 => '😠', 2 => '😕', 3 => '😐', 4 => '🙂', 5 => '😃'] as $value => $emoji)
                            <form action="{{ route('test.answer', $number) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="answer" value="{{ $value }}">
                                <button type="submit"
                                    class="btn btn-outline-{{ ['danger', 'warning', 'secondary', 'info', 'success'][$value - 1] }} btn-answer {{ ($existingAnswer->answer ?? null) == $value ? 'active bg-' . ['danger', 'warning', 'secondary', 'info', 'success'][$value - 1] . ' text-white' : '' }}">
                                    {{ $emoji }}
                                </button>
                            </form>
                        @endforeach
                    </div>

                    <div class="text-center mb-4">
                        <small class="text-muted">
                            😠 {{ __('test.strongly_disagree') }} — {{ __('test.strongly_agree') }} 😃
                        </small>
                    </div>

                    {{-- Navegación --}}
                    <div class="d-flex justify-content-between mt-4">
                        @if ($number > 1)
                            <a href="{{ route('test.question', $number - 1) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> {{ __('test.previous') }}
                            </a>
                        @else
                            <div></div>
                        @endif

                        @if ($existingAnswer && $number < $total)
                            <a href="{{ route('test.question', $number + 1) }}" class="btn btn-outline-secondary btn-sm">
                                {{ __('test.next') }} <i class="bi bi-arrow-right"></i>
                            </a>
                        @elseif($existingAnswer && $number >= $total)
                            <a href="{{ route('test.results') }}" class="btn btn-primary btn-sm">
                                {{ __('test.see_results') }} <i class="bi bi-check-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
