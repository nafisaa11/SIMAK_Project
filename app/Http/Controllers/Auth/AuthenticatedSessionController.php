<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Jika admin, langsung ke home
        if ($user->hasRole('admin')) {
            return redirect()->route('home');
        }

        // Jika dosen, cek apakah data dosen sudah ada
        if ($user->hasRole('dosen')) {
            $dosen = Dosen::where('user_id', $user->id)->first();
            if (!$dosen) {
                return redirect()->route('dosen.create');
            }
        }

        // Jika mahasiswa, cek apakah data mahasiswa sudah ada
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if (!$mahasiswa) {
                return redirect()->route('mahasiswa.create');
            }
        }

        // Semua role diarahkan ke home jika data sudah lengkap
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
