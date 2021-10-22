<?php

namespace App\Http\Controllers\Admin;

use App\Events\SaveFeedEvent;
use App\Http\Requests\SubscriberRequest;
use App\Models\Audience;
use App\Models\Subscriber;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

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
            'type'  =>  'phone'
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

    public function show(Request $request)
    {
        $subscriber = Subscriber::find($request->id);
        $crud = $this->crud;

        // return $crud;
        // dd($crud);

        $feeds = array();
        $filtro = array_count_values(array_column($subscriber->feeds->toArray(), 'title'));

        foreach($filtro as $k=>$v) {
            $feeds[] = array(
                'title' => $k,
                'count' => $v
            );
        }

        $feed_count = count($feeds);
        // if (auth()->check()) {
        return view('vendor.backpack.crud.show', compact('crud', 'subscriber', 'feeds', 'feed_count'));

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

    public function store()
    {

        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // insert item in the db
        $item = $this->crud->create($this->crud->getStrippedSaveRequest());
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();


        // save the redirect choice for next time
        $this->crud->setSaveAction();

        //envia a lista de feeds
        event(new SaveFeedEvent());

        return $this->crud->performSaveAction($item->getKey());
    }



}
