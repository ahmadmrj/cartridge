<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PrinterModelRequest;
use App\Models\CartridgeMedia;
use App\Models\PrinterModelMedia;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

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
        $this->crud->addColumn(['name' => 'buy_link', 'type' => 'text', 'label' => __('Buy Link')]);
        $this->crud->addColumn([
            'name' => 'address',
            'type' => 'relimage',
            'label' => __('Picture'),
            'rel' => 'medias',
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
        $this->crud->addField(['name'=>'technical_title', 'type'=>'text', 'label'=>__('Technical Title')]);
        $this->crud->addField(['name'=>'buy_link', 'type'=>'text', 'label'=>__('Buy Link')]);
        $this->crud->addField([
            'name'=>'key_words',
            'type'=>'text',
            'label'=> "کلمات کلیدی (سئو)",
            'hint' => 'کلمات با ، از هم جدا شود.',
            'attributes' => [
                'placeholder' => 'کلمه کلیدی ۱، کلمه کلیدی۲، کلمه کلیدی، و ...',
            ]
        ]);

        $this->crud->addField(['name'=>'seo_title', 'type'=>'text', 'label'=>"عنوان جستجو (سئو)"]);
        $this->crud->addField(['name'=>'description', 'type'=>'textarea', 'label'=>"توضیحات (سئو)"]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        $this->crud->addField([
            'label' => __('Picture'),
            'name' => "picture",
            'type' => 'dropzone',
            'upload_route' => 'printer-media-upload',
            'mimes' => 'image/*',
            'filesize' => 1024,
            'reorder_route' => 'printer-media-reorder',
            'delete_route' => 'printer-media-delete',
            'display_route' => 'printer-media-list'
        ]);
    }

    public function uploadMedia(Request $request, $id) {
        foreach ($request->file('picture') as $file){
            $path = $file->store('printer_images', 'public_uploads');

            PrinterModelMedia::create(['printer_model_id'=>intval($id), 'address'=>$path]);
        }
        return json_encode(['result' => 'ok']);
    }

    public function RemoveMedia(Request $request, $id) {
        $img = PrinterModelMedia::where('printer_model_id', $id)
            ->where('id', $request->post('image_id'))
            ->first();

        \Storage::disk('public_uploads')->delete($img->address);

        $img->delete();
    }

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn('title');
        $this->crud->addColumn('buy_link');
        $this->crud->addColumn(['name' => 'picture', 'type' => 'image', 'label' => __('Picture')]);
    }
}
