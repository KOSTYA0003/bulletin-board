<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('components.pages.admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('components.pages.admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Данные пользователя обновлены');
    }

    public function ban(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Нельзя забанить самого себя!');
        }

        if ($user->isAdmin()) {
            return back()->with('error', 'Нельзя забанить администратора!');
        }

        $user->is_banned = true;
        $user->save();

        return back()->with('success', 'Пользователь забанен');
    }

    public function unban(User $user)
    {
        $user->is_banned = false;
        $user->save();

        return back()->with('success', 'Пользователь разбанен');
    }

    public function makeAdmin(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Нельзя изменить свою роль!');
        }

        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'Пользователь назначен администратором');
    }

    public function makeUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Нельзя изменить свою роль!');
        }

        $user->role = 'user';
        $user->save();

        return back()->with('success', 'Пользователь назначен обычным пользователем');
    }
}
