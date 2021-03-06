<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CartridgeRequest;
use App\Models\CartridgeMedia;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
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
        $this->crud->setValidation(CartridgeRequest::class);

        $this->crud->addField([
            'name'  => 'printers',
            'type'  => 'select2_multiple',
            'label' => __('printer model'),
            'entity' => 'printers',
            'attribute' => 'title',
            'pivot'     => true
        ]);

        $this->crud->addField(['name'=>'title', 'type'=>'text', 'label'=>__('Title')]);
        $this->crud->addField(['name'=>'technical_title', 'type'=>'text', 'label'=>__('Technical Title')]);
        $this->crud->addField(['name'=>'page_yield', 'type'=>'number', 'label'=>__('Page Yield')]);
        $this->crud->addField([
            'name'=>'color',
            'type'=>'select_from_array',
            'label'=>__('Color'),
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
                'yellow' => 'Yellow',
                'All colors' => 'All colors'
            ]
        ]);

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
            'upload_route' => 'cart-media-upload',
            'mimes' => 'image/*',
            'filesize' => 1024,
            'reorder_route' => 'cart-media-reorder',
            'delete_route' => 'cart-media-delete',
            'default_route' => 'cart-media-default',
            'display_route' => 'cartridge-media-list'
        ]);
    }

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn('title');
        $this->crud->addColumn('color');
        $this->crud->addColumn('page_yield');
        $this->crud->addColumn('buy_link');
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

    public function uploadMedia(Request $request, $id) {
        foreach ($request->file('picture') as $file){
            $path = $file->store('cartridge_extra_images', 'public_uploads');

            CartridgeMedia::create(['cartridge_id'=>intval($id), 'address'=>$path]);
        }
        return json_encode(['result' => 'ok']);
    }

    public function RemoveMedia(Request $request, $id) {
        $img = CartridgeMedia::where('cartridge_id', $id)
            ->where('id', $request->post('image_id'))
            ->first();

        \Storage::disk('public_uploads')->delete($img->address);

        $img->delete();
    }

    public function DefaultMedia(Request $request, $id) {
        CartridgeMedia::where('cartridge_id', $id)->update(['is_default' => 0]);

        $img = CartridgeMedia::where('cartridge_id', $id)
            ->where('address', 'like', '%'.$request->post('image_id'))
            ->first();

        $img->default = 1;

        $img->save();

        return json_encode(['result' => 'ok']);
    }
}
