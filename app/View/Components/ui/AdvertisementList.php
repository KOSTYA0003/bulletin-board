<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class AdvertisementList extends Component
{
    public $advertisements;

    public function __construct($advertisements = null)
    {
        $this->advertisements = $advertisements;
    }

    public function render()
    {
        return view('components.ui.advertisement-list');
    }
}
