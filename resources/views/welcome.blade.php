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
            left: -70px;
            /* geser ke kiri */
        }

        .carousel-control-next.custom-carousel-btn {
            right: -70px;
            /* geser ke kanan */
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
            height: 300px;
            /* batas tinggi gambar */
            overflow: hidden;
            /* potong gambar berlebih */
            border-radius: 12px;
            /* opsional */
        }
    </style>

    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <section id="home" class="hero-section position-relative"
        style="min-height: 650px; background-image: url('/assets/images/HeloAwal.jpg'); background-size: cover; background-position: center; background-attachment: scroll;">
        <div class="container position-relative h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="hero-content glass-card p-5 rounded-3">
                        @auth
                            <h1 class="display-4 fw-bold mb-4" style="color: #1a1a1a; line-height: 1.2;">Halo,
                                {{ auth()->user()->name }} 👋</h1>
                            <p class="lead mb-4" style="color: #333; line-height: 1.6; font-size: 1rem;">
                                Platform terpercaya untuk melaporkan barang hilang atau ditemukan. Dari dokumen penting hingga
                                barang pribadi, kami membantu mempertemukan pemilik dengan barangnya secara cepat dan aman.
                            </p>
                            <a href="{{ route('cari') }}" class="btn btn-danger px-4 py-2">Lapor Kehilangan Barang</a>

                        @endauth
                        @guest
                            <h1 class="display-4 fw-bold mb-4" style="color: #1a1a1a; line-height: 1.2;">Temukan & Kembalikan
                                Barang!</h1>
                            <p class="lead mb-4" style="color: #333; line-height: 1.6; font-size: 1rem;">
                                Platform terpercaya untuk melaporkan barang hilang atau ditemukan. Dari dokumen penting hingga
                                barang pribadi, kami membantu mempertemukan pemilik dengan barangnya secara cepat dan aman.
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
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="#DC3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="instruction-title">Anda Kehilangan Barang?</h3>
                        <p class="instruction-intro">Jika kamu kehilangan barang hilang di lingkungan Telkom University,
                            lakukan langkah-langkah berikut:</p>
                        <ol class="instruction-list">
                            <li>Jika kamu merasa kehilangan, ingat kapan terakhir kali kamu bersama dengan barang tersebut
                            </li>
                            <li>Laporkan dengan mengisi formulir berikut</li>
                            <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat,
                                serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih
                                lanjut.</li>
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
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="#DC3545" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="instruction-title">Anda Menemukan Barang?</h3>
                        <p class="instruction-intro">Jika kamu menemukan barang hilang di lingkungan Telkom University,
                            lakukan langkah-langkah berikut:</p>
                        <ol class="instruction-list">
                            <li>Jika kamu menemukan barang hilang, amankan barang tersebut.</li>
                            <li>Laporkan dengan mengisi formulir berikut</li>
                            <li>Isi formulir dengan rinci, termasuk deskripsi barang, lokasi dan waktu terakhir dilihat,
                                serta informasi kontak kamu untuk memudahkan Satpam Telkom University menghubungi lebih
                                lanjut.</li>
                            <li>Setelah di laporkan melalui link tersebut, mohon kesedian nya untuk menyerahkan barang
                                kepada Satpam Telkom University.</li>
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
                    <h2 class="display-5 fw-bold mb-3" style="color: #666; font-size: 2.5rem;">Membantu Barang yang Hilang
                        Kembali ke Pemiliknya</h2>
                    <p class="lead" style="color: #999; font-size: 1.1rem;">Satu platform untuk melaporkan dan menemukan
                        barang</p>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="text-danger mb-3">
                                <path
                                    d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <h2 class="display-4 fw-bold text-danger mb-2" style="font-size: 3rem;">55,555</h2>
                            <p class="text-muted mb-0">Kasus kehilangan</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="text-danger mb-3">
                                <path
                                    d="M4 7V5C4 3.89543 4.89543 3 6 3H8M4 7H20M4 7L4 19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V7M20 7V5C20 3.89543 19.1046 3 18 3H16M9 14L11 16L15 12"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <h2 class="display-4 fw-bold text-danger mb-2" style="font-size: 3rem;">46,328</h2>
                            <p class="text-muted mb-0">Berhasil ditemukan</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="text-danger mb-3">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
    <section id="product" class="py-5 bg-white" style="border-top: 1px solid #959597;">
        <div class="container">

            {{-- ================= HEADER ================= --}}
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color:#666; font-size:2.5rem;">
                    Cari Barangmu Disini
                </h2>

                <p class="lead mb-0" style="color:#999; font-size:1rem; max-width:800px; margin:0 auto;">
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
                                            <img src="{{ $item->foto_barang
                            ? asset('storage/' . $item->foto_barang)
                            : asset('assets/images/Missing.jpg') }}" alt="{{ $item->nama_barang }}">
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

                                            <a href="{{ route('detail', $item->id) }}" class="btn btn-red mt-3">
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
                <a href="{{ route('semua.barang') }}" class="btn btn-danger btn-lg px-5">
                    Lihat Lebih Banyak →
                </a>
            </div>

        </div>

        {{-- Found Items Section --}}
    <section class="py-5 bg-white" style="border-top: 1px solid #959597;">
        <div class="container">

            {{-- Header --}}
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color:#666; font-size:2.5rem;">
                    Apakah Kamu Menemukan Barang-Barang Ini?
                </h2>
                <p class="lead mb-0" style="color:#999; font-size:1rem; max-width:800px; margin:0 auto;">
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
                                            <img src="{{ $item->foto_barang
                            ? asset('storage/' . $item->foto_barang)
                            : asset('assets/images/Missing.jpg') }}" alt="{{ $item->nama_barang }}">
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

                                            <a href="{{ route('detail', $item->id) }}" class="btn btn-red mt-3">
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
                <a href="{{ route('cari') }}" class="btn btn-danger btn-lg px-5">
                    Lapor Barang Ditemukan →
                </a>
            </div>

        </div>
    </section>




    <!-- Testimonials Section -->
    <section id="testimonial" class="py-5 position-relative" style="
            min-height: 500px;
            background-image: url('/assets/images/Testimony.png');
            background-size: cover;
            background-position: center;
        ">
        <!-- Overlay -->
        <div class="overlay position-absolute w-100 h-100"></div>

        <div class="container position-relative" style="z-index: 2;">
            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="font-size: 2.5rem; color: #000000ff;">
                    Apa Kata Mereka?
                </h2>
                <p class="lead mb-0" style="color: #000000ff; font-size: 1rem; max-width: 800px; margin: 0 auto;">
                    Testimoni pengguna website Lost & Found
                </p>
            </div>

            <!-- ================= TESTIMONIAL SWIPER ================= -->
            <div class="swiper testimonialSwiper">
                <div class="swiper-wrapper">

                    @if(isset($testimonials) && $testimonials->count())
                        @foreach($testimonials as $testi)
                            <!-- Testimonial Item -->
                            <div class="swiper-slide">
                                <div class="testimonial-card h-100">
                                    <div class="testimonial-card-body">
                                        <h5 class="fw-bold mb-3">
                                            "{{ $testi->judul }}"
                                        </h5>

                                        <p class="text-light mb-4" style="line-height: 1.6;">
                                            {{ $testi->deskripsi }}
                                        </p>

                                        <div class="d-flex align-items-center mt-auto">
                                            <div class="testimonial-avatar me-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($testi->nama) }}&background=DC3545&color=fff&size=128"
                                                    alt="{{ $testi->nama }}" class="rounded-circle"
                                                    style="width:50px;height:50px;object-fit:cover;">
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">{{ $testi->nama }}</p>
                                                <small class="text-light">{{ $testi->role }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback if no testimonials -->
                        <div class="swiper-slide">
                            <div class="testimonial-card h-100">
                                <div class="testimonial-card-body text-center">
                                    <p class="text-light">Belum ada testimonial.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        <!-- Button Testimonial -->
            <div class="text-center mt-10 mb-2">
                <button type="button" class="btn btn-danger btn-lg px-5 mt-5" data-bs-toggle="modal"
                    data-bs-target="#testimonialModal">Testimonial</button>
            </div>
        </div>
    </section>
    <!-- Swiper JS -->
    @push('scripts')
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

      @if(session('success') || session('login_success') || session('register_success'))
    <script>
        Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: @json(session('login_success') ?? session('register_success') ?? session('success')),
        timer: 2500,
        showConfirmButton: false
    });
    </script>
    @endif
    @endpush
@endsection