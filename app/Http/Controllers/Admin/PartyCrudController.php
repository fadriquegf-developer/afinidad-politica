<?php

namespace App\Http\Controllers\Admin;

use App\Models\Party;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class PartyCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Party::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/party');
        $this->crud->setEntityNameStrings('partido', 'partidos');
        $this->crud->orderBy('order');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'order', 'label' => '#', 'type' => 'number']);
        $this->crud->addColumn(['name' => 'short_name', 'label' => 'Siglas']);
        $this->crud->addColumn(['name' => 'name', 'label' => 'Nombre']);
        $this->crud->addColumn([
            'name' => 'color',
            'label' => 'Color',
            'type' => 'custom_html',
            'value' => fn($entry) => '<span style="background:' . $entry->color . ';padding:2px 12px;border-radius:4px;">&nbsp;</span>'
        ]);
        $this->crud->addColumn(['name' => 'territorial_scope', 'label' => 'Ámbito']);
        $this->crud->addColumn(['name' => 'is_active', 'label' => 'Activo', 'type' => 'boolean']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->addField(['name' => 'name', 'label' => 'Nombre', 'type' => 'text']);
        $this->crud->addField(['name' => 'short_name', 'label' => 'Siglas', 'type' => 'text']);
        $this->crud->addField(['name' => 'slug', 'label' => 'Slug', 'type' => 'text']);
        $this->crud->addField(['name' => 'color', 'label' => 'Color', 'type' => 'color']);
        $this->crud->addField(['name' => 'logo', 'label' => 'Logo', 'type' => 'upload', 'upload' => true]);
        $this->crud->addField(['name' => 'ideology', 'label' => 'Ideología', 'type' => 'text']);
        $this->crud->addField(['name' => 'description', 'label' => 'Descripción', 'type' => 'textarea']);
        $this->crud->addField([
            'name' => 'territorial_scope',
            'label' => 'Ámbito territorial',
            'type' => 'select_from_array',
            'options' => ['nacional' => 'Nacional', 'autonomico' => 'Autonómico']
        ]);
        $this->crud->addField(['name' => 'website', 'label' => 'Web', 'type' => 'url']);
        $this->crud->addField(['name' => 'order', 'label' => 'Orden', 'type' => 'number', 'default' => 0]);
        $this->crud->addField(['name' => 'is_active', 'label' => 'Activo', 'type' => 'checkbox', 'default' => true]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
