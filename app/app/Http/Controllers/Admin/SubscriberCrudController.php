<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubscriberRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubscriberCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubscriberCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Subscriber::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/inscritos');
        CRUD::setEntityNameStrings('inscrito', 'inscritos');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name'  =>  'name',
            'label' =>  'Nome',
            'type'  =>  'text'
        ]);
        CRUD::addColumn([
            'name'  =>  'phone',
            'label' =>  'Telefone',
            'type'  =>  'text'
        ]);
        CRUD::addColumn([
            'name'  =>  'status',
            'label' =>  'Status',
            'type'  =>  'radio',
            'options' => [
                1 => 'Ativo',
                0 => 'Inativo'
            ],
            'inline' => true,
            'default' => 1
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SubscriberRequest::class);

        CRUD::addField([
            'name'  =>  'name',
            'label' =>  'Nome',
            'type'  =>  'text'
        ]);
        CRUD::addField([
            'name'  =>  'phone',
            'label' =>  'Telefone',
            'type'  =>  'text'
        ]);
        CRUD::addField([
            'name'  =>  'status',
            'label' =>  'Status',
            'type'  =>  'radio',
            'options' => [
                1 => 'Ativo',
                0 => 'Inativo'
            ],
            'inline' => true,
            'default' => 1
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'name'  =>  'name',
            'label' =>  'Nome',
            'type'  =>  'text'
        ]);
        CRUD::addColumn([
            'name'  =>  'phone',
            'label' =>  'Telefone',
            'type'  =>  'text'
        ]);
        CRUD::addColumn([
            'name'  =>  'status',
            'label' =>  'Status',
            'type'  =>  'radio',
            'options' => [
                1 => 'Ativo',
                0 => 'Inativo'
            ],
            'inline' => true,
            'default' => 1
        ]);

    }
}
