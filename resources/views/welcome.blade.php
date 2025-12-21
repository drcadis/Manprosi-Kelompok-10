@extends('layouts.app')

@section('title', 'TelU Lost & Found - Home')

@section('content')

<style>
.custom-carousel-btn {
    width: 48px;
    height: 48px;
    background-color: #dc3545;
    border-radius: 50%;
    opacity: 1;
    top: 50%;
    transform: translateY(-50%);
}

.carousel-control-prev.custom-carousel-btn {
    left: -70px; /* geser ke kiri */
}

.carousel-control-next.custom-carousel-btn {
    right: -70px; /* geser ke kanan */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(1);
}
.carousel-item {
  transition: transform 0.8s ease-in-out;
}

.carousel-item .card-wrapper {
  opacity: 0;
  transform: translateY(10px);
  transition: all 0.5s ease;
}

.carousel-item.active .card-wrapper {
  opacity: 1;
  transform: translateY(0);
}

.carousel-inner {
  will-change: transform;
}

.card-image-box {
    width: 350px;
    height: 300px;          /* batas tinggi gambar */
    overflow: hidden;       /* potong gambar berlebih */
    border-radius: 12px;    /* opsional */
}



</style>


<!-- Hero Section -->
<section id="home" class="hero-section position-relative" style="min-height: 650px; background-image: url('/assets/images/HeloAwal.jpg'); background-size: cover; background-position: center; background-attachment: scroll;">
  <div class="container position-relative h-100">
    <div class="row h-100 align-items-center">
      <div class="col-lg-6 col-md-8">
        <div class="hero-content glass-card p-5 rounded-3">
          @auth
          <h1 class="display-4 fw-bold mb-4" style="color: #1a1a1a; line-height: 1.2;">Halo, {{ auth()->user()->name }} 👋</h1>
          <p class="lead mb-4" style="color: #333; line-height: 1.6; font-size: 1rem;">
            Platform terpercaya untuk melaporkan barang hilang atau ditemukan. Dari dokumen penting hingga barang pribadi, kami membantu mempertemukan pemilik dengan barangnya secara cepat dan aman.
          </p>
          <a href="{{ route('cari') }}" class="btn btn-danger px-4 py-2">Lapor Kehilangan Barang</a>

          @endauth
          @guest
            <h1 class="display-4 fw-bold mb-4" style="color: #1a1a1a; line-height: 1.2;">Temukan & Kembalikan Barang!</h1>
          <p class="lead mb-4" style="color: #333; line-height: 1.6; font-size: 1rem;">
            Platform terpercaya untuk melaporkan barang hilang atau ditemukan. Dari dokumen penting hingga barang pribadi, kami membantu mempertemukan pemilik dengan barangnya secara cepat dan aman.
          </p>
          @endguest
        </div>
      </div>
    </div>
  </div>
  
</section>

<!-- Welcome Section -->
<section class="py-5 bg-white">
  <div class="container text-center">
    <h2 class="display-5 fw-bold mb-2" style="color: #666; font-size: 2.5rem;">Wellcome to TelU Lost & Found</h2>
    <p class="lead" style="color: #999; font-size: 1.1rem;">Layanan Pengaduan Kehilangan dan Penemuan Barang</p>
  </div>
</section>

<!-- Lost and Found Instructions Section -->
<section id="service" class="instructions-section py-5 bg-white">
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
            <li>Jika kamu merasa kehilangan, ingat kapan terakhir kali kamu bersama dengan barang tersebut</li>
            <li>Laporkan dengan mengisi formulir berikut</li>
            <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat, serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih lanjut.</li>
            <li>Tunggu informasi lanjutan apabila barang ditemukan.</li>
          </ol>
          <div class="text-center mt-4">
            <a href="{{ route('cari') }}" class="btn btn-danger px-4 py-2">Lapor Kehilangan Barang</a>
          </div>
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
            <li>Jika kamu menemukan barang hilang, amankan barang tersebut.</li>
            <li>Laporkan dengan mengisi formulir berikut</li>
            <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat, serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih lanjut.</li>
            <li>Setelah di laporkan melalui link tersebut, mohon kesedian nya untuk menyerahkan barang kepada Satpam Telkom University.</li>
          </ol>
          <div class="text-center mt-4">
            <a href="{{ route('cari') }}" class="btn btn-danger px-4 py-2">Lapor Menemukan Barang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Statistics Section -->
