<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class ActiveLink extends Component
{
    public $href;

    public $activeClass;

    public function __construct($href, $activeClass = 'active')
    {
        $this->href = $href;
        $this->activeClass = $activeClass;
    }

    public function isActive()
    {
        return Route::currentRouteName() === $this->href;
    }

    public function render()
    {
        return view('components.active-link');
    }
}
