<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password'   => 'required|string',
        ]);

        $user = User::where('identifier', $request->identifier)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['identifier' => 'NIK atau password salah.'])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));

        return $this->redirectByRole($user->role);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik'      => 'required|digits:16|unique:users,identifier',
            'nama'     => 'required|string|max:100',
            'telepon'  => 'nullable|string|max:15',
            'alamat'   => 'nullable|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan ke tabel masyarakat
        Masyarakat::create([
            'nik'     => $request->nik,
            'nama'    => $request->nama,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
        ]);

        // Buat akun user
        $user = User::create([
            'identifier' => $request->nik,
            'name'       => $request->nama,
            'password'   => Hash::make($request->password),
            'role'       => 'masyarakat',
        ]);

        Auth::login($user);

        return redirect('/masyarakat/dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'      => redirect('/admin/dashboard'),
            'petugas'    => redirect('/petugas/dashboard'),
            'masyarakat' => redirect('/masyarakat/dashboard'),
            default      => redirect('/login'),
        };
    }
}
