<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestResult;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class TestResultCrudController extends CrudController
{
    use ListOperation, ShowOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(TestResult::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/test-result');
        $this->crud->setEntityNameStrings('resultado', 'resultados');
        $this->crud->orderBy('created_at', 'desc');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Fecha', 'type' => 'datetime']);
        $this->crud->addColumn(['name' => 'topParty.short_name', 'label' => 'Partido Top']);
        $this->crud->addColumn([
            'name' => 'is_completed',
            'label' => 'Completado',
            'type' => 'boolean'
        ]);
        $this->crud->addColumn([
            'name' => 'answers_count',
            'label' => 'Respuestas',
            'type' => 'closure',
            'function' => fn($entry) => $entry->answers()->count()
        ]);
        $this->crud->addColumn(['name' => 'region', 'label' => 'Región']);

        $this->crud->addFilter([
            'name' => 'is_completed',
            'type' => 'select2',
            'label' => 'Estado'
        ], function () {
            return [1 => 'Completados', 0 => 'Abandonados'];
        }, function ($value) {
            $this->crud->addClause('where', 'is_completed', $value);
        });

        $this->crud->addFilter([
            'name' => 'top_party_id',
            'type' => 'select2',
            'label' => 'Partido Top'
        ], function () {
            return \App\Models\Party::pluck('short_name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'top_party_id', $value);
        });
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn(['name' => 'session_id', 'label' => 'Session ID']);
        $this->crud->addColumn(['name' => 'topParty.name', 'label' => 'Partido Top']);
        $this->crud->addColumn([
            'name' => 'results',
            'label' => 'Resultados',
            'type' => 'closure',
            'function' => function ($entry) {
                if (!$entry->results) return '-';
                $html = '<ul>';
                foreach ($entry->results as $partyId => $score) {
                    $party = \App\Models\Party::find($partyId);
                    $html .= '<li>' . ($party->short_name ?? $partyId) . ': ' . round($score, 1) . '%</li>';
                }
                return $html . '</ul>';
            }
        ]);
        $this->crud->addColumn(['name' => 'is_completed', 'label' => 'Completado', 'type' => 'boolean']);
        $this->crud->addColumn(['name' => 'completed_at', 'label' => 'Completado el', 'type' => 'datetime']);
        $this->crud->addColumn(['name' => 'region', 'label' => 'Región']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Creado', 'type' => 'datetime']);
    }
}
