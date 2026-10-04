<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function show()
    {
        if (User::count() > 0) {
            return redirect()->route('login')->with('info', 'CRM is already initialized. Please log in.');
        }

        return view('auth.setup');
    }

    public function store(Request $request)
    {
        if (User::count() > 0) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:190'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            $role = Role::where('slug', 'owner')->first();
            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }

            return $user;
        });

        return redirect()->route('login')->with('success', 'Owner account created. You can now sign in.');
    }
}
