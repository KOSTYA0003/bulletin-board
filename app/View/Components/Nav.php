<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class Nav extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('components.nav', [
            'categories' => $categories,
        ]);
    }
}
