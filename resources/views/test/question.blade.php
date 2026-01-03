@extends('layouts.app')

@section('title', __('test.question') . ' ' . $number . ' ' . __('test.of') . ' ' . $total)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    {{-- Progreso --}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="category-badge"
                                style="background: {{ $category->color }}20; color: {{ $category->color }};">
                                {{ $category->icon }} {{ $category->name }}
                            </span>
                            <span class="text-muted">
                                {{ __('test.question') }} {{ $number }} {{ __('test.of') }} {{ $total }}
                            </span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ ($number / $total) * 100 }}%; background: {{ $category->color }};"></div>
                        </div>
                    </div>

                    {{-- Pregunta --}}
                    <h4 class="mb-5 text-center lh-base">
                        @php
                            $locale = app()->getLocale();
                            $textField = 'text_' . $locale;
                            $questionText =
                                $locale !== 'es' && $question->$textField ? $question->$textField : $question->text;
                        @endphp
                        {{ $questionText }}
                    </h4>

                    {{-- Formulario --}}
                    <form action="{{ route('test.answer', $number) }}" method="POST" x-data="{ answer: {{ $existingAnswer->answer ?? 'null' }}, importance: {{ $existingAnswer->importance ?? 3 }} }">
                        @csrf

                        <p class="text-center text-muted mb-3">{{ __('test.your_opinion') }}</p>

                        {{-- Opciones de respuesta --}}
                        <div class="d-flex justify-content-center gap-2 gap-md-3 mb-4">
                            <button type="button" class="btn btn-outline-danger btn-answer"
                                :class="{ 'active bg-danger text-white': answer === 1 }" @click="answer = 1"
                                title="{{ __('test.strongly_disagree') }}">😠</button>
                            <button type="button" class="btn btn-outline-warning btn-answer"
                                :class="{ 'active bg-warning': answer === 2 }" @click="answer = 2"
                                title="{{ __('test.disagree') }}">😕</button>
                            <button type="button" class="btn btn-outline-secondary btn-answer"
                                :class="{ 'active bg-secondary text-white': answer === 3 }" @click="answer = 3"
                                title="{{ __('test.neutral') }}">😐</button>
                            <button type="button" class="btn btn-outline-info btn-answer"
                                :class="{ 'active bg-info text-white': answer === 4 }" @click="answer = 4"
                                title="{{ __('test.agree') }}">🙂</button>
                            <button type="button" class="btn btn-outline-success btn-answer"
                                :class="{ 'active bg-success text-white': answer === 5 }" @click="answer = 5"
                                title="{{ __('test.strongly_agree') }}">😃</button>
                        </div>

                        <div class="text-center mb-4">
                            <small class="text-muted">
                                <span class="me-3">😠 {{ __('test.strongly_disagree') }}</span>
                                <span>😃 {{ __('test.strongly_agree') }}</span>
                            </small>
                        </div>

                        <input type="hidden" name="answer" x-model="answer">

                        {{-- Importancia --}}
                        <div class="mb-4" x-show="answer !== null" x-transition>
                            <p class="text-center text-muted mb-2">{{ __('test.importance') }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" class="btn btn-sm"
                                        :class="importance >= {{ $i }} ? 'btn-primary' : 'btn-outline-primary'"
                                        @click="importance = {{ $i }}">★</button>
                                @endfor
                            </div>
                            <div class="text-center mt-1">
                                <small class="text-muted">
                                    <span class="me-3">{{ __('test.low') }}</span>
                                    <span>{{ __('test.high') }}</span>
                                </small>
                            </div>
                        </div>

                        <input type="hidden" name="importance" x-model="importance">

                        {{-- Navegación --}}
                        <div class="d-flex justify-content-between mt-5">
                            @if ($number > 1)
                                <a href="{{ route('test.question', $number - 1) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> {{ __('test.previous') }}
                                </a>
                            @else
                                <div></div>
                            @endif

                            <button type="submit" class="btn btn-primary" :disabled="answer === null">
                                @if ($number >= $total)
                                    {{ __('test.see_results') }} <i class="bi bi-check-lg ms-1"></i>
                                @else
                                    {{ __('test.next') }} <i class="bi bi-arrow-right ms-1"></i>
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
