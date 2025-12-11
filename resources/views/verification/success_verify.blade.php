<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Berhasil</title>
</head>
<body>
    <div style="border: 1px solid blue; padding: 20px;">
        <h1>Pemilik Telah Diverifikasi!</h1>
        <p>Klaim ID: {{ $data->id }}</p>
        <p>Status sekarang: <strong style="color:green;">{{ $data->status }}</strong></p>
        <p>Silakan hubungi pemilik untuk pengembalian barang.</p>
    </div>
</body>
</html>