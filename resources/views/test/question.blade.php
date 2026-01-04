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

                    {{-- Formulario único para respuesta e importancia --}}
                    <form action="{{ route('test.answer', $number) }}" method="POST" id="answerForm">
                        @csrf
                        <input type="hidden" name="answer" id="answerInput" value="{{ $existingAnswer->answer ?? '' }}">
                        <input type="hidden" name="importance" id="importanceInput"
                            value="{{ $existingAnswer->importance ?? 3 }}">

                        {{-- Respuestas con emojis --}}
                        <div class="d-flex justify-content-center gap-2 gap-md-3 mb-2 flex-wrap">
                            @php
                                $emojis = [1 => '😠', 2 => '😕', 3 => '😐', 4 => '🙂', 5 => '😃'];
                                $colors = [
                                    1 => 'danger',
                                    2 => 'warning',
                                    3 => 'secondary',
                                    4 => 'info',
                                    5 => 'success',
                                ];
                            @endphp
                            @foreach ($emojis as $value => $emoji)
                                <button type="button"
                                    class="btn btn-outline-{{ $colors[$value] }} btn-answer {{ ($existingAnswer->answer ?? null) == $value ? 'active bg-' . $colors[$value] . ' text-white' : '' }}"
                                    style="width: 60px; height: 60px; font-size: 1.5rem;" data-value="{{ $value }}"
                                    onclick="selectAnswer({{ $value }})">
                                    {{ $emoji }}
                                </button>
                            @endforeach
                        </div>

                        {{-- Leyenda de respuestas --}}
                        <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap small text-muted">
                            <span>😠 {{ __('test.strongly_disagree') }}</span>
                            <span>😃 {{ __('test.strongly_agree') }}</span>
                        </div>

                        {{-- Selector de importancia (solo modo completo) --}}
                        @if ($testMode === 'complete')
                            <div class="importance-section mt-4 pt-4 border-top" id="importanceSection"
                                style="display: {{ $existingAnswer->answer ?? null ? 'block' : 'none' }};">
                                <p class="text-center text-muted mb-3">
                                    <i class="bi bi-star me-1"></i>{{ __('test.importance_question') }}
                                </p>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    @php
                                        $importanceLabels = [
                                            1 => __('test.importance_1'),
                                            2 => __('test.importance_2'),
                                            3 => __('test.importance_3'),
                                            4 => __('test.importance_4'),
                                            5 => __('test.importance_5'),
                                        ];
                                    @endphp
                                    @foreach ($importanceLabels as $i => $label)
                                        <button type="button"
                                            class="btn btn-outline-secondary importance-btn px-3 py-2 {{ ($existingAnswer->importance ?? 3) == $i ? 'active btn-secondary text-white' : '' }}"
                                            data-importance="{{ $i }}"
                                            onclick="selectImportance({{ $i }})">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </div>
                                <p class="text-center text-muted small mt-3">
                                    <i class="bi bi-info-circle me-1"></i>{{ __('test.importance_hint') }}
                                </p>
                            </div>
                        @endif
                    </form>

                    {{-- Botón saltar --}}
                    <div class="text-center mb-4 mt-3">
                        <button type="button" class="btn btn-link btn-sm text-muted" onclick="skipQuestion()">
                            <i class="bi bi-skip-forward me-1"></i>{{ __('test.skip_question') }}
                        </button>
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
        const testMode = '{{ $testMode }}';
        let selectedAnswer = {{ $existingAnswer->answer ?? 'null' }};
        let selectedImportance = {{ $existingAnswer->importance ?? 3 }};

        function selectAnswer(value) {
            selectedAnswer = value;
            document.getElementById('answerInput').value = value;

            // Actualizar estilos de botones
            document.querySelectorAll('.btn-answer').forEach(btn => {
                const btnValue = parseInt(btn.dataset.value);
                const colors = {
                    1: 'danger',
                    2: 'warning',
                    3: 'secondary',
                    4: 'info',
                    5: 'success'
                };
                const color = colors[btnValue];

                btn.classList.remove('active', `bg-${color}`, 'text-white');
                btn.classList.add(`btn-outline-${color}`);

                if (btnValue === value) {
                    btn.classList.remove(`btn-outline-${color}`);
                    btn.classList.add('active', `bg-${color}`, 'text-white');
                }
            });

            // En modo completo, mostrar selector de importancia
            if (testMode === 'complete') {
                document.getElementById('importanceSection').style.display = 'block';
                // Scroll suave al selector de importancia
                document.getElementById('importanceSection').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else {
                // En modo rápido, enviar directamente
                document.getElementById('answerForm').submit();
            }
        }

        function selectImportance(value) {
            selectedImportance = value;
            document.getElementById('importanceInput').value = value;

            // Actualizar estilos de botones
            document.querySelectorAll('.importance-btn').forEach(btn => {
                btn.classList.remove('active', 'btn-secondary', 'text-white');
                btn.classList.add('btn-outline-secondary');
            });

            const btn = document.querySelector(`[data-importance="${value}"]`);
            if (btn) {
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('active', 'btn-secondary', 'text-white');
            }

            // Enviar formulario
            document.getElementById('answerForm').submit();
        }

        function skipQuestion() {
            document.getElementById('answerInput').value = 0;
            document.getElementById('answerForm').submit();
        }

        // Atajos de teclado
        document.addEventListener('keydown', function(e) {
            // Ignorar si está escribiendo en un input
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

            const key = e.key;

            // Números 1-5 para respuestas
            if (key >= '1' && key <= '5') {
                selectAnswer(parseInt(key));
            }
            // 0 o S para saltar
            else if (key === '0' || key.toLowerCase() === 's') {
                skipQuestion();
            }
            // Flechas para navegación
            else if (key === 'ArrowLeft') {
                const prevBtn = document.querySelector('a[href*="question/{{ $number - 1 }}"]');
                if (prevBtn) prevBtn.click();
            } else if (key === 'ArrowRight') {
                const nextBtn = document.querySelector('a[href*="question/{{ $number + 1 }}"]');
                if (nextBtn) nextBtn.click();
            }
            // En modo completo, teclas Q-W-E-R-T para importancia (si está visible)
            else if (testMode === 'complete' && selectedAnswer && selectedAnswer > 0) {
                const importanceKeys = {
                    'q': 1,
                    'w': 2,
                    'e': 3,
                    'r': 4,
                    't': 5
                };
                if (importanceKeys[key.toLowerCase()]) {
                    selectImportance(importanceKeys[key.toLowerCase()]);
                }
            }
        });
    </script>
@endpush
