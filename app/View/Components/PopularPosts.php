<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PopularPosts extends Component
{
    public $posts;

    public function __construct()
    {
        $this->posts = Post::orderBy('views', 'desc')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('components.popular-posts');
    }
}
