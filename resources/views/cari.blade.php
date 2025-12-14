<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cari Barang - TelU Lost & Found</title>

    {{-- ================= CSS ================= --}}
    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cari.css') }}" rel="stylesheet">
</head>

<body>

    {{-- ================= NAVBAR ================= --}}
    @include('partials.navbar')

    {{-- ================= HERO SECTION ================= --}}
    <section
        class="hero-cari-section"
        style="
            height: 300px;
            background-image: url('/assets/images/tumnailSemua.png');
            background-size: cover;
            background-position: center;
        "
    >
        <div class="hero-content-below">
            <div class="container text-center">
                <h1 class="hero-title text-white">
                    Welcome to TelU Lost & Found
                </h1>
                <p class="hero-subtitle text-white">
                    Layanan Pengaduan Kehilangan dan Penemuan Barang
                </p>

            </div>
        </div>
    </section>

    {{-- ================= INSTRUCTIONS SECTION ================= --}}
    <section class="instructions-section py-5 bg-white">
        <div class="container">
            <div class="row g-4">

                {{-- Lost Item --}}
                <div class="col-md-6">
                    <div class="instruction-card">
                        <div class="instruction-icon-wrapper">
                            <div class="instruction-icon-box">
                                <svg
                                    width="48"
                                    height="48"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.134 17 3 13.866 3 10C3 6.134 6.134 3 10 3C13.866 3 17 6.134 17 10Z"
                                        stroke="#DC3545"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>

                        <h3 class="instruction-title">Anda Kehilangan Barang?</h3>
                        <p class="instruction-intro">
                            Jika kamu kehilangan barang di lingkungan Telkom University,
                            lakukan langkah-langkah berikut:
                        </p>

                        <ol class="instruction-list">
                            <li>Ingat kapan terakhir kali bersama barang tersebut</li>
                            <li>Laporkan dengan mengisi formulir berikut</li>
                            <li>
                                Isi formulir secara rinci (deskripsi barang, lokasi,
                                waktu terakhir terlihat, dan kontak kamu)
                            </li>
                            <li>Tunggu informasi lanjutan jika barang ditemukan</li>
                        </ol>
                    </div>
                </div>

                {{-- Found Item --}}
                <div class="col-md-6">
                    <div class="instruction-card">
                        <div class="instruction-icon-wrapper">
                            <div class="instruction-icon-box">
                                <svg
                                    width="48"
                                    height="48"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.134 17 3 13.866 3 10C3 6.134 6.134 3 10 3C13.866 3 17 6.134 17 10Z"
                                        stroke="#DC3545"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>

                        <h3 class="instruction-title">Anda Menemukan Barang?</h3>
                        <p class="instruction-intro">
                            Jika kamu menemukan barang di lingkungan Telkom University,
                            lakukan langkah-langkah berikut:
                        </p>

                        <ol class="instruction-list">
                            <li>Amankan barang tersebut</li>
                            <li>Laporkan dengan mengisi formulir berikut</li>
                            <li>
                                Isi formulir secara rinci untuk memudahkan
                                pihak keamanan menghubungi
                            </li>
                            <li>
                                Serahkan barang kepada Satpam Telkom University
                                setelah laporan dibuat
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= FORM SECTION ================= --}}
    <section class="form-section position-relative">

        {{-- Background Image --}}
        <div class="form-background">
            <img
                src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1920&q=80"
                alt="Aerial view"
                class="form-bg-image"
            >
        </div>

        {{-- Background Text --}}
        <div class="form-background-text">
            <span>FORM LAPORAN</span>
        </div>

        {{-- Form --}}
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    @include('partials.form-laporan-wizard')
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    @include('partials.footer')

    {{-- ================= JS ================= --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>
</html>
