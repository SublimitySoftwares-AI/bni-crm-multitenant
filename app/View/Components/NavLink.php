<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $href = '#',
        public bool $active = false
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.nav-link');
    }
}