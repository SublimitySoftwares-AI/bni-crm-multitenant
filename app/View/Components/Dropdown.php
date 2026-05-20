<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $align = 'right',
        public int $width = '48'
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.dropdown');
    }
}