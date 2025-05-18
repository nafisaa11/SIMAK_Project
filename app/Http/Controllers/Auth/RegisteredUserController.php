<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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
    
        // Penetapan role otomatis berdasarkan email
        if (str_ends_with($user->email, '@lecturer.ac.id')) {
            $user->assignRole('dosen');
        } elseif (str_ends_with($user->email, '@student.ac.id')) {
            $user->assignRole('mahasiswa');
        } elseif (str_ends_with($user->email, '@admin.ac.id')) {
            $user->assignRole('admin');
        }
    
        event(new Registered($user));
    
        Auth::login($user);
    
        // Redirect berdasarkan role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('dosen')) {
            return redirect()->route('dosen.create');
        } elseif ($user->hasRole('mahasiswa')) {
            return redirect()->route('mahasiswa.create');
        } else {
            return redirect()->route('dashboard'); // fallback
        }
    }
    
}
