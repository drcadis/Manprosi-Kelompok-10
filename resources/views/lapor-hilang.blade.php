<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Barang Hilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Form Lapor Barang Hilang</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="YTTA AJA" value="{{ old('nama_barang') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Terakhir</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="GOOOFYYYY AHHH KSI" value="{{ old('lokasi') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Kehilangan</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Barang</label>
                            <input type="file" name="foto_barang" class="form-control" accept="image/*" required>
                            <div class="form-text">Upload foto barang asli atau referensi. Max 2MB.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Kirim Laporan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>