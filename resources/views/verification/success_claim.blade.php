<!DOCTYPE html>
<html>
<head>
    <title>Klaim Berhasil</title>
</head>
<body>
    <div style="border: 1px solid green; padding: 20px;">
        <h1>Pengajuan Verifikasi Berhasil!</h1>
        <p>Anda telah mengklaim barang dengan ID: {{ $data->item_id }}</p>
        <p>Bukti: {{ $data->proof_description }}</p>
        <p>Status saat ini: <strong>{{ $data->status }}</strong></p>
    </div>
</body>
</html>