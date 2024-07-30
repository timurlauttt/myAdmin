@extends('layouts.app') 
@section('contents')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="mb-0">List File</h1>
        <a href="{{ route('files.create') }}" class="btn btn-primary">Tambah File Baru</a>
    </div>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Id File</th>
                <th>Nama</th>
                <th>Id Supir</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($files->count() > 0)
            @foreach ($files as $file)
            <tr>
                <td class="align-middle">{{ $file->id }}</td>
                <td class="align-middle">{{ $file->name }}</td>
                <td class="align-middle">{{ $file->customer_id }}</td>
                <td class="align-middle">{{ $file->status }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group">
                        <a href="{{ route('files.show', $file->id) }}" class="btn btn-secondary">Detail</a>
                        <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger m-0">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">File kosong</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
