<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Barang - TelU Lost & Found</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/detail.css') }}" rel="stylesheet">

</head>
<body>

  @include('partials.navbar')

  <!-- Breadcrumb Section -->
  <section class="breadcrumb-section py-3 bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Barang</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- Main Product Detail Section -->
  <section class="product-detail-section py-5 bg-white">
    <div class="container">
      <div class="row g-5">
        <!-- Product Image -->
        <div class="col-lg-6">
          <div class="product-image-wrapper">
            <img 
              src="{{ asset('storage/' . $item->foto_barang) }}" 
              alt="{{ $item->nama_barang }}" 
              class="product-main-image">
          </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
          <div class="product-details">
            <h1 class="product-title mb-3">
              {{ $item->nama_barang }}
            </h1>
            
            <!-- Status Badge -->
            <div class="mb-3">
              <span class="badge 
                {{ $item->status_barang == 'Telah Ditemukan' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ ucfirst($item->status_barang) }}
              </span>
            </div>

            <!-- Reviews/Reports -->
            <div class="product-reviews mb-3">
              <div class="d-flex align-items-center">
                <i class="bi bi-people text-danger me-2"></i>
                <span class="text-secondary">0 Laporan</span>
              </div>
            </div>

            <!-- Short Description -->
            <div class="product-short-desc mb-4">
              <p class="text-muted">
                {{ $item->deskripsi }}
              </p>
            </div>

            <!-- Detail Information -->
            <div class="product-info-list mb-4">
              <div class="info-item mb-3">
                <strong>Lokasi:</strong>
                <span class="ms-2">{{ $item->lokasi }}</span>
              </div>

              <div class="info-item mb-3">
                <strong>Tanggal:</strong>
                <span class="ms-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
              </div>

              <div class="info-item mb-3">
                <strong>Kategori:</strong>
                <span class="ms-2">{{ $item->kategori?->nama_kategori ?? '-' }}</span>
              </div>

              <div class="info-item mb-3">
                <strong>Status:</strong>
                <span class="ms-2">{{ ucfirst($item->status_barang) }}</span>
              </div>

            </div>

            <!-- Action Buttons -->
            <div class="product-actions">              
              <button class="btn btn-outline-danger btn-lg w-100">
                <a href="https://wa.me/{{ $item->no_telp }}" 
                  class="btn btn-danger btn-lg w-100 mb-3">
                  <i class="bi bi-telephone me-2"></i>Saya Menemukan Barang Ini
                </a>
              </button>
            </div>

            <!-- Share Section -->
            <div class="product-share mt-4 pt-4 border-top">
              <strong class="text-dark me-3">Bagikan:</strong>
              <a href="#" class="text-decoration-none text-muted me-3">
                <i class="bi bi-facebook fs-5"></i>
              </a>
              <a href="#" class="text-decoration-none text-muted me-3">
                <i class="bi bi-linkedin fs-5"></i>
              </a>
              <a href="#" class="text-decoration-none text-muted">
                <i class="bi bi-twitter fs-5"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Product Information Tabs -->
  <section class="product-tabs-section py-4 bg-light">
    <div class="container">
      <ul class="nav nav-tabs border-0" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
            Deskripsi
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="additional-tab" data-bs-toggle="tab" data-bs-target="#additional" type="button" role="tab">
            Informasi Tambahan
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
            Laporan [0]
          </button>
        </li>
      </ul>
    </div>
  </section>

  <!-- Tab Content -->
  <section class="product-tab-content py-5 bg-white">
    <div class="container">
      <div class="tab-content" id="productTabsContent">
        <!-- Description Tab -->
        <div class="tab-pane fade show active" id="description" role="tabpanel">
          <h3 class="mb-4">Informasi Lengkap Barang Hilang</h3>
          <p class="text-muted mb-4">
            {{$item->deskripsi}}
          </p>                 
        </div>

        <!-- Additional Information Tab -->
        <div class="tab-pane fade" id="additional" role="tabpanel">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <th scope="row">Nama</th>
                <td>{{$item->nama}}</td>
              </tr>
              <tr>
                <th scope="row">Nama Barang</th>
                <td>{{$item->nama_barang}}</td>
              </tr>
              <tr>
                <th scope="row">Status</th>
                <td><span class="badge bg-warning text-dark">{{$item->status_barang}}</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Reviews Tab -->
        <div class="tab-pane fade" id="reviews" role="tabpanel">
          <h4 class="mb-4">Laporan Terkait</h4>
          <p class="text-muted">
            Belum ada review yang ditambahkan, coba lagi nanti
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Related Items Section (Our Products) -->
  <section class="related-items-section py-5 bg-white border-top">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3" style="color: #666; font-size: 2.5rem;">Barang Lainnya</h2>
        <p class="lead mb-0" style="color: #999; font-size: 1rem; max-width: 800px; margin: 0 auto;">
          Barang-barang lain yang juga dilaporkan hilang atau ditemukan
        </p>
      </div>
      
    <!-- item card baru scroll -->
      <div class="swiper testimonialSwiper cards-horizontal-scroll">
      <div class="swiper-wrapper cards-scroll-container">
        
        <div class="card-scroll-item swiper-slide">
          <div class="card-wrapper">

            @foreach($relatedItems as $barang)
              <div class="card-scroll-item swiper-slide">
                <div class="card-wrapper">

                  <div class="card-image-box">
                    <img src="{{ asset('storage/' . $barang->foto_barang) }}" alt="Foto Barang">
                  </div>

                  <div class="card-info-box">
                    <h4 class="fw-bold text-dark mb-1">
                      {{ $barang->nama_barang }}
                    </h4>

                    <div class="mb-3">
                      <span class="fw-bold text-red fs-5">{{ $barang->kategori }}</span>
                      <span class="text-secondary"> / {{ $barang->lokasi }}</span>
                    </div>

                    <div class="list-item-custom">
                      <i class="bi bi-layers"></i>
                      <span>{{ \Carbon\Carbon::parse($barang->tanggal)->translatedFormat('d F Y') }}</span>
                    </div>

                    <div class="list-item-custom">
                      <i class="bi bi-geo-alt"></i>
                      <span>Status: {{ ucfirst($barang->status_barang) }}</span>
                    </div>

                    <a href="{{ route('detail', $barang->id) }}" 
                      class="btn btn-red mt-2 w-100">
                      Lihat Detail
                    </a>
                  </div>

                </div>
              </div>
            @endforeach

            </div>
          </div>
        </div>

        <!-- card 1 dan 2 nanti dihapus aja klok udh connect ke database diatas udh ad yg make foreach -->
      </div>
    </div>
  </div>
      <div class="swiper-pagination mt-5"></div>
    </div>

      <div class="text-center mt-5">
        <a href="{{ route('semua.barang') }}" class="btn btn-danger btn-lg px-5">Lihat Lebih Banyak →</a>
      </div>
    </div>
  </section>

  @include('partials.footer')

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Swipper -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".testimonialSwiper", {
      
      centeredSlides: false,
      // Tampilan Mobile (Default)
      slidesPerView: 1,
      spaceBetween: 30,
      // Agar bisa digeser tanpa mentok (Infinite Loop)
      loop: true,
      
      // Agar kursor berubah jadi tangan saat di-hover
      grabCursor: true,

      fade: true,
      
      // (Opsional) Slide otomatis jalan sendiri
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },

      // Titik-titik navigasi di bawah
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },

      // Pengaturan Responsif (Tablet & Laptop)
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2, // Tablet: tampil 2 kartu
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3, // Laptop: tampil 3 kartu
          spaceBetween: 30,
        },
      },
    });
  </script>
  @include('partials.auth-modal')

</body>
</html>

