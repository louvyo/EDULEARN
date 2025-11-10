# 🧪 Data Testing EduLearn

Data dummy telah berhasil dibuat untuk testing aplikasi.

## 👤 Akun User

### Siswa/Murid
- **Email**: `murid@edulearn.com`
- **Password**: `password`
- **Nama**: Murid

### Guru
- **Email**: `guru@edulearn.com`
- **Password**: `password`
- **Nama**: Guru

### Test User (Legacy)
- **Email**: `test@example.com`
- **Password**: `password`
- **Nama**: Test User

## 📚 Kelas (3 Kelas)

### 1. Matematika Dasar
- **Guru**: Pak Budi Santoso, S.Pd
- **Warna**: Blue
- **Semester**: Semester Ganjil 2024/2025
- **Progress**: 75%
- **Total Pertemuan**: 12
- **Total Tugas**: 8

### 2. Bahasa Inggris
- **Guru**: Mrs. Sarah Johnson
- **Warna**: Green
- **Semester**: Semester Ganjil 2024/2025
- **Progress**: 45%
- **Total Pertemuan**: 10
- **Total Tugas**: 10

### 3. Fisika
- **Guru**: Pak Andi Wijaya, M.Pd
- **Warna**: Purple
- **Semester**: Semester Ganjil 2024/2025
- **Progress**: 60%
- **Total Pertemuan**: 14
- **Total Tugas**: 6

## 📝 Tugas (8 Tugas)

### Matematika Dasar (3 tugas)
1. **Latihan Aljabar Dasar** - Prioritas: Tinggi - Deadline: 3 hari
2. **Quiz Aritmetika** - Prioritas: Sedang - Deadline: 5 hari
3. **Project Geometri** - Prioritas: Sedang - Deadline: 14 hari

### Bahasa Inggris (3 tugas)
1. **Essay Writing Task** - Prioritas: Tinggi - Deadline: 7 hari
2. **Grammar Exercise** - Prioritas: Sedang - Deadline: 4 hari
3. **Reading Comprehension** - Prioritas: Tinggi - Deadline: 2 hari

### Fisika (2 tugas)
1. **Praktikum Gerak Lurus** - Prioritas: Tinggi - Deadline: 10 hari
2. **Soal Hukum Newton** - Prioritas: Sedang - Deadline: 6 hari

## 📊 Submission (2 Pengumpulan)

### Submission 1 - Sudah Dinilai
- **Tugas**: Latihan Aljabar Dasar
- **User**: Murid
- **Status**: On Time
- **Nilai**: 85
- **Feedback**: "Pekerjaan bagus! Perhitungan sudah benar. Tingkatkan ketelitian."
- **Submitted**: 2 hari yang lalu

### Submission 2 - Belum Dinilai
- **Tugas**: Quiz Aritmetika
- **User**: Murid
- **Status**: On Time
- **Content**: "Essay tentang cita-cita saya terlampir."
- **Submitted**: 5 jam yang lalu

## 🔄 Cara Refresh Data

Jika ingin reset dan mengisi ulang data:

```bash
# Rollback dan migrate ulang
php artisan migrate:fresh

# Jalankan seeder
php artisan db:seed
```

Atau dalam satu command:
```bash
php artisan migrate:fresh --seed
```

## ✅ Testing Checklist

- [ ] Login sebagai murid@edulearn.com
- [ ] Cek Dashboard - tampil 3 kelas
- [ ] Cek statistik di dashboard
- [ ] Klik detail kelas
- [ ] Cek halaman Tugas - tampil 8 tugas
- [ ] Cek halaman Nilai - tampil 2 submission
- [ ] Test filter tugas per kelas
- [ ] Test animasi hover di semua card
- [ ] Test responsive di mobile
- [ ] Test toggle sidebar

## 📌 Notes

- Semua password default: `password`
- Data kelas dan tugas sudah ter-attach ke user `murid@edulearn.com`
- Progres kelas dihitung otomatis atau manual via seeder
- Warna kelas: blue, green, purple (sesuai desain)
