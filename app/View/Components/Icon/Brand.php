<?php

// app/View/Components/Icon/Brand.php

namespace App\View\Components\Icon;

use Illuminate\View\Component;

class Brand extends Component
{
    public string $name;
    public int $size;

    public function __construct(string $name, int $size = 20)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.icon.brand');
    }
}