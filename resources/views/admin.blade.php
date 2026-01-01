<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - TelU Lost & Found</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  {{-- DataTables CSS --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <style>
    .btn-group-action .btn {
      margin-right: 5px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .dataTables_wrapper .dataTables_filter {
      float: right;
      margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length {
      float: left;
      margin-bottom: 10px;
    }
  </style>

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
          <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none"><i class="bi bi-house"></i>
              Beranda</a></li>
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
          <h2 id="titleLaporan" class="page-title mb-3">
            <i class="bi bi-clipboard-data me-2"></i>Laporan Barang
          </h2>
          <h2 id="titleFeedback" class="page-title mb-3 d-none">
            <i class="bi bi-chat-right-text me-2"></i>Feedback
          </h2>
          <div class="d-flex gap-2">
            <a href="{{ route('cari') }}" class="btn btn-primary">
              <i class="bi bi-plus-circle me-2"></i>Entri Laporan
            </a>
            <a id="btnKelolaLaporan" class="btn btn-light border d-none">
              <i class="bi bi-clipboard-data me-2"></i>Kelola Laporan
            </a>
            <a href="{{ route('kategori.index') }}" class="btn btn-light border">
              <i class="bi bi-tags me-2"></i>Kelola Kategori
            </a>
            <button id="btnKelolaFeedback" class="btn btn-light border">
              <i class="bi bi-chat-right-text me-2"></i>Kelola Saran
            </button>
          </div>

        </div>
      </div>

<!-- Tabel laporan -->
      <div class="card shadow-sm" id="laporanWrapper">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="laporanTable">
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
                @forelse($allItems as $index => $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @if($item->foto_barang)
                        <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}"
                          class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                      @else
                        <span class="text-muted small">No Image</span>
                      @endif
                    </td>
                    <td>LAP-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>
                      <span
                        class="badge {{ $item->tipe_laporan == 'Kehilangan Barang' ? 'bg-warning text-dark' : 'bg-success' }}">
                        {{ $item->tipe_laporan == 'Kehilangan Barang' ? 'Mencari Barang' : 'Menemukan Barang' }}
                      </span>
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>
                      {{-- Status Verifikasi (Simulasi logic, sesuaikan dgn DB jika ada kolom khusus) --}}
                      @php
                        $statusClass = 'bg-secondary';
                        $statusText = 'Belum Terverifikasi';
                        if ($item->status_barang == 'Ditemukan') {
                          $statusClass = 'bg-success';
                          $statusText = 'Terverifikasi';
                        } elseif ($item->status_barang == 'Ditolak') {
                          $statusClass = 'bg-danger';
                          $statusText = 'Tertolak';
                        }
                      @endphp
                      {{-- NOTE: Karena field database terbatas, saya gunakan status_barang sebagai proxy.
                      Atau bisa hardcode dropdown select seperti di gambar jika ingin fitur update status ajax --}}
                      <select class="form-select form-select-sm" style="width: 140px;">
                        <option value="Belum Terverifikasi" {{ $item->status_barang != 'Ditemukan' ? 'selected' : '' }}>
                          Belum Terverifikasi</option>
                        <option value="Terverifikasi" {{ $item->status_barang == 'Ditemukan' ? 'selected' : '' }}>
                          Terverifikasi</option>
                        <option value="Tertolak">Tertolak</option>
                      </select>
                    </td>
                    <td>
                      <div class="btn-group-action">
                        <a href="#" class="btn btn-warning btn-sm text-dark fw-bold" title="Lihat Detail">
                          <i class="bi bi-eye"></i> Detail
                        </a>

                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-primary btn-sm fw-bold"
                          title="Edit">
                          <i class="bi bi-pencil"></i> Ubah
                        </a>

                        <form action="{{ route('admin.delete', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm fw-bold" title="Hapus">
                            <i class="bi bi-trash"></i> Hapus
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  {{-- DataTables handles empty state better usually, but keep this for fallback --}}
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

<!-- tabel feedback -->
      <div class="card shadow-sm d-none" id="feedbackWrapper">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="feedbackTable">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Role</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($testimonials as $t)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nama ?? '-' }}</td>
                    <td><span class="badge bg-info">{{ $t->role ?? 'User' }}</span></td>
                    <td>{{ $t->judul }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($t->deskripsi, 50) }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d M Y') }}</td>
                    <td>
                      <div class="btn-group-action">
                          {{-- Tombol Ubah (Trigger Modal Edit) --}}
                          <button type="button" class="btn btn-primary btn-sm fw-bold btn-edit-feedback"
                            data-id="{{ $t->id }}" data-nama="{{ $t->nama }}" data-role="{{ $t->role }}"
                            data-judul="{{ $t->judul }}" data-deskripsi="{{ $t->deskripsi }}" title="Ubah">
                            <i class="bi bi-pencil"></i> Ubah
                          </button>

                          {{-- Tombol Hapus --}}
                          <form action="{{ route('testimonial.destroy', $t->id) }}" method="POST"
                            class="d-inline form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fw-bold" title="Hapus">
                              <i class="bi bi-trash"></i> Hapus
                            </button>
                          </form>
                        </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  {{-- MODAL EDIT FEEDBACK --}}
  <div class="modal fade" id="editFeedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-glass-testi p-4">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Feedback</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditFeedback" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="editNama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" name="role" id="editRole" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="editJudul" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="editDeskripsi" rows="4" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  @include('partials.footer')

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      // Initialize DataTables for Laporan
      $('#laporanTable').DataTable({
        "language": 
        {
          "search": "Search:",
          "lengthMenu": "Show _MENU_ entries",
          "info": "Showing _START_ to _END_ of _TOTAL_ entries",
          "paginate": {
            "first": "First",
            "last": "Last",
            "next": "Next",
            "previous": "Previous"
          }
        },
        "pageLength": 7, // Default view 7 items like in image
        "columnDefs": [
          { "orderable": false, "targets": [1, 8] } // Disable sorting on Foto and Aksi
        ]
      });

      let feedbackDT = null;
    $('#btnKelolaFeedback').on('click', function () {
      $('#titleLaporan').addClass('d-none');
      $('#titleFeedback').removeClass('d-none');

      $('#btnKelolaFeedback').addClass('d-none');
      $('#btnKelolaLaporan').removeClass('d-none');
      // Hide laporan
      $('#laporanWrapper').addClass('d-none');
      // Show feedback
      $('#feedbackWrapper').removeClass('d-none');
    
      // Init DataTable feedback sekali saja
      if (!feedbackDT) {
        feedbackDT = $('#feedbackTable').DataTable({
          pageLength: 5,
          language: {
            info: "Showing _START_ to _END_ of _TOTAL_ entries"
          }
        });
      }
      // Wajib agar posisi info & pagination normal
      feedbackDT.columns.adjust().draw();
    });

    // kembali ke laporan barang
    $('#btnKelolaLaporan').on('click', function () {
      $('#titleFeedback').addClass('d-none');
      $('#titleLaporan').removeClass('d-none');

      $('#btnKelolaLaporan').addClass('d-none');
      $('#btnKelolaFeedback').removeClass('d-none');

      //menampilkam laporan, sembunyikan feedback
      $('#feedbackWrapper').addClass('d-none');
      $('#laporanWrapper').removeClass('d-none');

      //4. Fix DataTable layout
      $('#laporanTable').DataTable().columns.adjust().draw();
    });

// Handle Click 'Ubah' Feedback
    $(document).on('click', '.btn-edit-feedback', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var role = $(this).data('role');
        var judul = $(this).data('judul');
        var deskripsi = $(this).data('deskripsi');

      // Set Action URL
        var url = "{{ url('/testimonial/update') }}/" + id; 
      $('#formEditFeedback').attr('action', url);

      // Populate Form
      $('#editNama').val(nama);
        $('#editRole').val(role);
        $('#editJudul').val(judul);
        $('#editDeskripsi').val(deskripsi);

      // Hide List Modal & Show Edit Modal
      $('#feedbackModal').modal('hide');
      $('#editFeedbackModal').modal('show');
    });
  });

  $(document).on('submit', '.form-delete', function (e) {
    e.preventDefault(); // STOP submit default
    let form = this;
    Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: 'ingin menghapus data ini!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'YA, HAPUS!',
        cancelButtonText: 'TIDAK',
        confirmButtonColor: '#7367F0',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); // submit asli Laravel
        }
    });
  });
  </script>

  @if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      timer: 2500,
      showConfirmButton: false
  });
</script>
@endif
</body>
</html>