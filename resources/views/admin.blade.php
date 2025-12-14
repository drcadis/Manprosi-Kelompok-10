{{-- 
  ============================================
  HALAMAN ADMIN - TELU LOST & FOUND
  ============================================
  
  PETUNJUK LENGKAP UNTUK KONEKSI DATABASE:
  
  1. BUAT MODEL DAN MIGRATION:
     - php artisan make:model Laporan -m
     - Di migration, tambahkan kolom:
       * tipe_laporan (enum: 'mencari', 'menemukan')
       * nama_pelapor, status_pelapor, no_telp, email, fakultas, program_studi
       * nama_barang, kategori_barang, tanggal_hilang, lokasi_hilang
       * foto_barang, deskripsi, status_barang
       * status_verifikasi (enum: 'belum_terverifikasi', 'terverifikasi', 'tertolak')
       * timestamps (created_at, updated_at)
  
  2. BUAT CONTROLLER:
     - php artisan make:controller AdminController
     - Method index(): return view('admin', ['laporan' => Laporan::paginate(7)])
     - Method edit($id): return view('editLaporan', ['laporan' => Laporan::findOrFail($id)])
     - Method update(Request $request, $id): update data dan redirect
     - Method destroy($id): delete data dan return JSON
     - Method updateStatus(Request $request): update status_verifikasi dan return JSON
  
  3. UPDATE ROUTE di web.php:
     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
     Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
     Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
     Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
     Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.update-status');
  
  4. GANTI DATA STATIC dengan LOOP:
     - Cari bagian "Sample Data Row" dan ganti dengan @foreach sesuai petunjuk di komentar
  
  5. UPDATE JAVASCRIPT:
     - Uncomment fungsi updateStatus() dan sesuaikan URL
     - Uncomment fungsi deleteLaporan() dan sesuaikan URL
  
  CATATAN PENTING:
  - Semua komentar menggunakan {{-- --}} sehingga aman dan tidak akan menyebabkan error Laravel
  - Pastikan field name di form sesuai dengan nama kolom di database
  - Untuk upload foto, pastikan storage link sudah dibuat: php artisan storage:link
  - Gunakan validation di controller untuk memastikan data valid
--}}
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - TelU Lost & Found</title>

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
          <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- Admin Content -->
  <section class="admin-content py-4 bg-light">
    <div class="container">
      <!-- Page Title and Controls -->
      <div class="row align-items-center mb-4">
        <div class="col-md-6">
          <h2 class="page-title mb-3">
            <i class="bi bi-clipboard-data me-2"></i>Laporan Barang
          </h2>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLaporanModal">
            <i class="bi bi-plus-circle me-2"></i>Entri Laporan
          </button>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex align-items-center justify-content-md-end gap-3">
            <label class="mb-0">Show</label>
            <select class="form-select form-select-sm d-inline-block" id="entriesPerPage" style="width: auto;">
              <option value="7" selected>7</option>
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
            <label class="mb-0">entries</label>
            <div class="search-box">
              <label class="mb-0 me-2">Search:</label>
              <input type="text" class="form-control form-control-sm d-inline-block" id="searchInput" style="width: 200px;" placeholder="Cari...">
            </div>
          </div>
        </div>
      </div>

      <!-- Data Table -->
      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="laporanTable">
              <thead class="table-light">
                <tr>
                  <th>No.</th>
                  <th>Foto</th>
                  <th>ID Laporan</th>
                  <th>Tipe Laporan</th>
                  <th>Nama Pelapor</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Laporan</th>
                  <th>Status Verifikasi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                {{-- 
                  PETUNJUK: Setelah database terkoneksi, ganti struktur di bawah dengan loop foreach
                  
                  Contoh:
                  @if(isset($laporan) && count($laporan) > 0)
                    @foreach($laporan as $index => $item)
                      <tr>
                        <td>{{ $laporan->firstItem() + $index }}</td>
                        <td>
                          <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="table-photo">
                        </td>
                        <td>{{ $item->id_laporan ?? 'LAP-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>
                          <span class="badge {{ $item->tipe_laporan == 'mencari' ? 'bg-warning' : 'bg-success' }}">
                            {{ $item->tipe_laporan == 'mencari' ? 'Mencari Barang' : 'Menemukan Barang' }}
                          </span>
                        </td>
                        <td>{{ $item->nama_pelapor }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>
                          <select class="form-select form-select-sm status-verifikasi" data-id="{{ $item->id }}" onchange="updateStatus(this)">
                            <option value="belum_terverifikasi" {{ $item->status_verifikasi == 'belum_terverifikasi' ? 'selected' : '' }}>Belum Terverifikasi</option>
                            <option value="terverifikasi" {{ $item->status_verifikasi == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="tertolak" {{ $item->status_verifikasi == 'tertolak' ? 'selected' : '' }}>Tertolak</option>
                          </select>
                        </td>
                        <td>
                          <a href="{{ route('detail.barang', ['id' => $item->id]) }}" class="btn btn-warning btn-sm" title="Detail">
                            <i class="bi bi-eye"></i> Detail
                          </a>
                          <a href="{{ route('admin.edit', ['id' => $item->id]) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i> Ubah
                          </a>
                          <button type="button" class="btn btn-danger btn-sm" onclick="deleteLaporan({{ $item->id }})" title="Hapus">
                            <i class="bi bi-trash"></i> Hapus
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="9" class="text-center py-5">
                        <p class="text-muted mb-0">Tidak ada data laporan.</p>
                      </td>
                    </tr>
                  @endif
                  
                  CATATAN:
                  - Pastikan variabel $laporan sudah di-pass dari controller
                  - Sesuaikan nama field (id_laporan, tipe_laporan, nama_pelapor, dll) dengan struktur tabel database Anda
                  - Untuk foto, pastikan path storage sudah benar
                  - Untuk pagination, gunakan: {{ $laporan->links() }} di bawah tabel
                --}}

                <!-- Sample Data Row 1 -->
                <tr>
                  <td>1</td>
                  <td>
                    <img src="/assets/images/ktm-dummy.jpg" alt="KTM" class="table-photo">
                  </td>
                  <td>LAP-00016</td>
                  <td>
                    <span class="badge bg-warning">Mencari Barang</span>
                  </td>
                  <td>Nafi Azzahra</td>
                  <td>KTM Nafi Azzahra</td>
                  <td>31-12-2026</td>
                  <td>
                    <select class="form-select form-select-sm status-verifikasi" data-id="1" onchange="updateStatus(this)">
                      <option value="belum_terverifikasi" selected>Belum Terverifikasi</option>
                      <option value="terverifikasi">Terverifikasi</option>
                      <option value="tertolak">Tertolak</option>
                    </select>
                  </td>
                  <td>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti href dengan:
                      href="{{ route('detail.barang', ['id' => $item->id]) }}"
                      Pastikan route detail.barang sudah menerima parameter {id}
                    --}}
                    <a href="{{ route('detail.barang') }}" class="btn btn-warning btn-sm" title="Detail">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti href dengan:
                      href="{{ route('admin.edit', ['id' => $item->id]) }}"
                    --}}
                    <a href="{{ route('admin.edit', ['id' => 1]) }}" class="btn btn-primary btn-sm" title="Edit">
                      <i class="bi bi-pencil"></i> Ubah
                    </a>
                    {{-- 
                      PETUNJUK: Setelah database terkoneksi, ganti onclick dengan:
                      onclick="deleteLaporan({{ $item->id }})"
                    --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteLaporan(1)" title="Hapus">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </td>
                </tr>

                <!-- Sample Data Row 2 -->
                <tr>
                  <td>2</td>
                  <td>
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=100&auto=format&fit=crop" alt="Dompet" class="table-photo">
                  </td>
                  <td>LAP-00015</td>
                  <td>
                    <span class="badge bg-success">Menemukan Barang</span>
                  </td>
                  <td>John Doe</td>
                  <td>Dompet Hilang</td>
                  <td>12-01-2024</td>
                  <td>
                    <select class="form-select form-select-sm status-verifikasi" data-id="2" onchange="updateStatus(this)">
                      <option value="belum_terverifikasi">Belum Terverifikasi</option>
                      <option value="terverifikasi" selected>Terverifikasi</option>
                      <option value="tertolak">Tertolak</option>
                    </select>
                  </td>
                  <td>
                    <a href="{{ route('detail.barang') }}" class="btn btn-warning btn-sm" title="Detail">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="{{ route('admin.edit', ['id' => 2]) }}" class="btn btn-primary btn-sm" title="Edit">
                      <i class="bi bi-pencil"></i> Ubah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteLaporan(2)" title="Hapus">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </td>
                </tr>

                <!-- Sample Data Row 3 -->
                <tr>
                  <td>3</td>
                  <td>
                    <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=100&auto=format&fit=crop" alt="Tas" class="table-photo">
                  </td>
                  <td>LAP-00014</td>
                  <td>
                    <span class="badge bg-warning">Mencari Barang</span>
                  </td>
                  <td>Jane Smith</td>
                  <td>Tas Ransel Hitam</td>
                  <td>15-01-2024</td>
                  <td>
                    <select class="form-select form-select-sm status-verifikasi" data-id="3" onchange="updateStatus(this)">
                      <option value="belum_terverifikasi">Belum Terverifikasi</option>
                      <option value="terverifikasi">Terverifikasi</option>
                      <option value="tertolak" selected>Tertolak</option>
                    </select>
                  </td>
                  <td>
                    <a href="{{ route('detail.barang') }}" class="btn btn-warning btn-sm" title="Detail">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="{{ route('admin.edit', ['id' => 3]) }}" class="btn btn-primary btn-sm" title="Edit">
                      <i class="bi bi-pencil"></i> Ubah
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteLaporan(3)" title="Hapus">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="row mt-3">
        <div class="col-md-6">
          <p class="text-muted mb-0">
            {{-- 
              PETUNJUK: Setelah menggunakan pagination, ganti dengan:
              Showing {{ $laporan->firstItem() }} to {{ $laporan->lastItem() }} of {{ $laporan->total() }} entries
            --}}
            Showing 1 to 7 of 16 entries
          </p>
        </div>
        <div class="col-md-6">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end mb-0">
              {{-- 
                PETUNJUK: Setelah menggunakan pagination, ganti dengan:
                {{ $laporan->links() }}
                atau
                @if($laporan->hasPages())
                  {{ $laporan->links() }}
                @endif
              --}}
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
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
    // Update Status Verifikasi
    function updateStatus(selectElement) {
      const laporanId = selectElement.getAttribute('data-id');
      const newStatus = selectElement.value;
      
      {{-- 
        PETUNJUK: Setelah database terkoneksi, uncomment dan sesuaikan kode di bawah:
        
        if (confirm('Apakah Anda yakin ingin mengubah status verifikasi?')) {
          $.ajax({
            url: '{{ url("/admin/update-status") }}',
            method: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              id: laporanId,
              status_verifikasi: newStatus
            },
            success: function(response) {
              if (response.success) {
                alert('Status berhasil diupdate!');
                location.reload(); // atau update UI tanpa reload
              } else {
                alert('Gagal mengupdate status!');
                location.reload(); // reload untuk reset select
              }
            },
            error: function() {
              alert('Terjadi kesalahan saat mengupdate status!');
              location.reload();
            }
          });
        } else {
          location.reload(); // reload untuk reset select jika user cancel
        }
      --}}
      
      // Untuk sementara (static)
      alert('Status akan diupdate ke: ' + newStatus + ' (Fitur ini akan aktif setelah database terkoneksi)');
    }

    // Delete Laporan
    function deleteLaporan(id) {
      {{-- 
        PETUNJUK: Setelah database terkoneksi, uncomment dan sesuaikan kode di bawah:
        
        if (confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan!')) {
          $.ajax({
            url: '{{ url("/admin/delete") }}/' + id,
            method: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              if (response.success) {
                alert('Laporan berhasil dihapus!');
                location.reload();
              } else {
                alert('Gagal menghapus laporan!');
              }
            },
            error: function() {
              alert('Terjadi kesalahan saat menghapus laporan!');
            }
          });
        }
      --}}
      
      // Untuk sementara (static)
      if (confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan!')) {
        alert('Laporan dengan ID ' + id + ' akan dihapus (Fitur ini akan aktif setelah database terkoneksi)');
      }
    }

    // Search Functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      const table = document.getElementById('laporanTable');
      const rows = table.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    });

    // Entries Per Page
    document.getElementById('entriesPerPage').addEventListener('change', function() {
      {{-- 
        PETUNJUK: Setelah database terkoneksi, uncomment dan sesuaikan:
        
        const perPage = this.value;
        window.location.href = '{{ url("/admin") }}?per_page=' + perPage;
      --}}
      
      alert('Menampilkan ' + this.value + ' entries per page (Fitur ini akan aktif setelah database terkoneksi)');
    });
  </script>

</body>
</html>

