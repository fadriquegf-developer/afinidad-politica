<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class CategoryCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Category::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('categoría', 'categorías');
        $this->crud->orderBy('order');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'order', 'label' => '#']);
        $this->crud->addColumn(['name' => 'icon', 'label' => 'Icono']);
        $this->crud->addColumn(['name' => 'name', 'label' => 'Nombre']);
        $this->crud->addColumn([
            'name' => 'questions_count',
            'label' => 'Preguntas',
            'type' => 'closure',
            'function' => fn($entry) => $entry->questions()->count()
        ]);
        $this->crud->addColumn(['name' => 'is_active', 'label' => 'Activo', 'type' => 'boolean']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->addField(['name' => 'name', 'label' => 'Nombre', 'type' => 'text']);
        $this->crud->addField(['name' => 'slug', 'label' => 'Slug', 'type' => 'text']);
        $this->crud->addField(['name' => 'icon', 'label' => 'Icono (emoji)', 'type' => 'text', 'hint' => 'Ej: 🏛️']);
        $this->crud->addField(['name' => 'color', 'label' => 'Color', 'type' => 'color']);
        $this->crud->addField(['name' => 'description', 'label' => 'Descripción', 'type' => 'textarea']);
        $this->crud->addField(['name' => 'order', 'label' => 'Orden', 'type' => 'number', 'default' => 0]);
        $this->crud->addField(['name' => 'is_active', 'label' => 'Activo', 'type' => 'checkbox', 'default' => true]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
