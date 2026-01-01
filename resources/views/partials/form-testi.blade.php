<!-- Testimonial Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content modal-glass-testi p-4">
      
      <div class="position-absolute top-0 end-0 p-3">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div id="testimonialFormSection">
        <h2 class="glass-header">Tulis Testimonial</h2>
        <p class="text-center text-white-50 mb-4">Bagikan pengalaman Anda dengan TelU Lost & Found</p>
        
        <form action="{{ route('testimonial.store') }}" method="POST" id="testimonialForm">
          @csrf
          
          {{-- 
            PETUNJUK: Setelah authentication siap, uncomment dan sesuaikan:
            
            @auth
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
              <input type="hidden" name="role" value="{{ Auth::user()->role ?? 'Mahasiswa' }}">
            @else
              <div class="alert alert-warning mb-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Anda harus login terlebih dahulu untuk memberikan testimonial.
                <a href="#" data-bs-toggle="modal" data-bs-target="#authModal" class="text-decoration-none">Login di sini</a>
              </div>
            @endauth
          --}}

          <div class="mb-3">
            <label class="form-label text-white mb-2">Nama</label>
            <input type="text" class="form-control form-control-glass" name="nama" 
                   value="Guest" 
                   {{-- 
                     PETUNJUK: Setelah authentication siap, ganti dengan:
                     value="{{ Auth::user()->name ?? 'Guest' }}"
                     readonly
                   --}}
                   placeholder="Nama Anda" required>
          </div>

          <div class="mb-3">
            <label class="form-label text-white mb-2">Role/Status</label>
            <input type="text" class="form-control form-control-glass" name="role" 
                   value="Mahasiswa" 
                   {{-- 
                     PETUNJUK: Setelah authentication siap, ganti dengan:
                     value="{{ Auth::user()->role ?? 'Mahasiswa' }}"
                     readonly
                   --}}
                   placeholder="Mahasiswa/Dosen/Staff" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-white mb-2">Judul Testimonial <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-glass" name="judul" 
                   placeholder="Contoh: The best Web Lost & Found" 
                   maxlength="255" required>
          </div>
          
          <div class="mb-4">
            <label class="form-label text-white mb-2">Deskripsi Testimonial <span class="text-danger">*</span></label>
            <textarea class="form-control form-control-glass" name="deskripsi" rows="5" 
                      placeholder="Ceritakan pengalaman Anda menggunakan platform TelU Lost & Found..." 
                      maxlength="1000" required></textarea>
            <small class="text-white-50 d-block mt-2">
              <span id="charCount">0</span>/1000 karakter
            </small>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="agreeTestimonial" required>
            <label class="form-check-label text-white" style="font-size: 0.85rem;" for="agreeTestimonial">
              Saya menyatakan bahwa testimonial ini adalah pengalaman pribadi saya yang sebenarnya.
            </label>
          </div>

          <button type="submit" class="btn btn-custom-red mb-3 w-100" id="submitTestimonialBtn">
            <i class="bi bi-send me-2"></i>Kirim Testimonial
          </button>
          
          <div class="text-center">
            <span class="text-white-50" style="font-size: 0.9rem;">Terima kasih telah berbagi pengalaman Anda!</span>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Testimonial Form CSS -->
<link href="{{ asset('css/testi.css') }}" rel="stylesheet">

<script>
  // Character counter untuk textarea
  document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('#testimonialForm textarea[name="deskripsi"]');
    const charCount = document.getElementById('charCount');
    
    if (textarea && charCount) {
      textarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        if (length > 900) {
          charCount.style.color = '#ffc107';
        } else if (length > 950) {
          charCount.style.color = '#dc3545';
        } else {
          charCount.style.color = 'rgba(255, 255, 255, 0.5)';
        }
      });
    }

    // Handle checkbox untuk enable/disable submit button
    const agreeCheckbox = document.getElementById('agreeTestimonial');
    const submitBtn = document.getElementById('submitTestimonialBtn');
    
    if (agreeCheckbox && submitBtn) {
      agreeCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
      });
      
      // Disable button secara default
      submitBtn.disabled = true;
    }

    // Handle form submission
    const testimonialForm = document.getElementById('testimonialForm');
    if (testimonialForm) {
      testimonialForm.addEventListener('submit', function(e) {
        {{-- 
          PETUNJUK: Setelah database terkoneksi, uncomment untuk AJAX submission:
          
          e.preventDefault();
          
          const formData = new FormData(this);
          
          // Show loading state
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mengirim...';
          
          fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Testimonial berhasil dikirim! Terima kasih.');
              // Close modal
              const modal = bootstrap.Modal.getInstance(document.getElementById('testimonialModal'));
              modal.hide();
              // Reset form
              this.reset();
              charCount.textContent = '0';
              agreeCheckbox.checked = false;
              submitBtn.disabled = true;
              submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Kirim Testimonial';
              // Reload page atau update testimonial section
              location.reload();
            } else {
              alert('Gagal mengirim testimonial. Silakan coba lagi.');
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Kirim Testimonial';
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim testimonial.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Kirim Testimonial';
          });
        --}}
      });
    }
  });
</script>

