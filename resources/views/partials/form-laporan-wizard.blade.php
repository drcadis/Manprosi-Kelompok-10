<!-- Form Input CSS -->
<link href="{{ asset('css/form-input.css') }}" rel="stylesheet">

<div class="form-wizard-container">
    <div class="form-wizard-card">
        <!-- Progress Indicator -->
        <div class="progress-indicator">
            <div class="progress-step active" id="progress-step-1">
                <div class="step-number">1</div>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step" id="progress-step-2">
                <div class="step-number">2</div>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step" id="progress-step-3">
                <div class="step-number">3</div>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step" id="progress-step-4">
                <div class="step-number">4</div>
            </div>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" id="laporanForm">
            @csrf
            <input type="hidden" name="tipe_laporan" id="tipeLaporan" value="Kehilangan Barang">

            <!-- Step 1: Pilih Tipe -->
            <div class="step-content active" id="step-1">
                <h3 class="step-1-question">Apakah Kamu menemukan barang atau sedang mencari barang?</h3>
                <div class="step-1-actions">
                    <button type="button" class="btn btn-step-choice" onclick="goToStep(2, 'mencari')">
                        Mencari Barang
                    </button>
                    <button type="button" class="btn btn-step-choice" onclick="goToStep(2, 'menemukan')">
                        Menemukan Barang
                    </button>
                </div>
            </div>

            <!-- Step 2: Laporan Data Diri -->
            <div class="step-content" id="step-2">
                <h3 class="form-step-title" id="step2-title">Laporan Cari Barang Hilang</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama</label>
                            <input type="text" class="form-control-custom" name="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">No Telepon Aktif</label>
                            <input type="text" class="form-control-custom" name="no_telp" placeholder="No Telp yang dapat dihubungi" required>
                        </div>
                    </div>                
                    
                </div>
                <div class="form-actions-wrapper">
                    <button type="button" class="btn btn-back" onclick="goBack(1)">Back</button>
                    <button type="button" class="btn btn-continue" onclick="goToStep(3)">
                        Continue <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Detail Barang -->
            <div class="step-content" id="step-3">
                <h3 class="form-step-title" id="step3-title">Detail Barang yang Hilang</h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama Barang</label>
                            <input type="text" class="form-control-custom" name="nama_barang" placeholder="Nama Barang" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Kategori Barang</label>
                            <select class="form-select-custom" name="id_kategori" required>
                                <option value="" disabled selected>Pilih Kategori Barang</option>

                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Tanggal Hilang / Ditemukan</label>
                            <input type="date" class="form-control-custom" name="tanggal" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Perkiraan Lokasi Hilang / Ditemukan</label>
                            <input type="text" class="form-control-custom" name="lokasi" placeholder="Lokasi" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Unggah Foto Barang</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="fotoBarang" name="foto_barang" accept="image/jpeg,image/jpg,image/png" onchange="handleFileSelect(this)">
                                <label for="fotoBarang" class="file-upload-label">
                                    <i class="bi bi-cloud-upload"></i> Klik untuk mengunggah foto
                                </label>
                                <p class="text-muted mb-0 mt-2" style="font-size: 0.85rem;">Format yang didukung: jpg, png, jpeg</p>
                                <div id="fileName" class="mt-2" style="color: #DC3545; font-weight: 600;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Deskripsi / Ciri-ciri Khusus</label>
                            <textarea class="form-control-custom" name="deskripsi" rows="4" placeholder="Jelaskan ciri-ciri barang secara detail..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions-wrapper">
                    <button type="button" class="btn btn-back" onclick="goBack(2)">Back</button>
                    <button type="button" class="btn btn-continue" onclick="goToStep(4)">
                        Continue <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <!-- Step 4: Konfirmasi -->
            <div class="step-content" id="step-4">
                <div class="step-4-content">
                    <div class="confirmation-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h3 class="confirmation-title">Konfirmasi Laporan</h3>
                    <p class="confirmation-text">
                        Pastikan semua data yang Anda masukkan sudah benar.<br>
                        Dengan menekan tombol unggah, laporan Anda akan tersimpan di sistem kami.
                    </p>
                    <div class="confirmation-checkbox">
                        <input type="checkbox" id="confirmCheckbox" required>
                        <label for="confirmCheckbox">
                            Saya menyatakan bahwa data ini benar & barang tersebut milik saya.
                        </label>
                    </div>
                    <div class="form-actions-wrapper">
                        <button type="button" class="btn btn-back" onclick="goBack(3)">Cek Kembali</button>
                        <button type="submit" class="btn btn-submit" id="submitBtn" disabled>
                            Unggah Laporan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Success Popup -->
