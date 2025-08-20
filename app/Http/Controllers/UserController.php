<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("userIndex", ['users' => $users]);
    }

    public function create()
    {
        return view('userCreate');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('userShow', ['user' => $user]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('user.index', absolute: false));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('editUser', ['user' => $user]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }
        return redirect(route('user.index', absolute: false));
    }

    public function delete($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('user.index', absolute: false));
    }
}
