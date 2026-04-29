<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::where('status', 'approved')
            ->latest()
            ->with('user', 'category')
            ->paginate(10);

        return view('components.pages.advertisements.index', compact('advertisements'));
    }

    public function allAdvertisements(Request $request)
    {
        $query = Advertisement::where('status', 'approved')
            ->with('user', 'category');

        $advertisements = $query->latest()->paginate(15);

        return view('components.pages.advertisements.all', compact('advertisements'));
    }

    public function show(Advertisement $advertisement)
    {
        if ($advertisement->status !== 'approved') {
            if (! Auth::check() || Auth::id() !== $advertisement->user_id || ! Auth::user()->isAdmin()) {
                abort(404);
            }
        }

        return view('components.pages.advertisements.show', compact('advertisement'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('allChildren')->get();

        return view('components.pages.advertisements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',

            //         'images' => 'nullable|array|max:5',
            // 'images.*' => 'image|max:10240',
        ]);

        $category = Category::find($validated['category_id']);
        if (! $category->isLeaf()) {
            return back()->with('error', 'Нельзя создавать объявления в этой категории');
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('advertisements', 'public');
                $imagePaths[] = $path;
            }
        }

        $advertisement = Advertisement::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'user_id' => Auth::id(),
            'images' => $imagePaths,
        ]);

        $advertisement->status = 'approved';
        $advertisement->save();

        return redirect()->route('advertisements.my')
            ->with('success', 'Объявление успешно создано!');
    }

    public function edit(Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        $categories = Category::whereNull('parent_id')->with('allChildren')->get();

        return view('components.pages.advertisements.edit', compact('advertisement', 'categories'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePaths = $advertisement->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('advertisements', 'public');
                $imagePaths[] = $path;
            }
        }

        $advertisement->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'images' => $imagePaths,
        ]);

        return redirect()->route('advertisements.show', $advertisement)
            ->with('success', 'Объявление обновлено!');
    }

    public function destroy(Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        if (is_array($advertisement->images)) {
            foreach ($advertisement->images as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $advertisement->delete();

        return back()->with('success', 'Объявление и все фотографии удалены!');
    }

    public function myAdvertisements()
    {
        $advertisements = Advertisement::where('user_id', Auth::id())
            ->latest()
            ->with('category')
            ->paginate(10);

        return view('components.pages.advertisements.my', compact('advertisements'));
    }
}
