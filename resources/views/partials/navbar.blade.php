
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-1 sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center p-0" href="{{ url('/') }}">
      <img src="/assets/images/Logo.png" alt="Lost and Found Logo" height="80" style="width: auto; object-fit: contain;">

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="{{ route('semua.barang') }}">Barang Hilang</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="{{ route('cari') }}">Lapor Barang</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="{{ route('admin.index') }}">Admin</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#" onclick="event.preventDefault(); openTestimonialModal();">Testimonial</a></li>

      </ul>
      <div class="d-flex align-items-center gap-2">

          {{-- JIKA BELUM LOGIN --}}
          @guest
            <button type="button"
                    class="btn btn-danger text-white"
                    data-bs-toggle="modal"
                    data-bs-target="#authModal"
                    onclick="switchForm('login')">
                Sign In
            </button>

            <button type="button"
                    class="btn btn-danger text-white"
                    data-bs-toggle="modal"
                    data-bs-target="#authModal"
                    onclick="switchForm('register')">
                Sign up
            </button>
          @endguest


          {{-- JIKA SUDAH LOGIN --}}
          @auth
            <div class="dropdown">
              <button class="btn btn-outline-danger dropdown-toggle"
                      type="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false">
                Settings
              </button>

              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <span class="dropdown-item-text text-muted">
                    {{ auth()->user()->email }}
                  </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                      Logout
                    </button>
                  </form>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('delete') }}"
                        onsubmit="return confirm('Yakin ingin menghapus akun? Semua data akan hilang!')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger">
                          Delete Account
                      </button>
                  </form>
                </li>
              </ul>
            </div>
          @endauth

        </div>

    </div>
  </div>
</nav>





<script>

    // Fungsi untuk membuka modal testimonial
    function openTestimonialModal() {
        // Jika di halaman welcome, scroll ke section testimonial dulu
        if (window.location.pathname === '/' || window.location.pathname === '/home') {
            const testimonialSection = document.getElementById('testimonial');
            if (testimonialSection) {
                testimonialSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                setTimeout(function() {
                    const modalElement = document.getElementById('testimonialModal');
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    }
                }, 500);
            } else {
                const modalElement = document.getElementById('testimonialModal');
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            }
        } else {
            // Jika di halaman lain, langsung buka modal
            const modalElement = document.getElementById('testimonialModal');
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        }
    }

    // Pastikan fungsi tersedia setelah DOM loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi sudah didefinisikan di atas sebagai global, jadi tidak perlu dilakukan apa-apa
        // Ini hanya untuk memastikan script sudah dimuat
        
        // Handle smooth scroll untuk testimonial dari halaman lain
        if (window.location.hash === '#testimonial') {
            setTimeout(function() {
                const testimonialSection = document.getElementById('testimonial');
                if (testimonialSection) {
                    testimonialSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 100);
        }
    });

    // Make function globally accessible
    window.openTestimonialModal = openTestimonialModal;
    </script>

{{-- Include Form Testimonial Modal untuk semua halaman yang menggunakan navbar --}}
@include('partials.form-testi')

