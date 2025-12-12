<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Barang Hilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-item {
            transition: transform 0.3s ease;
        }
        .card-item:hover {
            transform: translateY(-5px);
        }
        .filter-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Daftar Barang Hilang</h2>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form action="{{ route('lihat.barang') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <label for="lokasi" class="form-label fw-bold">Filter Lokasi</label>
                <select name="lokasi" id="lokasi" class="form-select">
                    <option value="">-- Semua Lokasi --</option>
                    @forelse($daftarLokasi as $loc)
                        <option value="{{ $loc }}" @if(request('lokasi') == $loc) selected @endif>
                            {{ $loc }}
                        </option>
                    @empty
                        <option value="" disabled>Tidak ada lokasi tersedia</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-6">
                <label for="kategori" class="form-label fw-bold">Filter Kategori</label>
                <select name="kategori" id="kategori" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @forelse($daftarKategori as $kat)
                        <option value="{{ $kat }}" @if(request('kategori') == $kat) selected @endif>
                            {{ $kat }}
                        </option>
                    @empty
                        <option value="" disabled>Tidak ada kategori tersedia</option>
                    @endforelse
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('lihat.barang') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Items Section -->
    <div class="row">
        @forelse($barangHilang as $barang)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card card-item h-100 shadow-sm">
                    @if($barang->foto_barang)
                        <img src="{{ asset('storage/' . $barang->foto_barang) }}" class="card-img-top" alt="{{ $barang->nama_barang }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                        <p class="card-text text-muted">
                            <small><strong>Lokasi:</strong> {{ $barang->lokasi }}</small><br>
                            <small><strong>Kategori:</strong> {{ $barang->kategori ?? '-' }}</small><br>
                            <small><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($barang->tanggal)->format('d/m/Y') }}</small>
                        </p>
                        <a href="{{ route('lihat.barang.detail', $barang->id) }}" class="btn btn-sm btn-danger">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    Tidak ada barang hilang yang sesuai dengan filter.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($barangHilang->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $barangHilang->links() }}
            </div>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
