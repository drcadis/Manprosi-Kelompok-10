<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px;">
        <circle cx="20" cy="20" r="18" fill="#DC3545" stroke="white" stroke-width="2"/>
        <path d="M20 10L20 30M10 20L30 20" stroke="white" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <strong class="text-dark">LOST AND FOUND</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#service">Service</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#feature">Feature</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#product">Product</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#testimonial">Testimonial</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="#faq">FAQ</a></li>
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
              </ul>
            </div>
          @endauth

        </div>

    </div>
  </div>
</nav>
