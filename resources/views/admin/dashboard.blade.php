@extends(backpack_view('blank'))

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-0">
                    <i class="la la-chart-pie"></i> Dashboard de Estadísticas
                </h2>
                <p class="text-muted">Análisis de los tests de afinidad política realizados</p>
            </div>
        </div>

        {{-- KPI Cards --}}
        <div class="row">
            {{-- Tests Totales --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card border-start border-start-4 border-start-primary mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="fs-4 fw-semibold text-primary">{{ number_format($stats['total_tests']) }}</div>
                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Tests Totales</div>
                                <div class="mt-2">
                                    <span class="badge bg-success text-white">{{ $stats['completed_tests'] }} completados</span>
                                </div>
                            </div>
                            <div class="text-primary">
                                <i class="la la-poll la-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tests Hoy --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card border-start border-start-4 border-start-info mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="fs-4 fw-semibold text-info">{{ $stats['tests_today'] }}</div>
                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Tests Hoy</div>
                                <div class="mt-2">
                                    <span class="badge bg-info text-white">{{ $stats['completed_today'] }} completados</span>
                                </div>
                            </div>
                            <div class="text-info">
                                <i class="la la-calendar-check la-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tasa de Completado --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card border-start border-start-4 border-start-success mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="fs-4 fw-semibold text-success">{{ $stats['completion_rate'] }}%</div>
                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Tasa Completado</div>
                                <div class="mt-2">
                                    <div class="progress" style="height: 6px; width: 100px;">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ $stats['completion_rate'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-success">
                                <i class="la la-check-circle la-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Afinidad Media --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card border-start border-start-4 border-start-warning mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="fs-4 fw-semibold text-warning">{{ $stats['avg_top_affinity'] }}%</div>
                                <div class="text-medium-emphasis small text-uppercase fw-semibold">Afinidad Media</div>
                                <div class="mt-2">
                                    <span class="badge bg-secondary text-white">{{ $stats['total_answers'] }} respuestas</span>
                                </div>
                            </div>
                            <div class="text-warning">
                                <i class="la la-heart la-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Gráfico de Tests por Día --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="la la-chart-area"></i> Tests realizados (últimos 30 días)
                    </div>
                    <div class="card-body">
                        <canvas id="testsPerDayChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            {{-- Distribución por Partido --}}
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="la la-pie-chart"></i> Partido más afín
                    </div>
                    <div class="card-body">
                        @if (count($partyDistribution) > 0)
                            <canvas id="partyDistributionChart" height="200"></canvas>
                        @else
                            <div class="text-center text-muted py-5">
                                <i class="la la-chart-pie la-3x"></i>
                                <p class="mt-2">Sin datos suficientes</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Preguntas más Polémicas --}}
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="la la-fire text-danger"></i> Preguntas más Polémicas</span>
                        <span class="badge bg-secondary text-white">Mayor varianza</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pregunta</th>
                                        <th class="text-center">Resp.</th>
                                        <th class="text-center">Varianza</th>
                                        <th>Distribución</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($controversialQuestions as $q)
                                        <tr>
                                            <td>
                                                <div class="text-truncate" style="max-width: 180px;"
                                                    title="{{ $q['text'] }}">
                                                    {{ $q['text'] }}
                                                </div>
                                                <small class="text-muted">{{ $q['category'] }}</small>
                                            </td>
                                            <td class="text-center">{{ $q['answers_count'] }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge bg-{{ $q['variance'] > 1.5 ? 'danger' : ($q['variance'] > 1 ? 'warning' : 'success') }} text-white">
                                                    {{ $q['variance'] }}
                                                </span>
                                            </td>
                                            <td style="min-width: 100px;">
                                                <div class="d-flex gap-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @php
                                                            $count = $q['distribution'][$i] ?? 0;
                                                            $pct =
                                                                $q['answers_count'] > 0
                                                                    ? ($count / $q['answers_count']) * 100
                                                                    : 0;
                                                        @endphp
                                                        <div style="flex: 1; height: 20px; background: #eee; border-radius: 2px; overflow: hidden;"
                                                            title="{{ $count }} respuestas">
                                                            <div
                                                                style="height: {{ $pct }}%; background: {{ ['#dc3545', '#ffc107', '#6c757d', '#17a2b8', '#28a745'][$i - 1] }}; margin-top: {{ 100 - $pct }}%;">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="la la-inbox la-2x"></i>
                                                <p class="mb-0">Sin datos suficientes</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tests Recientes --}}
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="la la-clock"></i> Tests Recientes</span>
                        <a href="{{ backpack_url('test-result') }}" class="btn btn-sm btn-outline-primary">
                            Ver todos
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Partido Afín</th>
                                        <th class="text-center">Afinidad</th>
                                        <th class="text-center">Resp.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentTests as $test)
                                        <tr>
                                            <td>
                                                <small>{{ $test['completed_at'] }}</small>
                                            </td>
                                            <td>
                                                <span class="badge text-white" style="background: {{ $test['party_color'] }}">
                                                    {{ $test['party_name'] }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <strong>{{ $test['top_score'] }}%</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary text-white">{{ $test['answers_count'] }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="la la-inbox la-2x"></i>
                                                <p class="mb-0">No hay tests completados</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Estadísticas por Categoría --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="la la-folder-open"></i> Tendencia por Categoría
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Categoría</th>
                                        <th class="text-center">Preguntas</th>
                                        <th class="text-center">Respuestas</th>
                                        <th>Tendencia (Desacuerdo ↔ Acuerdo)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryStats as $cat)
                                        <tr>
                                            <td>
                                                <span style="color: {{ $cat['color'] }}">{{ $cat['icon'] }}</span>
                                                <strong>{{ $cat['name'] }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary text-white">{{ $cat['questions_count'] }}</span>
                                            </td>
                                            <td class="text-center">{{ number_format($cat['answers_count']) }}</td>
                                            <td style="min-width: 250px;">
                                                <div class="d-flex align-items-center">
                                                    <small class="text-danger me-2"
                                                        style="width: 35px;">{{ $cat['left_percent'] }}%</small>
                                                    <div class="progress flex-grow-1" style="height: 12px;">
                                                        <div class="progress-bar bg-danger"
                                                            style="width: {{ $cat['left_percent'] }}%"
                                                            title="En desacuerdo"></div>
                                                        <div class="progress-bar bg-secondary"
                                                            style="width: {{ $cat['center_percent'] }}%" title="Neutral">
                                                        </div>
                                                        <div class="progress-bar bg-success"
                                                            style="width: {{ $cat['right_percent'] }}%"
                                                            title="De acuerdo"></div>
                                                    </div>
                                                    <small class="text-success ms-2"
                                                        style="width: 35px;">{{ $cat['right_percent'] }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preguntas más Saltadas --}}
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="la la-forward text-warning"></i> Preguntas más Saltadas
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse(array_slice($skippedQuestions, 0, 6) as $q)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="text-truncate me-2" style="max-width: 200px;"
                                            title="{{ $q['text'] }}">
                                            <small>{{ $q['text'] }}</small>
                                        </div>
                                        <span
                                            class="badge bg-{{ $q['skip_rate'] > 30 ? 'danger' : ($q['skip_rate'] > 15 ? 'warning' : 'success') }} text-white">
                                            {{ $q['skip_rate'] }}%
                                        </span>
                                    </div>
                                    <small class="text-muted">{{ $q['category'] }}</small>
                                </div>
                            @empty
                                <div class="list-group-item text-center text-muted py-4">
                                    <i class="la la-inbox la-2x"></i>
                                    <p class="mb-0">Sin datos</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráfico de Abandono --}}
        @if (count($dropoffByQuestion) > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="la la-sign-out-alt text-danger"></i> Punto de Abandono
                            <small class="text-muted ms-2">¿En qué pregunta abandonan los usuarios?</small>
                        </div>
                        <div class="card-body">
                            <canvas id="dropoffChart" height="60"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datos
            const testsPerDay = @json($testsPerDay);
            const partyDistribution = @json($partyDistribution);
            const dropoffData = @json($dropoffByQuestion);

            // Gráfico de tests por día
            new Chart(document.getElementById('testsPerDayChart'), {
                type: 'line',
                data: {
                    labels: testsPerDay.map(d => d.date),
                    datasets: [{
                            label: 'Tests Totales',
                            data: testsPerDay.map(d => d.total),
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            fill: true,
                            tension: 0.4,
                        },
                        {
                            label: 'Completados',
                            data: testsPerDay.map(d => d.completed),
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            fill: true,
                            tension: 0.4,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Gráfico de distribución por partido
            if (partyDistribution.length > 0) {
                new Chart(document.getElementById('partyDistributionChart'), {
                    type: 'doughnut',
                    data: {
                        labels: partyDistribution.map(p => p.short_name),
                        datasets: [{
                            data: partyDistribution.map(p => p.count),
                            backgroundColor: partyDistribution.map(p => p.color),
                            borderWidth: 2,
                            borderColor: '#fff',
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });
            }

            // Gráfico de abandono
            if (dropoffData.length > 0) {
                new Chart(document.getElementById('dropoffChart'), {
                    type: 'bar',
                    data: {
                        labels: dropoffData.map(d => 'Pregunta ' + d.question_number),
                        datasets: [{
                            label: 'Abandonos',
                            data: dropoffData.map(d => d.dropoff_count),
                            backgroundColor: '#dc3545',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
