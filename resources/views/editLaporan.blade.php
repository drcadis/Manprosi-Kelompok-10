<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Laporan - TelU Lost & Found</title>

  {{-- 
    ============================================
    PETUNJUK LENGKAP UNTUK KONEKSI DATABASE:
    ============================================
    
    1. DI CONTROLLER (AdminController@edit):
       public function edit($id) {
         $laporan = Laporan::findOrFail($id);
         return view('editLaporan', compact('laporan'));
       }
    
    2. DI CONTROLLER (AdminController@update):
       public function update(Request $request, $id) {
         $laporan = Laporan::findOrFail($id);
         $laporan->update($request->except(['foto_barang', '_token', '_method']));
         // Handle foto jika ada upload baru
         if ($request->hasFile('foto_barang')) {
           Storage::delete('public/' . $laporan->foto_barang);
           $path = $request->file('foto_barang')->store('laporan', 'public');
           $laporan->foto_barang = $path;
           $laporan->save();
         }
         return redirect()->route('admin.index')->with('success', 'Laporan berhasil diupdate!');
       }
    
    3. GANTI VALUE STATIC dengan DATA dari DATABASE:
       - Semua input sudah ada petunjuk di komentar
       - Gunakan: value="{{ old('field', $laporan->field) }}"
       - Untuk select: {{ $laporan->field == 'value' ? 'selected' : '' }}
  --}}

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>

  @include('partials.navbar')

  <!-- Admin Header -->
  <section class="admin-header bg-danger text-white py-2">
    <div class="container">
      <p class="mb-0 text-center">Aplikasi CRUD dengan Laravel, MySQL, Bootstrap 5, dan jQuery Ajax</p>
    </div>
  </section>

  <!-- Breadcrumb -->
  <section class="breadcrumb-section py-2 bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-decoration-none">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Laporan</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- Edit Form Section -->
  <section class="edit-form-section py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
              <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>Edit Laporan
              </h4>
            </div>
            <div class="card-body p-4">
              <form action="{{ route('admin.update', ['id' => 1]) }}" method="POST" enctype="multipart/form-data" id="editLaporanForm">
                {{-- 
                  PETUNJUK: Setelah database terkoneksi, ganti action dengan:
                  action="{{ route('admin.update', ['id' => $laporan->id]) }}"
                  
                  Dan tambahkan di controller untuk mengambil data:
                  $laporan = Laporan::findOrFail($id);
                  return view('editLaporan', compact('laporan'));
                --}}
                @csrf
                @method('PUT')
                
                {{-- 
                  PETUNJUK: Setelah database terkoneksi, ganti action dengan:
                  action="{{ route('admin.update', ['id' => $laporan->id]) }}"
                  
                  Dan tambahkan hidden input untuk ID:
                  <input type="hidden" name="id" value="{{ $laporan->id }}">
                --}}

                <!-- Tipe Laporan -->
                <div class="row mb-4">
                  <div class="col-12">
                    <h5 class="section-title mb-3">
                      <i class="bi bi-info-circle me-2"></i>Informasi Laporan
                    </h5>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipe Laporan <span class="text-danger">*</span></label>
                    <select class="form-select" name="tipe_laporan" required>
                      <option value="mencari" selected>Mencari Barang</option>
                      <option value="menemukan">Menemukan Barang</option>
                    </select>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <select class="form-select" name="tipe_laporan" required>
                        <option value="mencari" {{ $laporan->tipe_laporan == 'mencari' ? 'selected' : '' }}>Mencari Barang</option>
                        <option value="menemukan" {{ $laporan->tipe_laporan == 'menemukan' ? 'selected' : '' }}>Menemukan Barang</option>
                      </select>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Verifikasi <span class="text-danger">*</span></label>
                    <select class="form-select" name="status_verifikasi" required>
                      <option value="belum_terverifikasi" selected>Belum Terverifikasi</option>
                      <option value="terverifikasi">Terverifikasi</option>
                      <option value="tertolak">Tertolak</option>
                    </select>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <select class="form-select" name="status_verifikasi" required>
                        <option value="belum_terverifikasi" {{ $laporan->status_verifikasi == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
                        <option value="terverifikasi" {{ $laporan->status_verifikasi == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="tertolak" {{ $laporan->status_verifikasi == 'tertolak' ? 'selected' : '' }}>Tertolak</option>
                      </select>
                    --}}
                  </div>
                </div>

                <!-- Data Pelapor -->
                <div class="row mb-4">
                  <div class="col-12">
                    <h5 class="section-title mb-3">
                      <i class="bi bi-person me-2"></i>Data Pelapor
                    </h5>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Pelapor <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_pelapor" value="Nafi Azzahra" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="nama_pelapor" value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Pelapor <span class="text-danger">*</span></label>
                    <select class="form-select" name="status_pelapor" required>
                      <option value="Mahasiswa" selected>Mahasiswa</option>
                      <option value="Dosen">Dosen</option>
                      <option value="Staff">Staff/Karyawan</option>
                    </select>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <select class="form-select" name="status_pelapor" required>
                        <option value="Mahasiswa" {{ old('status_pelapor', $laporan->status_pelapor) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Dosen" {{ old('status_pelapor', $laporan->status_pelapor) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="Staff" {{ old('status_pelapor', $laporan->status_pelapor) == 'Staff' ? 'selected' : '' }}>Staff/Karyawan</option>
                      </select>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">No Telp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_telp" value="081234567890" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $laporan->no_telp) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="nafi@example.com" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="email" class="form-control" name="email" value="{{ old('email', $laporan->email) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fakultas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="fakultas" value="FEB" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="fakultas" value="{{ old('fakultas', $laporan->fakultas) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Program Studi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="program_studi" value="Manajemen" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="program_studi" value="{{ old('program_studi', $laporan->program_studi) }}" required>
                    --}}
                  </div>
                </div>

                <!-- Detail Barang -->
                <div class="row mb-4">
                  <div class="col-12">
                    <h5 class="section-title mb-3">
                      <i class="bi bi-box-seam me-2"></i>Detail Barang
                    </h5>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_barang" value="KTM Nafi Azzahra" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang', $laporan->nama_barang) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kategori Barang <span class="text-danger">*</span></label>
                    <select class="form-select" name="kategori_barang" required>
                      <option value="Elektronik">Elektronik (HP, Laptop, dll)</option>
                      <option value="Dokumen" selected>Dokumen (KTM, KTP, Dompet)</option>
                      <option value="Aksesoris">Aksesoris (Kunci, Kacamata, dll)</option>
                    </select>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <select class="form-select" name="kategori_barang" required>
                        <option value="Elektronik" {{ old('kategori_barang', $laporan->kategori_barang) == 'Elektronik' ? 'selected' : '' }}>Elektronik (HP, Laptop, dll)</option>
                        <option value="Dokumen" {{ old('kategori_barang', $laporan->kategori_barang) == 'Dokumen' ? 'selected' : '' }}>Dokumen (KTM, KTP, Dompet)</option>
                        <option value="Aksesoris" {{ old('kategori_barang', $laporan->kategori_barang) == 'Aksesoris' ? 'selected' : '' }}>Aksesoris (Kunci, Kacamata, dll)</option>
                      </select>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Hilang/Ditemukan <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_hilang" value="2026-12-31" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="date" class="form-control" name="tanggal_hilang" value="{{ old('tanggal_hilang', $laporan->tanggal_hilang) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Lokasi Hilang/Ditemukan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lokasi_hilang" value="Lantai 3 Gedung FEB" required>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <input type="text" class="form-control" name="lokasi_hilang" value="{{ old('lokasi_hilang', $laporan->lokasi_hilang) }}" required>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Barang</label>
                    <select class="form-select" name="status_barang">
                      <option value="Belum Ditemukan" selected>Belum Ditemukan</option>
                      <option value="Ditemukan">Ditemukan</option>
                    </select>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <select class="form-select" name="status_barang">
                        <option value="Belum Ditemukan" {{ old('status_barang', $laporan->status_barang) == 'Belum Ditemukan' ? 'selected' : '' }}>Belum Ditemukan</option>
                        <option value="Ditemukan" {{ old('status_barang', $laporan->status_barang) == 'Ditemukan' ? 'selected' : '' }}>Ditemukan</option>
                      </select>
                    --}}
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Foto Barang</label>
                    <input type="file" class="form-control" name="foto_barang" accept="image/jpeg,image/jpg,image/png">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG</small>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, tambahkan preview foto lama:
                      @if($laporan->foto_barang)
                        <div class="mt-2">
                          <p class="mb-1">Foto saat ini:</p>
                          <img src="{{ asset('storage/' . $laporan->foto_barang) }}" alt="Foto Barang" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                      @endif
                    --}}
                  </div>
                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Deskripsi / Ciri-ciri Khusus <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="deskripsi" rows="4" required>Kartu Tanda Mahasiswa milik Nafi Azzahra Fatih, mahasiswa S1 Manajemen (MBTI) Fakultas Ekonomi dan Bisnis Telkom University.</textarea>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti dengan:
                      <textarea class="form-control" name="deskripsi" rows="4" required>{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                    --}}
                  </div>
                </div>

                <!-- Form Actions -->
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                      <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Batal
                      </a>
                      <button type="submit" class="btn btn-danger">
                        <i class="bi bi-check-circle me-2"></i>Update Laporan
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer')

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- jQuery (untuk AJAX) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Custom JS -->
  <script>
    // Form Validation
    document.getElementById('editLaporanForm').addEventListener('submit', function(e) {
      {{-- 
        PETUNJUK: Setelah database terkoneksi, validasi bisa ditambahkan di sini atau di controller
        Contoh validasi sederhana:
        
        const requiredFields = ['nama_pelapor', 'nama_barang', 'deskripsi'];
        let isValid = true;
        
        requiredFields.forEach(fieldName => {
          const field = this.querySelector(`[name="${fieldName}"]`);
          if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
          } else {
            field.classList.remove('is-invalid');
          }
        });
        
        if (!isValid) {
          e.preventDefault();
          alert('Mohon lengkapi semua field yang wajib diisi.');
        }
      --}}
    });
  </script>

</body>
</html>

