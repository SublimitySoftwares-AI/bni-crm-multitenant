<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthSessionStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $status = null
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.auth-session-status');
    }
}