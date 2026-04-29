<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();

        foreach ($categories as $category) {
            $categoryIds = $category->getAllDescendantIds()->push($category->id);
            $category->advertisements_count = Advertisement::whereIn('category_id', $categoryIds)
                ->where('status', 'approved')
                ->count();
        }

        return view('components.pages.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $categoryIds = $category->getAllDescendantIds()->push($category->id);

        $advertisements = Advertisement::whereIn('category_id', $categoryIds)
            ->where('status', 'approved')
            ->with('user', 'category')
            ->latest()
            ->paginate(15);

        $categoryTree = $category->load('allChildren');

        return view('components.pages.categories.show', compact('category', 'advertisements', 'categoryTree'));
    }
}
