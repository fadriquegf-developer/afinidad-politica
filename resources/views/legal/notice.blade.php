@extends('layouts.static')

@section('title', __('notice.title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-file-text me-2"></i>{{ __('notice.title') }}</h1>
    
    <p class="text-muted mb-4">{{ __('notice.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. {{ __('notice.identification_title') }}</h2>
        <p>{{ __('notice.identification_intro') }}</p>
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>{{ __('notice.holder') }}</th>
                    <td>Fadrique Garcia Font</td>
                </tr>
                <tr>
                    <th>{{ __('notice.nif') }}</th>
                    <td>41572677Q</td>
                </tr>
                <tr>
                    <th>{{ __('notice.address') }}</th>
                    <td>Carrer Alfabeguera 12</td>
                </tr>
                <tr>
                    <th>{{ __('notice.email') }}</th>
                    <td><a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a></td>
                </tr>
                <tr>
                    <th>{{ __('notice.website') }}</th>
                    <td><a href="https://afinidadpolitica.es">https://afinidadpolitica.es</a></td>
                </tr>
            </tbody>
        </table>

        <h2>2. {{ __('notice.purpose_title') }}</h2>
        <p>{!! __('notice.purpose_desc', ['site' => '<strong>Afinidad Política</strong>']) !!}</p>
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>{{ __('notice.important') }}:</strong> {{ __('notice.no_affiliation') }}
        </div>

        <h2>3. {{ __('notice.intellectual_property_title') }}</h2>
        <p>{{ __('notice.intellectual_property_ownership') }}</p>
        <p>{{ __('notice.intellectual_property_prohibition') }}</p>
        <p>{{ __('notice.intellectual_property_parties') }}</p>

        <h2>4. {{ __('notice.liability_title') }}</h2>
        
        <h3>4.1. {{ __('notice.liability_results_title') }}</h3>
        <p>{{ __('notice.liability_results_intro') }}</p>
        <ul>
            <li>{{ __('notice.liability_results_accuracy') }}</li>
            <li>{{ __('notice.liability_results_decisions') }}</li>
            <li>{{ __('notice.liability_results_recommend') }}</li>
        </ul>

        <h3>4.2. {{ __('notice.liability_operation_title') }}</h3>
        <p>{{ __('notice.liability_operation_intro') }}</p>
        <ul>
            <li>{{ __('notice.liability_operation_interruptions') }}</li>
            <li>{{ __('notice.liability_operation_viruses') }}</li>
            <li>{{ __('notice.liability_operation_misuse') }}</li>
        </ul>

        <h2>5. {{ __('notice.external_links_title') }}</h2>
        <p>{{ __('notice.external_links_desc') }}</p>

        <h2>6. {{ __('notice.neutrality_title') }}</h2>
        <p>{{ __('notice.neutrality_intro') }}</p>
        <ul>
            <li>{{ __('notice.neutrality_no_promotion') }}</li>
            <li>{{ __('notice.neutrality_neutral_questions') }}</li>
            <li>{{ __('notice.neutrality_equal_treatment') }}</li>
            <li>{{ __('notice.neutrality_no_funding') }}</li>
        </ul>

        <h2>7. {{ __('notice.terms_title') }}</h2>
        <p>{{ __('notice.terms_intro') }}</p>
        <ul>
            <li>{{ __('notice.terms_lawful') }}</li>
            <li>{{ __('notice.terms_no_damage') }}</li>
            <li>{{ __('notice.terms_no_access') }}</li>
            <li>{{ __('notice.terms_no_manipulation') }}</li>
        </ul>

        <h2>8. {{ __('notice.jurisdiction_title') }}</h2>
        <p>{{ __('notice.jurisdiction_desc') }}</p>

        <h2>9. {{ __('notice.modifications_title') }}</h2>
        <p>{{ __('notice.modifications_desc') }}</p>
    </div>
@endsection

@push('styles')
<style>
    .legal-content h2 {
        font-size: 1.3rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
        border-bottom: 2px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .legal-content h3 {
        font-size: 1.1rem;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #555;
    }
    .legal-content ul {
        margin-bottom: 1rem;
    }
    .legal-content li {
        margin-bottom: 0.5rem;
    }
    .legal-content .table th {
        width: 150px;
        background: #f8f9fa;
    }
</style>
@endpush