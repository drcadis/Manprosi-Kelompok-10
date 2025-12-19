@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Kategori</h4>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kat)
                        <tr>
                            <td>{{ $loop->iteration + ($kategoris->currentPage()-1) * $kategoris->perPage() }}</td>
                            <td>{{ $kat->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $kategoris->links() }}
        </div>
    </div>
</div>
@endsection