<section id="feature" class="py-5" style="background-color: #e5e5e5;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <h2 class="display-5 fw-bold mb-3" style="color: #666; font-size: 2.5rem;">Membantu Barang yang Hilang Kembali ke Pemiliknya</h2>
        <p class="lead" style="color: #999; font-size: 1.1rem;">Satu platform untuk melaporkan dan menemukan barang</p>
      </div>
      <div class="col-lg-7">
        <div class="row g-4">
          <div class="col-md-4 text-center">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-danger mb-3">
              <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="display-4 fw-bold text-danger mb-2" style="font-size: 3rem;">55,555</h2>
            <p class="text-muted mb-0">Kasus kehilangan</p>
          </div>
          <div class="col-md-4 text-center">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-danger mb-3">
              <path d="M4 7V5C4 3.89543 4.89543 3 6 3H8M4 7H20M4 7L4 19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V7M20 7V5C20 3.89543 19.1046 3 18 3H16M9 14L11 16L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="display-4 fw-bold text-danger mb-2" style="font-size: 3rem;">46,328</h2>
            <p class="text-muted mb-0">Berhasil ditemukan</p>
          </div>
          <div class="col-md-4 text-center">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-danger mb-3">
              <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h2 class="display-4 fw-bold text-danger mb-2" style="font-size: 3rem;">28,867</h2>
            <p class="text-muted mb-0">Dalam pencarian</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Search Items Section -->
<section
    id="product"
    class="py-5 bg-white"
    style="border-top: 1px solid #959597;"
>
    <div class="container">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-5">
            <h2
                class="display-5 fw-bold mb-3"
                style="color:#666; font-size:2.5rem;"
            >
                Cari Barangmu Disini
            </h2>

            <p
                class="lead mb-0"
                style="color:#999; font-size:1rem; max-width:800px; margin:0 auto;"
            >
                Kamu bisa mencari barang kamu yang hilang di sini.
                Jika tidak ada, kamu bisa memilih “Lihat Lebih Banyak”.
                Semoga barang kamu segera ditemukan.
            </p>
        </div>

        {{-- ================= ITEM CARDS ================= --}}
        <div class="swiper testimonialSwiper cards-horizontal-scroll">
            <div class="swiper-wrapper cards-scroll-container">

                @if(isset($pemilik) && $pemilik->count())
                    @foreach ($pemilik as $item)
                        <div class="swiper-slide">
                            <div class="card-wrapper">

                                {{-- Image --}}
                                <div class="card-image-box">
                                    <img
                                        src="{{ $item->foto_barang
                                            ? asset('storage/'.$item->foto_barang)
                                            : asset('assets/images/Missing.jpg') }}"
                                        alt="{{ $item->nama_barang }}"
                                    >
                                </div>

                                {{-- Info --}}
                                <div class="card-info-box">
                                    <h4 class="fw-bold text-dark mb-1">
                                        {{ $item->nama_barang }}
                                    </h4>

                                    <div class="mb-3">
                                        <span class="fw-bold text-danger fs-5">
                                            {{ $item->kategori?->nama_kategori ?? '-' }}
                                        </span>
                                        <span class="text-secondary">
                                            / {{ $item->lokasi }}
                                        </span>
                                    </div>

                                    <h6 class="fw-bold text-secondary mb-3">
                                        Detail Barang:
                                    </h6>

                                    <div class="list-item-custom">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $item->lokasi }}</span>
                                    </div>

                                    <div class="list-item-custom">
                                        <i class="bi bi-calendar"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>

                                    <div class="list-item-custom">
                                        <i class="bi bi-info-circle"></i>
                                        <span>
                                            Status: {{ ucfirst($item->status_barang) }}
                                        </span>
                                    </div>

                                    <a
                                        href="{{ route('detail', $item->id) }}"
                                        class="btn btn-red mt-3"
                                    >
                                        Lihat Detail
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        {{-- ================= BUTTON ================= --}}
        <div class="text-center mt-5">
            <a
                href="{{ route('semua.barang') }}"
                class="btn btn-danger btn-lg px-5"
            >
                Lihat Lebih Banyak →
            </a>
        </div>

    </div>

    {{-- ================= MODAL LOGIN & REGISTER ================= --}}
    <div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content modal-glass p-4">

                {{-- Close Button --}}
                <div class="position-absolute top-0 end-0 p-3">
                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                {{-- ================= LOGIN ================= --}}
                <div id="loginSection">
                    <h2 class="glass-header">Login</h2>
                    <p class="text-center text-white-50 mb-4">
                        Temukan & Kembalikan Barang
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-glass"
                                placeholder="Email"
                                required
                            >
                        </div>

                        <div class="mb-3 position-relative">
                            <input
                                type="password"
                                name="password"
                                id="loginPass"
                                class="form-control form-control-glass"
                                placeholder="Password"
                                required
                            >
                            <i
                                class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                                style="cursor:pointer;"
                                onclick="togglePass('loginPass')"
                            ></i>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="rememberMe"
                                >
                                <label
                                    class="form-check-label text-white"
                                    for="rememberMe"
                                    style="font-size:0.9rem;"
                                >
                                    Remember me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="helper-text">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-custom-red mb-3">
                            Login
                        </button>

                        <div class="text-center">
                            <span class="text-white-50" style="font-size:0.9rem;">
                                Don't have account?
                            </span>
                            <a
                                onclick="switchForm('register')"
                                class="auth-toggle-link fw-bold"
                            >
                                Register
                            </a>
                        </div>
                    </form>
                </div>

                {{-- ================= REGISTER ================= --}}
                <div id="registerSection" class="d-none">
                    <h2 class="glass-header">Create Account</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <input
                                type="text"
                                name="name"
                                class="form-control form-control-glass"
                                placeholder="Name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-glass"
                                placeholder="Email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <input
                                type="password"
                                name="password"
                                id="regPass"
                                class="form-control form-control-glass"
                                placeholder="Password"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control form-control-glass"
                                placeholder="Confirm Password"
                            >
                        </div>

                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="agreeTerms"
                                required
                            >
                            <label
                                class="form-check-label text-white"
                                for="agreeTerms"
                                style="font-size:0.85rem;"
                            >
                                Accept all terms & conditions
                            </label>
                        </div>

                        <button type="submit" class="btn btn-custom-red mb-3">
                            Create Account
                        </button>

                        <div class="text-center">
                            <span class="text-white-50" style="font-size:0.9rem;">
                                Already have account?
                            </span>
                            <a
                                onclick="switchForm('login')"
                                class="auth-toggle-link fw-bold"
                            >
                                Login
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>



