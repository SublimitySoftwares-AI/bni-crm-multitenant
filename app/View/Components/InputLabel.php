<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputLabel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $value = '',
        public ?string $for = null
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.input-label');
    }
}