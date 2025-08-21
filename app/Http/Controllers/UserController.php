<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::with('roles')->get(); // eager load roles
        return view("userIndex", ['users' => $users]);
    }

    // Show create form
    public function create()
    {
        $roles = Role::all();
        return view('userCreate', compact('roles'));
    }

    // Store new user
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['required', 'exists:roles,name'], // validate selected role
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role to user
        // $user->assignRole($request->roles); // Add new one do not replpaces old roles with the new ones
        $user->syncRoles($request->roles); // Replaces old roles with the new ones

        event(new Registered($user));

        // Optional: log in new user
        // Auth::login($user);

        return redirect(route('user.index'));
    }

    // Show single user
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('userShow', ['user' => $user]);
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('editUser', compact('user', 'roles'));
    }

    // Update user
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => ['required', 'exists:roles,name'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Sync the new role
        $user->syncRoles([$request->roles]);

        return redirect(route('user.index'));
    }

    // Delete user
    public function delete($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('user.index'));
    }
}
