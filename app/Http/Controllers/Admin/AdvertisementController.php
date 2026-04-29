<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_ads' => Advertisement::count(),
            'active_ads' => Advertisement::where('status', 'approved')->count(),
            'rejected_ads' => Advertisement::where('status', 'rejected')->count(),
            'total_users' => User::count(),
            'banned_users' => User::where('is_banned', true)->count(),
        ];

        $recentAds = Advertisement::with('user', 'category')
            ->latest()
            ->limit(5)
            ->get();

        return view('components.pages.admin.dashboard', compact('stats', 'recentAds'));
    }

    public function index()
    {
        $advertisements = Advertisement::with('user', 'category')
            ->latest()
            ->paginate(50);

        return view('components.pages.admin.advertisements.index', compact('advertisements'));
    }

    public function show(Advertisement $advertisement)
    {
        $advertisement->load('user', 'category');

        return view('components.pages.admin.advertisements.show', compact('advertisement'));
    }

    public function edit(Advertisement $advertisement)
    {
        $categories = Category::whereNull('parent_id')->with('allChildren')->get();

        return view('components.pages.admin.advertisements.edit', compact('advertisement', 'categories'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $advertisement->update($validated);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Объявление обновлено');
    }

    public function reject(Advertisement $advertisement)
    {
        $advertisement->status = 'rejected';
        $advertisement->save();

        return back()->with('success', 'Объявление отклонено и скрыто с сайта');
    }

    public function approve(Advertisement $advertisement)
    {
        $advertisement->status = 'approved';
        $advertisement->save();

        return back()->with('success', 'Объявление одобрено и показано на сайте');
    }
}
