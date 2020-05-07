<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PrinterFamilyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PrinterFamilyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PrinterFamilyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\PrinterFamily');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/printerfamily');
        $this->crud->setEntityNameStrings(__('printer family'), __('printer families'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name'=>'title', 'type'=>'text', 'title'=>__('title')]);
        $this->crud->addColumn([
            'label' => __("printer brand"),
            'type' => "select",
            'name' => 'brand_id', // the column that contains the ID of that connected entity;
            'entity' => 'brand', // the method that defines the relationship in your Model
            'attribute' => "title", // foreign key attribute that is shown to user
            'model' => "App\Models\PrinterBrand", // foreign key model
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PrinterFamilyRequest::class);

        $this->crud->addField(['name'=>'title', 'type'=>'text', 'title'=>__('Title')]);
        $this->crud->addField([
            'name'  => 'brand_id',
            'type'  => 'select2',
            'label' => __('printer brand'),
            'entity' => 'brand',
            'attribute' => 'title',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
