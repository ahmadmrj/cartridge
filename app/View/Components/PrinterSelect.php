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

            $this->selectedFamily = $families[0]->id;
        }

        if(!is_null($this->selectedFamily)) {
            $printers = PrinterModel::whereHas('family', function($query) {
                $query->where('id', $this->selectedFamily);
            })->get()->all();
        }

        return view('components.printer-select', compact('families', 'printers'));
    }
}
