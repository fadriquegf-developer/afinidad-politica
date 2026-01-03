{{-- This file is used for menu items by any Backpack v7 theme --}}

{{-- Dashboard de Estadísticas --}}
<x-backpack::menu-item title="📊 Dashboard" icon="la la-chart-pie" :link="backpack_url('dashboard')" />

<x-backpack::menu-separator title="Gestión" />

<x-backpack::menu-dropdown title="Test Político" icon="la la-poll">
    <x-backpack::menu-dropdown-item title="Partidos" icon="la la-flag" :link="backpack_url('party')" />
    <x-backpack::menu-dropdown-item title="Categorías" icon="la la-folder" :link="backpack_url('category')" />
    <x-backpack::menu-dropdown-item title="Preguntas" icon="la la-question-circle" :link="backpack_url('question')" />
    <x-backpack::menu-dropdown-item title="Posiciones" icon="la la-balance-scale" :link="backpack_url('party-position')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-separator title="Datos" />

<x-backpack::menu-dropdown title="Resultados" icon="la la-chart-bar">
    <x-backpack::menu-dropdown-item title="Tests Realizados" icon="la la-list-ol" :link="backpack_url('test-result')" />
    <x-backpack::menu-dropdown-item title="Respuestas" icon="la la-check-square" :link="backpack_url('test-answer')" />
</x-backpack::menu-dropdown>
