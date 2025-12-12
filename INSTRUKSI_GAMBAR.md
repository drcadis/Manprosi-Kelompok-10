# Petunjuk Mengganti Gambar dan Asset

## Lokasi Gambar yang Perlu Diganti

### 1. Hero Section Background
**File:** `resources/views/welcome.blade.php`
**Baris:** ~8

**URL Saat Ini:**
```html
background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1920&q=80')
```

**Cara Mengganti:**
1. Simpan gambar hero Anda di folder `public/images/hero-bg.jpg`
2. Ganti URL dengan: `{{ asset('images/hero-bg.jpg') }}` atau `/images/hero-bg.jpg`

**Rekomendasi:**
- Ukuran: 1920x650px atau lebih besar
- Format: JPG/PNG
- Konten: Gambar tangan yang sedang menyerahkan/menerima barang (dompet, dll)
- Gaya: Slight blur effect (bisa diatur dengan CSS backdrop-filter)

---

### 2. Item Cards (KTM/Student ID Cards)
**File:** `resources/views/welcome.blade.php`
**Lokasi:** Section "Cari Barangmu Disini" dan "Apakah Kamu Menemukan Barang - Barang ini?"
**Baris:** ~165, ~190, ~215, ~245, ~270, ~295

**URL Saat Ini:**
```html
<img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&q=80" alt="Student ID" class="w-100 h-100" style="object-fit: cover;">
```

**Cara Mengganti:**
1. Simpan gambar KTM/Student ID Anda di folder `public/images/ktm/`
2. Ganti semua URL dengan: `{{ asset('images/ktm/ktm-1.jpg') }}`, `ktm-2.jpg`, `ktm-3.jpg`, dll.

**Rekomendasi:**
- Ukuran: 600x400px atau lebih besar (rasio 3:2)
- Format: JPG/PNG
- Konten: Foto close-up KTM/Student ID card yang dipegang tangan
- Contoh nama file: `ktm-nafi-azzahra.jpg`

**Contoh struktur folder:**
```
public/
  images/
    ktm/
      ktm-1.jpg
      ktm-2.jpg
      ktm-3.jpg
```

---

### 3. Testimonials Background
**File:** `resources/views/welcome.blade.php`
**Baris:** ~240

**URL Saat Ini:**
```html
background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1920&q=80')
```

**Cara Mengganti:**
1. Simpan gambar background testimonials di folder `public/images/testimonial-bg.jpg`
2. Ganti URL dengan: `{{ asset('images/testimonial-bg.jpg') }}`

**Rekomendasi:**
- Ukuran: 1920x600px atau lebih besar
- Format: JPG/PNG
- Konten: Gambar orang yang sedang berjalan bersama di taman/park
- Gaya: Akan di-blur dengan CSS, jadi gambar original bisa cukup jelas

---

### 4. Profile Picture Testimonials
**File:** `resources/views/welcome.blade.php`
**Baris:** ~260, ~275, ~290

**URL Saat Ini (menggunakan API):**
```html
background-image: url('https://ui-avatars.com/api/?name=Nouvail&background=DC3545&color=fff&size=128')
```

**Cara Mengganti:**
1. Simpan foto profil di folder `public/images/profiles/`
2. Ganti dengan: `{{ asset('images/profiles/nouvail.jpg') }}`

**Rekomendasi:**
- Ukuran: 128x128px (square)
- Format: JPG/PNG
- Gaya: Circular crop (dibuat bulat dengan CSS)

**Contoh:**
```html
<div class="rounded-circle bg-secondary me-3" style="width: 50px; height: 50px; background-image: url('{{ asset('images/profiles/nouvail.jpg') }}'); background-size: cover; background-position: center;"></div>
```

---

## Lokasi Folder untuk Menyimpan Gambar

Buat struktur folder berikut di `public/`:

```
public/
  images/
    hero-bg.jpg
    testimonial-bg.jpg
    ktm/
      ktm-1.jpg
      ktm-2.jpg
      ktm-3.jpg
    profiles/
      nouvail.jpg
      profile-2.jpg
      profile-3.jpg
```

---

## Sumber Gambar Gratis yang Direkomendasikan

1. **Unsplash** (https://unsplash.com)
   - Pencarian: "hand giving wallet", "lost and found", "student ID card"
   - Free, no attribution required

2. **Pexels** (https://www.pexels.com)
   - Pencarian: "handshake", "lost items", "people walking"
   - Free, no attribution required

3. **Pixabay** (https://pixabay.com)
   - Berbagai gambar gratis
   - Free, no attribution required

4. **Untuk KTM/Student ID:**
   - Gunakan foto KTM sendiri (dengan izin)
   - Atau buat mockup KTM menggunakan Canva/Figma
   - Pastikan tidak ada data pribadi sensitif

---

## Tips Optimasi Gambar

1. **Kompresi:**
   - Gunakan TinyPNG (https://tinypng.com) atau Squoosh (https://squoosh.app)
   - Target ukuran file: < 500KB per gambar

2. **Format:**
   - JPG untuk foto/gambar kompleks
   - PNG untuk gambar dengan transparansi
   - WebP untuk optimasi maksimal (opsional)

3. **Ukuran:**
   - Hero background: 1920px width
   - Item cards: 600px width
   - Profile pics: 128x128px

---

## Contoh Kode Lengkap Setelah Mengganti

### Hero Section:
```html
<section id="home" class="hero-section position-relative" style="min-height: 650px; background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
```

### Item Card:
```html
<img src="{{ asset('images/ktm/ktm-1.jpg') }}" alt="Student ID" class="w-100 h-100" style="object-fit: cover;">
```

### Testimonial Background:
```html
background-image: url('{{ asset('images/testimonial-bg.jpg') }}')
```

### Profile Picture:
```html
<div class="rounded-circle bg-secondary me-3" style="width: 50px; height: 50px; background-image: url('{{ asset('images/profiles/nouvail.jpg') }}'); background-size: cover; background-position: center;"></div>
```

---

## Catatan Penting

1. **Laravel Asset Helper:**
   - Gunakan `{{ asset('path/to/image.jpg') }}` untuk path yang benar
   - Akan otomatis menyesuaikan dengan base URL aplikasi

2. **Jika Tidak Menggunakan Laravel:**
   - Ganti `{{ asset('...') }}` dengan path relatif: `/images/...`
   - Atau path absolut jika diperlukan

3. **Testing:**
   - Pastikan semua gambar muncul setelah diganti
   - Cek di browser DevTools jika ada gambar yang tidak muncul
   - Periksa console untuk error 404

4. **Backup:**
   - Simpan backup URL gambar lama sebelum mengganti
   - Atau simpan gambar di tempat aman

