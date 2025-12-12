<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cari Barang - TelU Lost & Found</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS untuk halaman Cari -->
  <link href="{{ asset('css/cari.css') }}" rel="stylesheet">

</head>
<body>

  @include('partials.navbar')

  <!-- Hero Section dengan Gambar -->
  <section class="hero-cari-section">
    <div class="hero-image-container">
      <img src="/assets/images/tumnailCari.png" alt="Students exchanging item" class="hero-image">
    </div>
    <div class="hero-content-below">
      <div class="container">
        <h1 class="hero-title">Wellcome to TelU Lost & Found</h1>
        <p class="hero-subtitle">Layanan Pengaduan Kehilangan dan Penemuan Barang</p>
      </div>
    </div>
  </section>

  <!-- Instructions Section -->
  <section class="instructions-section py-5 bg-white">
    <div class="container">
      <div class="row g-4">
        <!-- Lost Item Card -->
        <div class="col-md-6">
          <div class="instruction-card">
            <div class="instruction-icon-wrapper">
              <div class="instruction-icon-box">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#DC3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <h3 class="instruction-title">Anda Kehilangan Barang?</h3>
            <p class="instruction-intro">Jika kamu kehilangan barang hilang di lingkungan Telkom University, lakukan langkah-langkah berikut:</p>
            <ol class="instruction-list">
              <li>Ingat kapan terakhir kali kamu bersama dengan barang tersebut</li>
              <li>Laporkan dengan mengisi formulir berikut</li>
              <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat, serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih lanjut.</li>
              <li>Tunggu informasi lanjutan apabila barang ditemukan.</li>
            </ol>
          </div>
        </div>

        <!-- Found Item Card -->
        <div class="col-md-6">
          <div class="instruction-card">
            <div class="instruction-icon-wrapper">
              <div class="instruction-icon-box">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#DC3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <h3 class="instruction-title">Anda Menemukan Barang?</h3>
            <p class="instruction-intro">Jika kamu menemukan barang hilang di lingkungan Telkom University, lakukan langkah-langkah berikut:</p>
            <ol class="instruction-list">
              <li>Amankan barang tersebut</li>
              <li>Laporkan dengan mengisi formulir berikut</li>
              <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat, serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih lanjut.</li>
              <li>Setelah di laporkan melalui link tersebut, mohon kesedian nya untuk menyerahkan barang kepada Satpam Telkom University.</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Form Section -->
  <section class="form-section position-relative">
    <!-- Background Image -->
    <div class="form-background">
      <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1920&q=80" alt="Aerial view" class="form-bg-image">
    </div>

    <!-- Background Text -->
    <div class="form-background-text">
      <span>FORM LAPORAN</span>
    </div>

    <!-- Form Card -->
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
          @include('partials.form-laporan-wizard')
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer')

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


