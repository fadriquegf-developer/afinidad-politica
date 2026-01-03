<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class QuestionCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Question::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/question');
        $this->crud->setEntityNameStrings('pregunta', 'preguntas');
        $this->crud->orderBy('category_id')->orderBy('order');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'category.name', 'label' => 'Categoría']);
        $this->crud->addColumn(['name' => 'order', 'label' => '#']);
        $this->crud->addColumn(['name' => 'text', 'label' => 'Pregunta', 'limit' => 80]);
        $this->crud->addColumn([
            'name' => 'positions_count',
            'label' => 'Posiciones',
            'type' => 'closure',
            'function' => fn($entry) => $entry->positions()->count() . '/9'
        ]);
        $this->crud->addColumn(['name' => 'is_active', 'label' => 'Activo', 'type' => 'boolean']);

        $this->crud->addFilter([
            'name' => 'category_id',
            'type' => 'select2',
            'label' => 'Categoría'
        ], function () {
            return \App\Models\Category::pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'category_id', $value);
        });
    }

    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'name' => 'category_id',
            'label' => 'Categoría',
            'type' => 'select2',
            'entity' => 'category',
            'attribute' => 'name'
        ]);
        $this->crud->addField(['name' => 'text', 'label' => 'Pregunta (ES)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'text_ca', 'label' => 'Pregunta (CA)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'text_eu', 'label' => 'Pregunta (EU)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'text_gl', 'label' => 'Pregunta (GL)', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'explanation', 'label' => 'Explicación', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'order', 'label' => 'Orden', 'type' => 'number', 'default' => 0]);
        $this->crud->addField(['name' => 'is_active', 'label' => 'Activo', 'type' => 'checkbox', 'default' => true]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
