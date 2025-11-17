<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

    /**
     * Redirect to Google OAuth
     */
    public function googleRedirect()
    {
        if (!config('services.google.client_id') || !config('services.google.client_secret')) {
            return redirect()->route('login')->with('error', 'Google OAuth belum dikonfigurasi. Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di .env');
        }
        config(['services.google.redirect' => route('oauth.google.callback')]);
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function googleCallback()
    {
        if (!config('services.google.client_id') || !config('services.google.client_secret')) {
            return redirect()->route('login')->with('error', 'Google OAuth belum dikonfigurasi. Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di .env');
        }
        try {
            config(['services.google.redirect' => route('oauth.google.callback')]);
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Coba lagi.');
        }

        $email = $googleUser->getEmail();
        $name = $googleUser->getName() ?: $googleUser->getNickname() ?: 'User';
        $providerId = $googleUser->getId();
        $avatar = $googleUser->getAvatar();

        // Cari user by provider_id atau email
        $user = User::where(function ($q) use ($providerId) {
                $q->where('provider', 'google')->where('provider_id', $providerId);
            })
            ->orWhere('email', $email)
            ->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                'role' => 'siswa',
                'provider' => 'google',
                'provider_id' => $providerId,
                'avatar_path' => $avatar,
                'email_verified_at' => now(),
            ]);
        } else {
            // Update provider linkage if missing
            $user->provider = $user->provider ?: 'google';
            $user->provider_id = $user->provider_id ?: $providerId;
            if ($avatar && empty($user->avatar_path)) {
                $user->avatar_path = $avatar;
            }
            if (empty($user->email_verified_at)) {
                $user->email_verified_at = now();
            }
            $user->save();
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard')->with('success', 'Berhasil login dengan Google. Selamat datang, ' . $user->name . '!');
    }
}
