<?php

namespace App\View\Components;

use App\Models\PrinterFamily;
use App\Models\PrinterModel;
use Illuminate\View\Component;

class PrinterSelect extends Component
{
    public $brands;
    public $selected;
    public $label;
    public $selectedFamily;
    public $selectedPrinter;
    /**
     * Create a new component instance.
     *
     * @param $brands
     * @param $selected
     * @param string $label
     */
    public function __construct($brands, $selected = null, $selectedFamily = null, $selectedPrinter = null, $label = 'landing')
    {
        $this->brands = $brands;
        $this->selected = $selected;
        $this->selectedFamily = $selectedFamily;
        $this->selectedPrinter = $selectedPrinter;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $families = [];
        $printers = [];
        if(!is_null($this->selected)) {
            $families = PrinterFamily::whereHas('brand', function($query) {
                $query->where('slug', $this->selected);
            })->get()->all();

            if($this->selectedPrinter) {
                $this->selectedFamily = PrinterModel::whereSlug($this->selectedPrinter)->first()->family_id;
            }
        
            $selFamily = $this->selectedFamily;
            $selBrand  = $this->selected;
            
            $query = PrinterModel::whereHas('family.brand', function($q) use($selBrand) {
                $q->whereSlug($selBrand);
            })->whereHas('family', function($q) use($selFamily) {
                if($selFamily) {
                    $q->whereId($selFamily);
                }
            });

            $printers = $query->get()->all();
        }

        return view('components.printer-select', compact('families', 'printers'));
    }
}
