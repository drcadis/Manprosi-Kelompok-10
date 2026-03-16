<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - TelU Lost & Found</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>

  @include('partials.navbar')

  <section class="admin-header bg-danger text-white py-2">
    <div class="container">
      <p class="mb-0 text-center">Dashboard Admin - Kelola Barang Hilang & Ditemukan</p>
    </div>
  </section>

  <section class="breadcrumb-section py-2 bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="bi bi-house"></i> Beranda</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="admin-content py-4 bg-light">
    <div class="container">
      
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="row align-items-center mb-4">
        <div class="col-md-6">
          <h2 class="page-title mb-3">
            <i class="bi bi-clipboard-data me-2"></i>Laporan Barang
          </h2>
          <div class="d-flex gap-2">
            <a href="{{ route('cari') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Entri Laporan
            </a>

            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-tags me-2"></i>Kelola Kategori
            </a>
        </div>
        <div class="col-md-6 text-md-end">
          <div class="d-flex align-items-center justify-content-md-end gap-3">
            <div class="search-box">
              <label class="mb-0 me-2">Cari:</label>
              <input type="text" class="form-control form-control-sm d-inline-block" id="searchInput" style="width: 200px;" placeholder="Cari nama barang...">
            </div>
          </div>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="laporanTable">
              <thead class="table-light">
                <tr>
                  <th>No.</th>
                  <th>Foto</th>
                  <th>ID Laporan</th>
                  <th>Tipe</th>
                  <th>Nama Pelapor</th>
                  <th>Nama Barang</th>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              {{-- LOOP DATA DINAMIS DARI DATABASE --}}
              @forelse($allItems as $index => $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    @if($item->foto_barang)
                      <img src="{{ asset('storage/' . $item->foto_barang) }}" 
                          alt="{{ $item->nama_barang }}" 
                          class="table-photo" 
                          style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @else
                      <span class="text-muted small">No Image</span>
                    @endif
                  </td>
                  <td>LAP-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                  <td>
                    <span class="badge {{ $item->tipe_laporan == 'Kehilangan Barang' ? 'bg-warning text-dark' : 'bg-success' }}">
                      {{ $item->tipe_laporan }}
                    </span>
                  </td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nama_barang }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                  <td>
                      <span class="badge {{ $item->status_barang == 'Ditemukan' ? 'bg-success' : 'bg-danger' }}">
                          {{ $item->status_barang }}
                      </span>
                  </td>
                  <td>
                    <div class="d-flex gap-1">
                        <a href="#" class="btn btn-warning btn-sm text-white" title="Lihat Detail">
                          <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center py-5">
                    <div class="text-muted">
                      <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                      Belum ada data laporan yang masuk.
                    </div>
                  </td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row mt-3">
        <div class="col-md-6">
            <p class="text-muted mb-0 small">
                Total Data: {{ $allItems->count() }} Laporan
            </p>
        </div>
      </div>

    </div>
  </section>

  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      const table = document.getElementById('laporanTable');
      const rows = table.getElementsByTagName('tr');

      // Mulai dari 1 untuk melewati baris header
      for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        // Gabungkan teks dari semua sel di baris tersebut untuk pencarian luas
        const text = row.textContent.toLowerCase();
        
        if (text.includes(searchTerm)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      }
    });
  </script>

</body>
</html>