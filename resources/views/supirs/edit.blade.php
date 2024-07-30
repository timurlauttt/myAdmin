@extends('layouts.app')
@section('')
@section('contents')
<h1 class="mb-0">Edit Data Karyawan</h1>
<hr />
<form action="{{ route('supirs.update', $supir->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" placeholder="name" value="{{ $supir->name }}" >
        </div>
        <div class="col mb-3">
            <label class="form-label">Nomor WhatsApp</label>
            <input type="text" name="nomor whatsapp" class="form-control" placeholder="nomor whatsapp" value="{{ $supir->no_wa }}" >
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="description" placeholder="Descriptoin" >{{ $supir->description }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Simpan Data Karyawan</button>
        </div>
    </div>
</form>
@endsection