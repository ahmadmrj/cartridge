<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PrinterModelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PrinterModelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PrinterModelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\PrinterModel');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/printermodel');
        $this->crud->setEntityNameStrings(__('printer model'), __('printer models'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name'=>'title', 'type'=>'text', 'title'=>__('title')]);
        $this->crud->addColumn([
            'label' => __("printer model"),
            'type' => "select",
            'name' => 'family_id', // the column that contains the ID of that connected entity;
            'entity' => 'family', // the method that defines the relationship in your Model
            'attribute' => "title", // foreign key attribute that is shown to user
            'model' => "App\Models\PrinterFamily", // foreign key model
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PrinterModelRequest::class);

        $this->crud->addField(['name'=>'title', 'type'=>'text', 'title'=>__('Title')]);
        $this->crud->addField([
            'name'  => 'family_id',
            'type'  => 'select2',
            'label' => __('printer family'),
            'entity' => 'family',
            'attribute' => 'title',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
