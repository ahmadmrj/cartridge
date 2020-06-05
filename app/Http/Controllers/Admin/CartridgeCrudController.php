<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CartridgeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CartridgeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CartridgeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Cartridge');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/cartridge');
        $this->crud->setEntityNameStrings(__('cartridge'), __('cartridges'));
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => __('Title')]);
        $this->crud->addColumn(['name' => 'color', 'type' => 'text', 'label' => __('Color')]);
        $this->crud->addColumn(['name' => 'page_yield', 'type' => 'text', 'label' => __('Page Yield')]);
        $this->crud->addColumn(['name' => 'picture', 'type' => 'image', 'label' => __('Picture')]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CartridgeRequest::class);

        $this->crud->addField([
            'name'  => 'printers',
            'type'  => 'select2_multiple',
            'label' => __('printer model'),
            'entity' => 'printers',
            'attribute' => 'title',
            'pivot'     => true
        ]);

        $this->crud->addField(['name'=>'title', 'type'=>'text', 'title'=>__('Title')]);
        $this->crud->addField(['name'=>'page_yield', 'type'=>'number', 'title'=>__('Page Yield')]);
        $this->crud->addField([
            'name'=>'color',
            'type'=>'select_from_array',
            'title'=>__('Color'),
            'options' => [
                'black' => 'Black',
                'blue' => 'Blue',
                'cyan' => 'Cyan',
                'gray' => 'Gray',
                'green' => 'Green',
                'light_black' => 'Light Black',
                'light_cyan' => 'Light Cyan',
                'light_gray' => 'Light Gray',
                'light_magenta' => 'Light Magenta',
                'magenta' => 'Magenta',
                'magenta_cyan_yellow' => 'Magenta / Cyan / Yellow',
                'matte_black' => 'Matte Black',
                'micr' => 'MICR',
                'n_a' => 'N/A',
                'orange' => 'Orange',
                'photo_black' => 'Photo Black',
                'red' => 'Red',
                'yellow' => 'Yellow'
            ]
        ]);

        $this->crud->addField(['name'=>'buy_link', 'type'=>'text', 'title'=>__('Buy Link')]);
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

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn('title');
        $this->crud->addColumn('color');
        $this->crud->addColumn('page_yield');
        $this->crud->addColumn(['name' => 'picture', 'type' => 'image', 'label' => __('Picture')]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => __("Printers"), // Table column heading
            'type' => "select_multiple",
            'name' => 'printers', // the method that defines the relationship in your Model
            'entity' => 'printers', // the method that defines the relationship in your Model
            'attribute' => "title", // foreign key attribute that is shown to user
            'model' => "App\Models\PrinterModel", // foreign key model
        ]);
    }
}