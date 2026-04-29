<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $ska;

    public function __construct($ska)
    {
        $this->ska = strtoupper($ska);
    }

    public function render()
    {
        return view('components.footer');
    }
}
