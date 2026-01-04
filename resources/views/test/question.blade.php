@extends('layouts.app')

@section('title', __('test.question') . ' ' . $number . '/' . $total)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    {{-- Progreso --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge" style="background: {{ $category->color }};">
                                {{ $category->icon }} {{ $category->name }}
                            </span>
                            <span class="text-muted small">{{ $number }}/{{ $total }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: {{ ($number / $total) * 100 }}%;"></div>
                        </div>
                    </div>

                    {{-- Pregunta con traducción --}}
                    <h4 class="mb-4 text-center lh-base">{{ $question->getTranslatedText() }}</h4>

                    {{-- Explicaciones colapsables con traducción --}}
                    <div class="text-center mb-4" x-data="{ showExplanation: false, showSimple: false }">
                        @if ($question->explanation)
                            <button type="button" class="btn btn-link btn-sm text-muted"
                                @click="showExplanation = !showExplanation">
                                <i class="bi bi-question-circle me-1"></i>{{ __('test.what_means') }}
                            </button>

                            <div x-show="showExplanation" x-transition class="alert alert-light text-start mt-2">
                                {{ $question->getTranslatedExplanation() }}

                                @if ($question->explanation_simple)
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-link btn-sm p-0 text-muted"
                                            @click="showSimple = !showSimple">
                                            {{ __('test.still_not_clear') }}
                                        </button>
                                        <div x-show="showSimple" x-transition class="alert alert-info mt-2 mb-0">
                                            🧒 {{ $question->getTranslatedExplanationSimple() }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Respuestas con emojis --}}
                    <div class="d-flex justify-content-center gap-2 gap-md-3 mb-2 flex-wrap">
                        @foreach ([1 => '😠', 2 => '😕', 3 => '😐', 4 => '🙂', 5 => '😃'] as $value => $emoji)
                            <form action="{{ route('test.answer', $number) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="answer" value="{{ $value }}">
                                <button type="submit"
                                    class="btn btn-outline-{{ ['danger', 'warning', 'secondary', 'info', 'success'][$value - 1] }} btn-answer {{ ($existingAnswer->answer ?? null) == $value ? 'active bg-' . ['danger', 'warning', 'secondary', 'info', 'success'][$value - 1] . ' text-white' : '' }}"
                                    style="width: 60px; height: 60px; font-size: 1.5rem;" data-value="{{ $value }}">
                                    {{ $emoji }}
                                </button>
                            </form>
                        @endforeach
                    </div>

                    {{-- Leyenda de respuestas --}}
                    <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap small text-muted">
                        <span>😠 {{ __('test.strongly_disagree') }}</span>
                        <span>😃 {{ __('test.strongly_agree') }}</span>
                    </div>

                    {{-- Botón saltar --}}
                    <div class="text-center mb-4">
                        <form action="{{ route('test.answer', $number) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="answer" value="0">
                            <button type="submit" class="btn btn-link btn-sm text-muted">
                                <i class="bi bi-skip-forward me-1"></i>{{ __('test.skip_question') }}
                            </button>
                        </form>
                    </div>

                    {{-- Navegación --}}
                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        @if ($number > 1)
                            <a href="{{ route('test.question', $number - 1) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> {{ __('test.previous') }}
                            </a>
                        @else
                            <div></div>
                        @endif

                        <div class="text-center">
                            <small class="text-muted">
                                {{ $answeredCount }} {{ __('test.answered') }}
                            </small>
                        </div>

                        @if ($existingAnswer && $number < $total)
                            <a href="{{ route('test.question', $number + 1) }}" class="btn btn-outline-secondary btn-sm">
                                {{ __('test.next') }} <i class="bi bi-arrow-right"></i>
                            </a>
                        @elseif($number >= $total)
                            <a href="{{ route('test.results') }}" class="btn btn-primary btn-sm">
                                {{ __('test.see_results') }} <i class="bi bi-check-lg"></i>
                            </a>
                        @else
                            <div></div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Atajos de teclado (info) --}}
            <div class="text-center mt-3">
                <small class="text-white-50">
                    <i class="bi bi-keyboard me-1"></i>{{ __('test.keyboard_hint') }}
                </small>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Atajos de teclado
        document.addEventListener('keydown', function(e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

            const key = parseInt(e.key);
            if (key >= 1 && key <= 5) {
                const btn = document.querySelector(`button[data-value="${key}"]`);
                if (btn) btn.click();
            }

            if (e.key === 'ArrowLeft') {
                const prevBtn = document.querySelector('a[href*="question/{{ $number - 1 }}"]');
                if (prevBtn) prevBtn.click();
            }

            if (e.key === 'ArrowRight') {
                const nextBtn = document.querySelector('a[href*="question/{{ $number + 1 }}"]');
                if (nextBtn) nextBtn.click();
            }
        });
    </script>
@endpush
