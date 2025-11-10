# Sistem Login EDULEARN

## Fitur Login

Sistem ini menyediakan fitur login untuk **Guru** dan **Siswa** dengan kemampuan:
- Login dengan email dan password
- Remember me (ingat saya)
- Redirect otomatis ke dashboard setelah login
- Logout
- Proteksi halaman dengan middleware authentication

## Akun Demo

### 👨‍🏫 Guru
- **Email**: guru@edulearn.com
- **Password**: password
- **Role**: guru

### 👨‍🎓 Siswa
- **Email**: murid@edulearn.com
- **Password**: password
- **Role**: siswa

### 🧪 Test User
- **Email**: test@example.com
- **Password**: password
- **Role**: siswa

## File-file Yang Dibuat/Dimodifikasi

### 1. Controller
- **`app/Http/Controllers/AuthController.php`**
  - `showLoginForm()` - Menampilkan halaman login
  - `login()` - Proses login user
  - `logout()` - Proses logout user
  - `showRegisterForm()` - Menampilkan halaman register (opsional)
  - `register()` - Proses registrasi user baru (opsional)

### 2. Routes
- **`routes/web.php`**
  - `GET /login` - Halaman login
  - `POST /login` - Proses login
  - `POST /logout` - Logout user
  - Semua route protected dengan middleware `auth`

### 3. Views
- **`resources/views/auth/login.blade.php`**
  - Halaman login dengan form email & password
  - Checkbox "Remember Me"
  - Menampilkan akun demo untuk testing
  - Responsive design dengan Tailwind CSS

### 4. Layout Updates
- **`resources/views/components/navbar.blade.php`**
  - Dropdown profil user dengan informasi nama, email, dan role
  - Tombol logout di dropdown (desktop)
  - Tombol logout di mobile menu
  - Menampilkan role user (Guru/Siswa)

### 5. Database
- **Migration**: `database/migrations/2025_11_10_120001_add_role_to_users_table.php`
  - Menambahkan kolom `role` ke tabel `users`
  - Enum: 'siswa' atau 'guru'
  - Default: 'siswa'

- **Seeder**: `database/seeders/UserSeeder.php`
  - Update untuk menambahkan role pada user yang ada

### 6. Model
- **`app/Models/User.php`**
  - Sudah support untuk authentication (extends Authenticatable)
  - Kolom `role` sudah ada di fillable

## Cara Menggunakan

### 1. Jalankan Migration (Jika Belum)
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=UserSeeder
```

### 3. Akses Halaman Login
Buka browser dan akses:
```
http://localhost/WEB/login
```

### 4. Login dengan Akun Demo
Gunakan salah satu akun demo di atas untuk login.

### 5. Navigasi
Setelah login, Anda akan diarahkan ke dashboard. Anda bisa:
- Mengakses semua menu (Dashboard, Kelas, Tugas, Nilai, Notifikasi)
- Klik profil di kanan atas untuk melihat menu logout
- Klik Logout untuk keluar

## Protected Routes

Semua route kecuali login sudah diproteksi dengan middleware `auth`. Jika user belum login dan mencoba mengakses halaman yang dilindungi, mereka akan diarahkan ke halaman login.

Contoh protected routes:
- `/dashboard`
- `/kelas`
- `/tugas`
- `/nilai`
- `/notifications`

## Kustomisasi

### Menambahkan Role Baru
Edit migration `2025_11_10_120001_add_role_to_users_table.php`:
```php
$table->enum('role', ['siswa', 'guru', 'admin'])->default('siswa');
```

### Redirect Berdasarkan Role
Edit `AuthController.php` di method `login()`:
```php
if ($user->role === 'guru') {
    return redirect()->intended('/dashboard-guru');
} else if ($user->role === 'admin') {
    return redirect()->intended('/admin');
} else {
    return redirect()->intended('/dashboard');
}
```

### Menambahkan Middleware Role
Buat middleware baru:
```bash
php artisan make:middleware CheckRole
```

Kemudian gunakan di routes:
```php
Route::middleware(['auth', 'role:guru'])->group(function () {
    // Routes khusus guru
});
```

## Testing

### Test Login
1. Akses `/login`
2. Masukkan email dan password
3. Klik tombol Login
4. Jika berhasil, akan redirect ke dashboard dengan pesan sukses

### Test Logout
1. Klik icon profil di kanan atas
2. Klik tombol Logout
3. Akan redirect ke halaman login dengan pesan sukses

### Test Protected Routes
1. Logout terlebih dahulu
2. Coba akses `/dashboard` atau route lainnya
3. Akan diarahkan ke halaman login

## Security Features

✅ Password di-hash dengan bcrypt
✅ CSRF Protection pada semua form
✅ Session regeneration setelah login
✅ Remember token untuk "Remember Me"
✅ Protected routes dengan middleware auth
✅ Logout menginvalidasi session

## Troubleshooting

### Error: "Too many arguments to function only()"
Ini sudah diperbaiki. `only()` sekarang menerima 1 parameter (array).

### Migration Error
Jika ada error saat migration, coba:
```bash
php artisan migrate:fresh --seed
```
**WARNING**: Ini akan menghapus semua data!

### Session Not Working
Pastikan file `.env` sudah dikonfigurasi dengan benar:
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## Next Steps (Opsional)

- [ ] Implementasi registrasi user
- [ ] Forgot password
- [ ] Email verification
- [ ] Two-factor authentication
- [ ] Role-based permissions
- [ ] Activity log

---

**Dibuat pada**: 10 November 2025
**Laravel Version**: 11.x
**PHP Version**: 8.x