<div class="success-popup-overlay" id="successPopup">
    <div class="success-popup-card">
        <div class="success-popup-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <p class="success-popup-text">Laporan telah berhasil di unggah</p>
    </div>
</div>

<script>
    // ============================================
    // KONFIGURASI DURASI POPUP SUCCESS
    // ============================================
    // Ubah nilai di bawah ini untuk mengubah durasi popup (dalam milidetik)
    // Contoh: 2000 = 2 detik, 3000 = 3 detik, 5000 = 5 detik
    const SUCCESS_POPUP_DURATION = 2000; // <-- UBAH DURASI DI SINI
    // ============================================

    let currentStep = 1;

    function updateProgressIndicator(step) {
        // Reset all steps
        for (let i = 1; i <= 4; i++) {
            const progressStep = document.getElementById(`progress-step-${i}`);
            const stepContent = document.getElementById(`step-${i}`);
            
            progressStep.classList.remove('active', 'completed');
            stepContent.classList.remove('active');
            
            if (i < step) {
                progressStep.classList.add('completed');
            } else if (i === step) {
                progressStep.classList.add('active');
                stepContent.classList.add('active');
            }
        }
        
        currentStep = step;
    }

    function goToStep(step, tipe = null, skipValidation = false) {
        // Validate current step before proceeding (only if forward and not skipping validation)
        if (!skipValidation && step > currentStep) {
            if (currentStep === 2) {
                if (!validateStep2()) {
                    return;
                }
            } else if (currentStep === 3) {
                if (!validateStep3()) {
                    return;
                }
            }
        }

        // Set tipe laporan if provided
        // Set tipe laporan DAN Route Action if provided
        if (tipe) {
            const form = document.getElementById('laporanForm');

            if (tipe === 'mencari') {
                // 1. Set Value untuk Database
                document.getElementById('tipeLaporan').value = 'Kehilangan Barang';
                
                // 2. ARAHKAN KE CONTROLLER ANDA (LostItemController)
                form.action = "{{ route('lost.store') }}"; 
                
                console.log("Jalur set ke: LostItemController");

            } else if (tipe === 'menemukan') {
                // 1. Set Value untuk Database
                document.getElementById('tipeLaporan').value = 'Kehilangan Pemilik';
                
                // 2. ARAHKAN KE CONTROLLER TEMAN (FoundItemController)
                // Pastikan route 'found.store' sudah ada di web.php, atau komentar dulu jika belum ada
                form.action = "{{ route('found.store') }}"; 
                
                console.log("Jalur set ke: FoundItemController");
            }

            // Update form titles immediately when tipe is selected
            try {
                updateFormTitles(tipe);
            } catch (e) {
                console.warn('updateFormTitles unavailable', e);
            }
        }

        // Update progress indicator
        updateProgressIndicator(step);

        // Scroll to top of form
        document.querySelector('.form-wizard-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Function untuk kembali ke step sebelumnya tanpa validasi
    function goBack(step) {
        goToStep(step, null, true); // skipValidation = true
    } 

    // Function untuk mengupdate judul form berdasarkan tipe laporan
    function updateFormTitles(tipe) {
        const step2Title = document.getElementById('step2-title');
        const step3Title = document.getElementById('step3-title');
        const status_barang = document.getElementById('status_barang');

        if (tipe === 'mencari') {
            // Form untuk mencari barang hilang
            step2Title.textContent = 'Laporan Cari Barang Hilang';
            step3Title.textContent = 'Detail Barang yang Hilang';

        } else if (tipe === 'menemukan') {
            // Form untuk menemukan barang
            step2Title.textContent = 'Laporan Menemukan Barang';
            step3Title.textContent = 'Detail Barang yang Ditemukan';

        }
    }

    function validateStep2() {
        const step = document.getElementById('step-2');
        const requiredFields = step.querySelectorAll(
            'input[required]');

        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#DC3545';
                isValid = false;
            } else {
                field.style.borderColor = '#ddd';
            }
        });

        if (!isValid) {
            alert('Mohon lengkapi semua field yang wajib diisi.');
        }

        return isValid;
    }


    function validateStep3() {
        const step = document.getElementById('step-3');
        const requiredFields = step.querySelectorAll(
            'input[required], select[required], textarea[required]');

        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value || !field.value.trim()) {
                field.style.borderColor = '#DC3545';
                isValid = false;
            } else {
                field.style.borderColor = '#ddd';
            }
        });

        if (!isValid) {
            alert('Mohon lengkapi semua field yang wajib diisi.');
        }

        return isValid;
    }


    function handleFileSelect(input) {
        const fileName = input.files[0]?.name;
        const fileNameDiv = document.getElementById('fileName');
        
        if (fileName) {
            fileNameDiv.textContent = 'File dipilih: ' + fileName;
        } else {
            fileNameDiv.textContent = '';
        }
    }

    // Handle checkbox for submit button
    document.getElementById('confirmCheckbox').addEventListener('change', function() {
        document.getElementById('submitBtn').disabled = !this.checked;
    });

    // Function to show success popup
    function showSuccessPopup() {
        const popup = document.getElementById('successPopup');
        popup.classList.add('show');
        
        // Hide popup after duration
        setTimeout(function() {
            popup.classList.remove('show');
        }, SUCCESS_POPUP_DURATION);
    }

    // Handle form submission with AJAX
    document.getElementById('laporanForm').addEventListener('submit', function(e) {
        if (!document.getElementById('confirmCheckbox').checked) {
            e.preventDefault();
            alert('Mohon centang kotak konfirmasi terlebih dahulu.');
            return false;
        }

        // Validasi file foto jika ada
        const fotoInput = document.getElementById('fotoBarang');
        if (fotoInput && fotoInput.files.length > 0) {
            const file = fotoInput.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const maxFileSize = 5 * 1024 * 1024; // 5MB
            
            // Check extension
            if (!allowedExtensions.includes(fileExtension)) {
                e.preventDefault();
                alert('❌ File tidak diperbolehkan!\nHanya JPG dan PNG yang diterima.\nAnda mengunggah: .' + fileExtension);
                fotoInput.value = '';
                document.getElementById('fileName').textContent = '';
                return false;
            }
            
            // Check file size
            if (file.size > maxFileSize) {
                e.preventDefault();
                alert('❌ File terlalu besar!\nUkuran maksimal: 5MB\nUkuran file Anda: ' + (file.size / (1024 * 1024)).toFixed(2) + 'MB');
                return false;
            }
        }

        // Prevent default form submission
        e.preventDefault();

        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengunggah...';

        // Get form data
        const formData = new FormData(this);

        // Submit form via AJAX
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json().catch(() => {
                    // If response is not JSON (redirect), still show success
                    return { success: true };
                });
            } else if (response.status === 422) {
                // Validation error from server
                return response.json().then(data => {
                    throw { validation: true, errors: data.errors };
                });
            }
            throw new Error('Network response was not ok - Status: ' + response.status);
        })
        .then(data => {
            // Show success popup
            showSuccessPopup();
            
            // Reset form after popup
            setTimeout(function() {
                document.getElementById('laporanForm').reset();
                document.getElementById('tipeLaporan').value = 'Kehilangan Barang'; // Reset to default
                updateFormTitles('mencari'); // Reset titles to default
                updateProgressIndicator(1);
                document.getElementById('confirmCheckbox').checked = false;
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('fileName').textContent = '';
            }, SUCCESS_POPUP_DURATION + 100);
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Handle validation errors
            if (error.validation && error.errors) {
                let errorMsg = '❌ Validasi Gagal:\n\n';
                for (const field in error.errors) {
                    errorMsg += error.errors[field].join('\n') + '\n';
                }
                alert(errorMsg);
            } else {
                alert('❌ Terjadi kesalahan saat mengunggah laporan. Silakan coba lagi.');
            }
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // Check if there's a success message from Laravel session (for non-AJAX fallback)
    @if(session('success'))
        showSuccessPopup();
    @endif

    // Initialize form titles on page load
    document.addEventListener('DOMContentLoaded', function() {
        const currentTipe = document.getElementById('tipeLaporan').value;
        if (currentTipe) {
            updateFormTitles(currentTipe);
        }
    });
</script>

