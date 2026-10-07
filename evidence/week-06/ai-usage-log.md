# AI Usage Log - Pertemuan 6

## 1. Perhitungan Diskon

Masalah:
Perlu membuat aturan diskon yang berbeda berdasarkan jenis pengguna.

Bantuan AI:
AI menyarankan penggunaan fungsi `getDiscountPercent()` untuk menentukan persentase diskon.

Keputusan:
Saran diterapkan pada program.

Hasil Uji:
- Mahasiswa mendapatkan diskon 20%.
- Guru mendapatkan diskon 15%.
- Pengguna umum mendapatkan diskon 0%.

---

## 2. Pilihan Minat pada Form

Masalah:
Pengguna dapat tidak memilih checkbox minat sehingga berpotensi menimbulkan warning.

Bantuan AI:
AI menyarankan penggunaan `$_POST['interests'] ?? []` dan pengecekan agar data yang diterima berupa array.

Keputusan:
Saran diterapkan pada form pendaftaran.

Hasil Uji:
Form tetap berjalan meskipun pengguna tidak memilih minat dan tidak muncul warning.

---

## 3. Menampilkan Data dengan Looping

Masalah:
Data kursus, minat, dan fasilitas tidak ingin ditulis berulang menggunakan HTML yang sama.

Bantuan AI:
AI menyarankan penggunaan array dan `foreach` untuk menampilkan data secara otomatis.

Keputusan:
Saran diterapkan pada program.

Hasil Uji:
Data berhasil ditampilkan menggunakan perulangan. Penambahan data cukup dilakukan pada array tanpa perlu menyalin markup HTML.