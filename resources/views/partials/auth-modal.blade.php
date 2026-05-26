{{-- GLOBAL LOGIN/REGISTER MODAL --}}
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content modal-glass p-4">

            {{-- Close Button --}}
            <div class="position-absolute top-0 end-0 p-3">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            {{-- ================= LOGIN ================= --}}
            <div id="loginSection">
                <h2 class="glass-header">Login</h2>
                <p class="text-center text-white-50 mb-4">
                    Temukan & Kembalikan Barang
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="alert alert-danger py-2 mb-3" role="alert">
                            {{ $errors->first('email') ?? $errors->first('password') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-glass" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <input type="password" name="password" id="loginPass"
                            class="form-control form-control-glass" placeholder="Password" required>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"
                            style="cursor:pointer;" onclick="togglePass('loginPass')"></i>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label text-white" for="rememberMe" style="font-size:0.9rem;">
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
                        <a onclick="switchForm('register')" class="auth-toggle-link fw-bold" style="cursor: pointer;">
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
                        <input type="text" name="name" class="form-control form-control-glass" placeholder="Name"
                            required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-glass" placeholder="Email"
                            required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" id="regPass" class="form-control form-control-glass"
                            placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control form-control-glass"
                            placeholder="Confirm Password">
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                        <label class="form-check-label text-white" for="agreeTerms" style="font-size:0.85rem;">
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
                        <a onclick="switchForm('login')" class="auth-toggle-link fw-bold" style="cursor: pointer;">
                            Login
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- GLOBAL AUTH MODAL FUNCTIONS --}}
<script>
    // Fungsi untuk mengganti tampilan Login <-> Register
    function switchForm(target) {
        const loginSection = document.getElementById('loginSection');
        const registerSection = document.getElementById('registerSection');

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

    document.addEventListener('DOMContentLoaded', function () {
        const shouldOpenAuth = @json($errors->has('email') || $errors->has('password') || $errors->has('name') || session('register_success'));
        if (!shouldOpenAuth) return;

        const authModalEl = document.getElementById('authModal');
        if (!authModalEl) return;

        const authModal = new bootstrap.Modal(authModalEl);
        authModal.show();

        @if (session('register_success') || $errors->has('name') || $errors->has('password_confirmation'))
            switchForm('register');
        @else
            switchForm('login');
        @endif
    });
</script>
