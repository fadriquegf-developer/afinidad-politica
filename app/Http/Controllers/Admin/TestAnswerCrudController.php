<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestAnswer;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class TestAnswerCrudController extends CrudController
{
    use ListOperation;

    public function setup()
    {
        $this->crud->setModel(TestAnswer::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/test-answer');
        $this->crud->setEntityNameStrings('respuesta', 'respuestas');
        $this->crud->orderBy('created_at', 'desc');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'question.category.name', 'label' => 'Categoría']);
        $this->crud->addColumn(['name' => 'question.text', 'label' => 'Pregunta', 'limit' => 50]);
        $this->crud->addColumn([
            'name' => 'answer',
            'label' => 'Respuesta',
            'type' => 'closure',
            'function' => fn($entry) => ['1' => '😠', '2' => '😕', '3' => '😐', '4' => '🙂', '5' => '😃'][$entry->answer] ?? $entry->answer
        ]);
        $this->crud->addColumn(['name' => 'importance', 'label' => 'Importancia']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Fecha', 'type' => 'date']);

        $this->crud->addFilter([
            'name' => 'question_id',
            'type' => 'select2',
            'label' => 'Pregunta'
        ], function () {
            return \App\Models\Question::pluck('text', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'question_id', $value);
        });

        $this->crud->addFilter([
            'name' => 'answer',
            'type' => 'select2',
            'label' => 'Respuesta'
        ], function () {
            return [1 => '😠 1', 2 => '😕 2', 3 => '😐 3', 4 => '🙂 4', 5 => '😃 5'];
        }, function ($value) {
            $this->crud->addClause('where', 'answer', $value);
        });
    }
}
