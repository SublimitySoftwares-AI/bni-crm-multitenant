<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $type = 'text',
        public ?string $name = null,
        public ?string $value = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $autofocus = false,
        public ?string $autocomplete = null
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): \Illuminate\View\View
    {
        return view('components.text-input');
    }
}