<!-- Found Items Section -->
<section
    class="py-5 bg-white"
    style="border-top: 1px solid #959597;"
>
    <div class="container">

        {{-- Header --}}
        <div class="text-center mb-5">
            <h2
                class="display-5 fw-bold mb-3"
                style="color:#666; font-size:2.5rem;"
            >
                Apakah Kamu Menemukan Barang-Barang Ini?
            </h2>
            <p
                class="lead mb-0"
                style="color:#999; font-size:1rem; max-width:800px; margin:0 auto;"
            >
                Jika kamu menemukan barang berikut, silakan laporkan demi membantu pemiliknya.
            </p>
        </div>

        {{-- Item Cards (Horizontal Scroll – sama seperti search section) --}}
        <div class="swiper testimonialSwiper cards-horizontal-scroll">
            <div class="swiper-wrapper cards-scroll-container">

                @if(isset($barang) && $barang->count())
                    @foreach ($barang as $item)
                        <div class="swiper-slide">
                            <div class="card-wrapper">

                                {{-- Image --}}
                                <div class="card-image-box">
                                    <img
                                        src="{{ $item->foto_barang
                                            ? asset('storage/'.$item->foto_barang)
                                            : asset('assets/images/Missing.jpg') }}"
                                        alt="{{ $item->nama_barang }}"
                                    >
                                </div>

                                {{-- Info --}}
                                <div class="card-info-box">
                                    <h4 class="fw-bold text-dark mb-1">
                                        {{ $item->nama_barang }}
                                    </h4>

                                    <div class="mb-3">
                                        <span class="fw-bold text-danger fs-5">
                                            {{ $item->kategori?->nama_kategori ?? '-' }}
                                        </span>
                                        <span class="text-secondary">
                                            / {{ $item->lokasi }}
                                        </span>
                                    </div>

                                    <h6 class="fw-bold text-secondary mb-3">
                                        Detail Barang:
                                    </h6>

                                    <div class="list-item-custom">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>{{ $item->lokasi }}</span>
                                    </div>

                                    <div class="list-item-custom">
                                        <i class="bi bi-calendar"></i>
                                        <span>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>

                                    <div class="list-item-custom">
                                        <i class="bi bi-info-circle"></i>
                                        <span>
                                            Status: {{ ucfirst($item->status_barang) }}
                                        </span>
                                    </div>

                                    <a
                                        href="{{ route('detail', $item->id) }}"
                                        class="btn btn-red mt-3"
                                    >
                                        Lihat Detail
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted">
                        Tidak ada barang ditemukan saat ini.
                    </div>
                @endif

            </div>
        </div>

        {{-- Action Button --}}
        <div class="text-center mt-5">
            <a
                href="{{ route('cari') }}"
                class="btn btn-danger btn-lg px-5"
            >
                Lapor Barang Ditemukan →
            </a>
        </div>

    </div>
