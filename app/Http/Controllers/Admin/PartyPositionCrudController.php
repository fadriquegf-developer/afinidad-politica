<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartyPosition;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class PartyPositionCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(PartyPosition::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/party-position');
        $this->crud->setEntityNameStrings('posición', 'posiciones de partidos');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'party.short_name', 'label' => 'Partido']);
        $this->crud->addColumn(['name' => 'question.text', 'label' => 'Pregunta', 'limit' => 60]);
        $this->crud->addColumn([
            'name' => 'position',
            'label' => 'Posición',
            'type' => 'closure',
            'function' => fn($entry) => ['1' => '😠 1', '2' => '😕 2', '3' => '😐 3', '4' => '🙂 4', '5' => '😃 5'][$entry->position] ?? $entry->position
        ]);
        $this->crud->addColumn(['name' => 'weight', 'label' => 'Peso']);

        $this->crud->addFilter([
            'name' => 'party_id',
            'type' => 'select2',
            'label' => 'Partido'
        ], function () {
            return \App\Models\Party::pluck('short_name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'party_id', $value);
        });

        $this->crud->addFilter([
            'name' => 'question.category_id',
            'type' => 'select2',
            'label' => 'Categoría'
        ], function () {
            return \App\Models\Category::pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('whereHas', 'question', function ($q) use ($value) {
                $q->where('category_id', $value);
            });
        });
    }

    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'name' => 'party_id',
            'label' => 'Partido',
            'type' => 'select2',
            'entity' => 'party',
            'attribute' => 'short_name'
        ]);
        $this->crud->addField([
            'name' => 'question_id',
            'label' => 'Pregunta',
            'type' => 'select2',
            'entity' => 'question',
            'attribute' => 'text'
        ]);
        $this->crud->addField([
            'name' => 'position',
            'label' => 'Posición (1-5)',
            'type' => 'select_from_array',
            'options' => [1 => '😠 1 - Muy en contra', 2 => '😕 2 - En contra', 3 => '😐 3 - Neutral', 4 => '🙂 4 - A favor', 5 => '😃 5 - Muy a favor']
        ]);
        $this->crud->addField(['name' => 'justification', 'label' => 'Justificación (ES)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'justification_ca', 'label' => 'Justificación (CA)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'justification_eu', 'label' => 'Justificación (EU)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'justification_gl', 'label' => 'Justificación (GL)', 'type' => 'textarea']);
        $this->crud->addField([
            'name' => 'weight',
            'label' => 'Peso/Importancia',
            'type' => 'select_from_array',
            'options' => [1 => '1 - Baja', 2 => '2', 3 => '3 - Normal', 4 => '4', 5 => '5 - Alta'],
            'default' => 3
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
