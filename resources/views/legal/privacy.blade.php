@extends('layouts.static')

@section('title', __('privacy.title'))

@section('static-content')
    <h1 class="mb-4"><i class="bi bi-shield-check me-2"></i>{{ __('privacy.title') }}</h1>
    
    <p class="text-muted mb-4">{{ __('privacy.last_updated') }}: {{ date('d/m/Y') }}</p>

    <div class="legal-content">
        <h2>1. {{ __('privacy.responsible_title') }}</h2>
        <p>
            <strong>{{ __('privacy.holder') }}:</strong> Fadrique Garcia Font<br>
            <strong>{{ __('privacy.nif') }}:</strong> 41572677Q<br>
            <strong>{{ __('privacy.address') }}:</strong> Carrer Alfabeguera 12<br>
            <strong>{{ __('privacy.email') }}:</strong> <a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>
        </p>

        <h2>2. {{ __('privacy.data_collected_title') }}</h2>
        <p>{!! __('privacy.data_collected_intro', ['site' => '<strong>Afinidad Política</strong>']) !!}</p>
        
        <h3>2.1. {{ __('privacy.data_not_collected') }}</h3>
        <ul>
            <li>{{ __('privacy.not_collected_name') }}</li>
            <li>{{ __('privacy.not_collected_email') }}</li>
            <li>{{ __('privacy.not_collected_phone') }}</li>
            <li>{{ __('privacy.not_collected_address') }}</li>
            <li>{{ __('privacy.not_collected_payment') }}</li>
        </ul>

        <h3>2.2. {{ __('privacy.data_yes_collected') }}</h3>
        <ul>
            <li><strong>{{ __('privacy.collected_answers_label') }}:</strong> {{ __('privacy.collected_answers_desc') }}</li>
            <li><strong>{{ __('privacy.collected_ip_label') }}:</strong> {{ __('privacy.collected_ip_desc') }}</li>
            <li><strong>{{ __('privacy.collected_session_label') }}:</strong> {{ __('privacy.collected_session_desc') }}</li>
            <li><strong>{{ __('privacy.collected_region_label') }}:</strong> {{ __('privacy.collected_region_desc') }}</li>
        </ul>

        <h2>3. {{ __('privacy.purpose_title') }}</h2>
        <p>{{ __('privacy.purpose_intro') }}</p>
        <ul>
            <li>{{ __('privacy.purpose_results') }}</li>
            <li>{{ __('privacy.purpose_compare') }}</li>
            <li>{{ __('privacy.purpose_stats') }}</li>
            <li>{{ __('privacy.purpose_improve') }}</li>
        </ul>

        <h2>4. {{ __('privacy.legal_basis_title') }}</h2>
        <p>{{ __('privacy.legal_basis_intro') }}</p>
        <ul>
            <li><strong>{{ __('privacy.legal_basis_consent_label') }}:</strong> {{ __('privacy.legal_basis_consent_desc') }}</li>
            <li><strong>{{ __('privacy.legal_basis_legitimate_label') }}:</strong> {{ __('privacy.legal_basis_legitimate_desc') }}</li>
        </ul>

        <h2>5. {{ __('privacy.retention_title') }}</h2>
        <p>{!! __('privacy.retention_desc', ['months' => '<strong>12 ' . __('privacy.months') . '</strong>']) !!}</p>

        <h2>6. {{ __('privacy.recipients_title') }}</h2>
        <p>{{ __('privacy.recipients_intro') }}</p>
        <ul>
            <li><strong>{{ __('privacy.recipients_hosting') }}:</strong> {{ __('privacy.recipients_hosting_desc') }}</li>
        </ul>

        <h2>7. {{ __('privacy.rights_title') }}</h2>
        <p>{{ __('privacy.rights_intro') }}</p>
        <ul>
            <li><strong>{{ __('privacy.right_access') }}:</strong> {{ __('privacy.right_access_desc') }}</li>
            <li><strong>{{ __('privacy.right_rectification') }}:</strong> {{ __('privacy.right_rectification_desc') }}</li>
            <li><strong>{{ __('privacy.right_erasure') }}:</strong> {{ __('privacy.right_erasure_desc') }}</li>
            <li><strong>{{ __('privacy.right_restriction') }}:</strong> {{ __('privacy.right_restriction_desc') }}</li>
            <li><strong>{{ __('privacy.right_portability') }}:</strong> {{ __('privacy.right_portability_desc') }}</li>
            <li><strong>{{ __('privacy.right_objection') }}:</strong> {{ __('privacy.right_objection_desc') }}</li>
        </ul>
        <p>{!! __('privacy.rights_note', ['email' => '<a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>']) !!}</p>

        <h2>8. {{ __('privacy.security_title') }}</h2>
        <p>{{ __('privacy.security_intro') }}</p>
        <ul>
            <li>{{ __('privacy.security_https') }}</li>
            <li>{{ __('privacy.security_hash') }}</li>
            <li>{{ __('privacy.security_access') }}</li>
            <li>{{ __('privacy.security_backup') }}</li>
        </ul>

        <h2>9. {{ __('privacy.minors_title') }}</h2>
        <p>{{ __('privacy.minors_desc') }}</p>

        <h2>10. {{ __('privacy.changes_title') }}</h2>
        <p>{{ __('privacy.changes_desc') }}</p>

        <h2>11. {{ __('privacy.contact_title') }}</h2>
        <p>{!! __('privacy.contact_desc', ['email' => '<a href="mailto:contacto@afinidadpolitica.es">contacto@afinidadpolitica.es</a>']) !!}</p>
        <p>{!! __('privacy.contact_aepd', ['aepd' => '<a href="https://www.aepd.es" target="_blank" rel="noopener">' . __('privacy.aepd_name') . '</a>']) !!}</p>
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
</style>
@endpush