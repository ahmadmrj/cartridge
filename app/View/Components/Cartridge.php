<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Cartridge extends Component
{
    public $cartData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cartData)
    {
        $this->cartData = $cartData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cartridge');
    }
}
