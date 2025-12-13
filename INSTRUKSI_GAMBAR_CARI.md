# Petunjuk Mengganti Gambar dan Asset - Halaman Cari Barang

## Lokasi File
- **View:** `resources/views/cari.blade.php`
- **CSS:** `public/css/cari.css`

## Lokasi Gambar yang Perlu Diganti

### 1. Hero Section Background Image
**File:** `resources/views/cari.blade.php`
**Baris:** ~25

**URL Saat Ini:**
```html
<img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1920&q=80" alt="Students exchanging item" class="hero-image">
```

**Cara Mengganti:**
1. Simpan gambar hero Anda di folder `public/images/cari/hero-students.jpg`
2. Ganti URL dengan: `{{ asset('images/cari/hero-students.jpg') }}` atau `/images/cari/hero-students.jpg`

**Rekomendasi:**
- Ukuran: 1920x500px atau lebih besar
- Format: JPG/PNG
- Konten: Dua orang (mahasiswa) yang sedang bertukar/menyerahkan barang di lingkungan kampus
- Gaya: Natural, warm lighting, menunjukkan interaksi positif
- Rasio: Landscape (16:9 atau lebih lebar)

**Contoh:**
```html
<img src="{{ asset('images/cari/hero-students.jpg') }}" alt="Students exchanging item" class="hero-image">
```

---

### 2. Form Section Background Image (Aerial View)
**File:** `resources/views/cari.blade.php`
**Baris:** ~85

**URL Saat Ini:**
```html
<img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1920&q=80" alt="Aerial view" class="form-bg-image">
```

**Cara Mengganti:**
1. Simpan gambar aerial view Anda di folder `public/images/cari/aerial-view.jpg`
2. Ganti URL dengan: `{{ asset('images/cari/aerial-view.jpg') }}`

**Rekomendasi:**
- Ukuran: 1920x600px atau lebih besar
- Format: JPG/PNG
- Konten: Aerial view/pemandangan dari atas menunjukkan:
  - Kampus Telkom University
  - Gedung-gedung kampus
  - Area hijau/taman
  - Water tower dengan logo "U" (jika tersedia)
- Gaya: Bright, clear, menunjukkan struktur kampus
- Rasio: Landscape (16:9)

**Contoh:**
```html
<img src="{{ asset('images/cari/aerial-view.jpg') }}" alt="Aerial view" class="form-bg-image">
```

---

## Lokasi Folder untuk Menyimpan Gambar

Buat struktur folder berikut di `public/`:

```
public/
  images/
    cari/
      hero-students.jpg
      aerial-view.jpg
```

---

## Sumber Gambar Gratis yang Direkomendasikan

1. **Unsplash** (https://unsplash.com)
   - Pencarian hero: "students exchanging", "university students helping", "campus interaction"
   - Pencarian aerial: "university aerial view", "campus from above", "university buildings"
   - Free, no attribution required

2. **Pexels** (https://www.pexels.com)
   - Pencarian: "students", "university campus", "aerial campus"
   - Free, no attribution required

3. **Pixabay** (https://pixabay.com)
   - Berbagai gambar gratis
   - Free, no attribution required

4. **Untuk Gambar Kampus Telkom University:**
   - Gunakan foto resmi kampus jika tersedia
   - Atau foto sendiri dengan izin
   - Pastikan kualitas gambar cukup baik

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
   - Hero image: 1920px width
   - Aerial view: 1920px width
   - Pastikan gambar tidak terlalu besar untuk performa

---

## Contoh Kode Lengkap Setelah Mengganti

### Hero Section:
```html
<div class="hero-image-container">
  <img src="{{ asset('images/cari/hero-students.jpg') }}" alt="Students exchanging item" class="hero-image">
</div>
```

### Form Background:
```html
<div class="form-background">
  <img src="{{ asset('images/cari/aerial-view.jpg') }}" alt="Aerial view" class="form-bg-image">
</div>
```

---

## Catatan Penting

1. **Laravel Asset Helper:**
   - Gunakan `{{ asset('path/to/image.jpg') }}` untuk path yang benar
   - Akan otomatis menyesuaikan dengan base URL aplikasi

2. **Jika Tidak Menggunakan Laravel:**
   - Ganti `{{ asset('...') }}` dengan path relatif: `/images/cari/...`
   - Atau path absolut jika diperlukan

3. **Testing:**
   - Pastikan semua gambar muncul setelah diganti
   - Cek di browser DevTools jika ada gambar yang tidak muncul
   - Periksa console untuk error 404

4. **Backup:**
   - Simpan backup URL gambar lama sebelum mengganti
   - Atau simpan gambar di tempat aman

5. **Performance:**
   - Optimalkan gambar sebelum upload
   - Gunakan lazy loading jika diperlukan
   - Pertimbangkan menggunakan CDN untuk gambar besar

---

## Customization Tambahan

### Mengubah Warna Primary
Edit file `public/css/cari.css` pada bagian `:root`:
```css
:root {
  --primary-red: #DC3545;  /* Ganti dengan warna merah Anda */
  --primary-pink: #FF6B9D;  /* Ganti dengan warna pink Anda */
}
```

### Mengubah Font
Tambahkan di bagian atas `cari.css`:
```css
@import url('https://fonts.googleapis.com/css2?family=YourFont&display=swap');

body {
  font-family: 'YourFont', sans-serif;
}
```

---

## Troubleshooting

### Gambar tidak muncul:
1. Cek path file benar
2. Pastikan file ada di folder yang benar
3. Cek permission folder/file
4. Clear cache browser

### Gambar terlalu besar/kecil:
1. Edit CSS di `cari.css`
2. Ubah `object-fit` atau `object-position`
3. Atau resize gambar ke ukuran yang tepat

### Background text tidak terlihat:
1. Cek opacity di CSS
2. Pastikan z-index benar
3. Cek warna text sesuai background



