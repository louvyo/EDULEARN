# 🌍 Panduan Timezone Dinamis - EduLearn

Sistem timezone dinamis telah diimplementasikan untuk secara otomatis menampilkan waktu sesuai dengan timezone lokal user (browser).

## 📋 Fitur

- ✅ Deteksi timezone otomatis berdasarkan browser user
- ✅ Konversi UTC ke timezone lokal secara real-time
- ✅ Countdown timer yang akurat
- ✅ Format tanggal dan waktu dalam bahasa Indonesia
- ✅ Support untuk semua timezone di dunia

## 🔧 Implementasi

### 1. File JavaScript Utility

File: `public/js/timezone-utils.js`

Utility ini menyediakan fungsi-fungsi untuk:
- Deteksi timezone user
- Konversi UTC ke waktu lokal
- Format tanggal dan waktu
- Countdown timer dinamis

### 2. Blade Directives

Directives telah ditambahkan ke `AppServiceProvider.php` untuk memudahkan penggunaan di view:

#### `@utcTime($datetime)`
Menampilkan tanggal dan waktu lengkap (format: "11 Nov 2025 14:30")
```blade
<p>@utcTime($tugas->deadline)</p>
```

#### `@utcDate($datetime)`
Menampilkan tanggal saja (format: "11 Nov 2025")
```blade
<p>Deadline: @utcDate($tugas->deadline)</p>
```

#### `@utcTimeOnly($datetime)`
Menampilkan waktu saja (format: "14:30")
```blade
<p>Jam: @utcTimeOnly($tugas->deadline)</p>
```

#### `@relativeTime($datetime)`
Menampilkan waktu relatif (format: "2 hari lagi", "3 jam lalu")
```blade
<p>Dikumpulkan @relativeTime($submission->submitted_at)</p>
```

### 3. Countdown Timer

Untuk countdown timer yang update real-time, gunakan class `.countdown` dan attribute `data-deadline`:

```blade
<span class="countdown" data-deadline="{{ $tugas->deadline->toIso8601String() }}">
    Menghitung...
</span>
```

Timer akan otomatis update setiap detik dan menampilkan:
- Format: "2h 14j 30m" (hari, jam, menit)
- Warna otomatis berubah berdasarkan urgency (merah jika deadline dekat)
- Menampilkan "Deadline terlewat" jika sudah lewat

## 📝 Contoh Penggunaan

### Di Blade Template

```blade
{{-- Tanggal lengkap dengan waktu --}}
<div>
    <strong>Deadline:</strong> @utcTime($tugas->deadline)
</div>

{{-- Tanggal saja --}}
<div>
    <strong>Tanggal:</strong> @utcDate($tugas->created_at)
</div>

{{-- Waktu saja --}}
<div>
    <strong>Jam:</strong> @utcTimeOnly($tugas->deadline)
</div>

{{-- Waktu relatif --}}
<div>
    Dikumpulkan @relativeTime($submission->submitted_at)
</div>

{{-- Countdown timer --}}
<div>
    <span class="countdown" data-deadline="{{ $tugas->deadline->toIso8601String() }}">
        Menghitung...
    </span>
</div>
```

### Menggunakan JavaScript Utility Langsung

```javascript
// Get user's timezone
const timezone = TimezoneUtils.getUserTimezone();
console.log('User timezone:', timezone); // e.g., "Asia/Jakarta"

// Convert UTC to local time
const localDate = TimezoneUtils.convertToLocalTime('2025-11-11T07:00:00Z');

// Format date
const formatted = TimezoneUtils.formatDate('2025-11-11T07:00:00Z');
console.log(formatted); // "11 Nov 2025 14:00" (jika user di WIB)

// Get countdown
const countdown = TimezoneUtils.getCountdown('2025-11-15T10:00:00Z');
console.log(countdown.text); // "4h 2j 30m"
console.log(countdown.isUrgent); // false
console.log(countdown.isPast); // false
```

## 🎯 Cara Kerja

1. **Server mengirim waktu dalam UTC** (default Laravel timezone)
2. **JavaScript mendeteksi timezone browser** menggunakan `Intl.DateTimeFormat().resolvedOptions().timeZone`
3. **Waktu dikonversi otomatis** ke timezone lokal user
4. **Display diupdate real-time** untuk countdown timer

## 🔄 Update Existing Code

Untuk mengupdate kode yang sudah ada:

### Sebelum (hardcoded format):
```blade
<p>{{ $tugas->deadline->format('d M Y') }}</p>
<p>{{ $tugas->deadline->format('H:i') }}</p>
```

### Sesudah (dengan timezone dinamis):
```blade
<p>@utcDate($tugas->deadline)</p>
<p>@utcTimeOnly($tugas->deadline)</p>
```

## 🌐 Timezone Support

Sistem ini support semua timezone di dunia, termasuk:
- **WIB** (Asia/Jakarta) - UTC+7
- **WITA** (Asia/Makassar) - UTC+8
- **WIT** (Asia/Jayapura) - UTC+9
- **GMT/UTC** (Europe/London) - UTC+0
- **EST** (America/New_York) - UTC-5
- Dan 400+ timezone lainnya

## ⚠️ Catatan Penting

1. **Server tetap menggunakan UTC** untuk consistency di database
2. **Konversi hanya di frontend** untuk display ke user
3. **Browser support**: Modern browsers (Chrome, Firefox, Safari, Edge)
4. **Fallback**: Jika JavaScript disabled, akan tampil waktu UTC default

## 🐛 Troubleshooting

### Waktu tidak berubah sesuai timezone
- Clear browser cache
- Pastikan JavaScript enabled
- Check console untuk error

### Countdown tidak update
- Pastikan elemen memiliki class `.countdown`
- Pastikan attribute `data-deadline` berisi ISO 8601 string
- Check console untuk error

### Format tanggal tidak sesuai
- Pastikan menggunakan Blade directive yang benar
- Pastikan $datetime adalah Carbon instance atau null

## 📚 References

- [Intl.DateTimeFormat - MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/DateTimeFormat)
- [IANA Time Zone Database](https://www.iana.org/time-zones)
- [ISO 8601 DateTime Format](https://en.wikipedia.org/wiki/ISO_8601)
