<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AutofocusErrors extends Component
{
    public string $field;
    public string $route;

    public function __construct(string $field = 'email', string $route = 'home')
    {
        $this->field = $field;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.autofocus-errors');
    }
}