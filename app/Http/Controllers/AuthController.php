<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
 

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Redirect berdasarkan role
            if ($user->role === 'guru') {
                return redirect()->intended('/dashboard')
                    ->with('success', 'Selamat datang, Guru ' . $user->name . '! 👨‍🏫');
            } else {
                return redirect()->intended('/dashboard')
                    ->with('success', 'Selamat datang, ' . $user->name . '! 👨‍🎓');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Anda berhasil logout.');
    }

    /**
     * Tampilkan halaman register (opsional)
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses register (opsional)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:guru,siswa',
            'teacher_code' => 'nullable|required_if:role,guru',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
            'teacher_code.required_if' => 'Kode undangan guru wajib diisi untuk pendaftaran Guru',
        ]);

        if ($request->role === 'guru') {
            $validCode = env('TEACHER_INVITE_CODE');
            if (!$validCode || $request->teacher_code !== $validCode) {
                return back()->withErrors(['teacher_code' => 'Kode undangan guru tidak valid'])->withInput();
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect with success message before login
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda. 🎉');
    }

    // Google OAuth removed
}
