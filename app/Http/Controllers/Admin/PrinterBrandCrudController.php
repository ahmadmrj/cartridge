<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PrinterBrandRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PrinterBrandCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PrinterBrandCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\PrinterBrand');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/printerbrand');
        $this->crud->setEntityNameStrings(__('printer brand'), __('printer brands'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => __('Title')]);
        $this->crud->addColumn(['name' => 'picture', 'type' => 'image', 'label' => __('Picture')]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PrinterBrandRequest::class);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => __('Title')]);
        $this->crud->addField([
            'label' => __('Picture'),
            'name' => "picture",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