</section>




<!-- Testimonials Section -->
<section
    id="testimonial"
    class="py-5 position-relative"
    style="
        min-height: 500px;
        background-image: url('/assets/images/Testimony.png');
        background-size: cover;
        background-position: center;
    "
>
    <!-- Overlay -->
    <div class="overlay position-absolute w-100 h-100"></div>

    <div class="container position-relative" style="z-index: 2;">
        <!-- Header -->
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="font-size: 2.5rem; color: #000000ff;">
                Apa Kata Mereka?
            </h2>
            <p
                class="lead mb-0"
                style="color: #000000ff; font-size: 1rem; max-width: 800px; margin: 0 auto;"
            >
                Testimoni pengguna website Lost & Found
            </p>
        </div>

        <!-- ================= TESTIMONIAL SWIPER ================= -->
        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper">

                <!-- Testimonial Item -->
                <div class="swiper-slide">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-card-body">
                            <h5 class="fw-bold mb-3">
                                "The best Web Lost & Found"
                            </h5>

                            <p class="text-light mb-4" style="line-height: 1.6;">
                                Aku jadi bisa menemukan barang yang hilang berkat
                                website ini. Terima kasih!
                            </p>

                            <div class="d-flex align-items-center">
                                <div class="testimonial-avatar me-3">
                                    <img
                                        src="https://ui-avatars.com/api/?name=Nouvail&background=DC3545&color=fff&size=128"
                                        alt="Nouvail"
                                        class="rounded-circle"
                                        style="width:50px;height:50px;object-fit:cover;"
                                    >
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Nouvail</p>
                                    <small class="text-light">Mahasiswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Item -->
                <div class="swiper-slide">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-card-body">
                            <h5 class="fw-bold mb-3">
                                "Platform yang sangat membantu"
                            </h5>

                            <p class="text-light mb-4" style="line-height: 1.6;">
                                Saya kehilangan KTM di kampus dan menemukannya
                                hanya dalam 2 hari.
                            </p>

                            <div class="d-flex align-items-center">
                                <div class="testimonial-avatar me-3">
                                    <img
                                        src="/assets/images/testi.jpg"
                                        alt="Sarah"
                                        class="rounded-circle"
                                        style="width:50px;height:50px;object-fit:cover;"
                                    >
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Sarah Putri</p>
                                    <small class="text-light">Mahasiswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial Item -->
                <div class="swiper-slide">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-card-body">
                            <h5 class="fw-bold mb-3">
                                "Sangat mudah digunakan"
                            </h5>

                            <p class="text-light mb-4" style="line-height: 1.6;">
                                Interface sederhana dan proses pelaporan cepat.
                                Sangat recommended!
                            </p>

                            <div class="d-flex align-items-center">
                                <div class="testimonial-avatar me-3">
                                    <img
                                        src="/assets/images/testi.jpg"
                                        alt="Budi"
                                        class="rounded-circle"
                                        style="width:50px;height:50px;object-fit:cover;"
                                    >
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Budi Santoso</p>
                                    <small class="text-light">Mahasiswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tambahkan slide lain jika perlu -->

            </div>
        </div>
        <!-- ===================================================== -->

    </div>
</section>


<!-- Login Modal-->
@push('scripts')

<script>
        // Fungsi untuk mengganti tampilan Login <-> Register
        function switchForm(target) {
            const loginSection = document.getElementById('loginSection');
            const registerSection = document.getElementById('registerSection');

            // Efek fade sederhana menggunakan class Bootstrap d-none
            if (target === 'register') {
                loginSection.classList.add('d-none');
                registerSection.classList.remove('d-none');
            } else {
                registerSection.classList.add('d-none');
                loginSection.classList.remove('d-none');
            }
        }

        // Fungsi opsional untuk melihat password (ikon mata)
        function togglePass(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
@endpush

    </div>
      <div class="swiper-pagination mt-5"></div>
    </div>
    <!-- Button Testimonial -->
    <div class="text-center mt-1 mb-4">
      <button type="button" class="btn btn-danger btn-lg px-5 mt-3" data-bs-toggle="modal" data-bs-target="#testimonialModal">Testimonial</button>
    </div>
  </div>
</section> 


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



@endsection
