<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Laporan - TelU Lost & Found</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>

  @include('partials.navbar')

  <section class="admin-header bg-danger text-white py-2">
    <div class="container">
      <p class="mb-0 text-center">Admin Dashboard - Edit Data</p>
    </div>
  </section>

  <section class="breadcrumb-section py-2 bg-white border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-decoration-none">Admin</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Laporan</li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="edit-form-section py-5 bg-light">
    <div class="container">
      
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
              <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Laporan</h4>
            </div>
            <div class="card-body p-4">
              
              <form action="{{ route('admin.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="row mb-4">
                  <div class="col-12"><h5 class="section-title mb-3 text-secondary border-bottom pb-2">Informasi Laporan</h5></div>
                  
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipe Laporan</label>
                    <select class="form-select" name="tipe_laporan">
                      <option value="Kehilangan Barang" {{ $item->tipe_laporan == 'Kehilangan Barang' ? 'selected' : '' }}>Mencari Barang</option>
                      <option value="Kehilangan Pemilik" {{ $item->tipe_laporan == 'Kehilangan Pemilik' ? 'selected' : '' }}>Menemukan Barang</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Verifikasi</label>
                    <select class="form-select" name="status_verifikasi">
                      <option value="Belum Terverifikasi">Belum Terverifikasi</option>
                      <option value="Terverifikasi">Terverifikasi</option>
                      <option value="Tertolak">Tertolak</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-12"><h5 class="section-title mb-3 text-secondary border-bottom pb-2">Data Pelapor</h5></div>
                  
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Pelapor <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $item->nama) }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">No Telp <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $item->no_telp) }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fakultas</label>
                    <input type="text" class="form-control" name="fakultas" value="{{ old('fakultas', 'FEB') }}"> 
                  </div>
                  
                   <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Program Studi</label>
                    <input type="text" class="form-control" name="program_studi" value="{{ old('program_studi', 'Manajemen') }}"> 
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-12"><h5 class="section-title mb-3 text-secondary border-bottom pb-2">Detail Barang</h5></div>
                  
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kategori Barang</label>
                    <select class="form-select" name="id_kategori">
                       @foreach($kategori as $kat)
                         <option value="{{ $kat->id }}" {{ $item->id_kategori == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                         </option>
                       @endforeach
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Lokasi Hilang/Ditemukan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lokasi" value="{{ old('lokasi', $item->lokasi) }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Status Barang</label>
                    <select class="form-select" name="status_barang">
                      <option value="Belum Ditemukan" {{ $item->status_barang == 'Belum Ditemukan' ? 'selected' : '' }}>Belum Ditemukan</option>
                      <option value="Ditemukan" {{ $item->status_barang == 'Ditemukan' ? 'selected' : '' }}>Ditemukan</option>
                    </select>
                  </div>

                  <div class="col-md-12 mb-3">
                     <label class="form-label fw-bold">Foto Barang</label>
                     @if($item->foto_barang)
                        <div class="mb-2">
                           <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="Foto Lama" class="img-thumbnail" style="height: 100px;">
                        </div>
                     @endif
                     <input type="file" class="form-control" name="foto_barang" accept="image/*">
                     <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                  </div>

                  <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="deskripsi" rows="4" required>{{ old('deskripsi', $item->deskripsi) }}</textarea>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
                  <button type="submit" class="btn btn-danger">Update Laporan</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('partials.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>