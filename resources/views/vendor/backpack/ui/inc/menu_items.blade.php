{{-- This file is used for menu items by any Backpack v7 theme --}}
<x-backpack::menu-item title="{{ trans('backpack::base.dashboard') }}" icon="la la-home" :link="backpack_url('dashboard')" />

<x-backpack::menu-dropdown title="Test Político" icon="la la-poll">
    <x-backpack::menu-dropdown-item title="Partidos" icon="la la-flag" :link="backpack_url('party')" />
    <x-backpack::menu-dropdown-item title="Categorías" icon="la la-folder" :link="backpack_url('category')" />
    <x-backpack::menu-dropdown-item title="Preguntas" icon="la la-question-circle" :link="backpack_url('question')" />
    <x-backpack::menu-dropdown-item title="Posiciones" icon="la la-balance-scale" :link="backpack_url('party-position')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-dropdown title="Estadísticas" icon="la la-chart-bar">
    <x-backpack::menu-dropdown-item title="Resultados" icon="la la-list-ol" :link="backpack_url('test-result')" />
    <x-backpack::menu-dropdown-item title="Respuestas" icon="la la-check-square" :link="backpack_url('test-answer')" />
</x-backpack::menu-dropdown>
