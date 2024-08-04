{{--halaman utama untuk menampilkan seluruh data karyawan --}}
@extends('layouts.app')
@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Data Karyawan</h1>
    <a href="{{ route('supirs.create') }}" class="btn btn-primary">Tambah Karyawan Baru</a>
</div>
<hr/>
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Nomor WhatsApp</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if($supir->count() > 0)
        @foreach($supir as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->name }}</td>
            <td class="align-middle">{{ $rs->no_wa }}</td>
            <td class="align-middle">{{ $rs->description }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('supirs.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                    <a href="{{ route('supirs.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('supirs.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Hapus data?')">
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
            <td class="text-center" colspan="5">Tidak ada data karyawan</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection