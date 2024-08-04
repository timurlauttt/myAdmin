{{--halaman untuk melihat detail data karyawan --}}
@extends('layouts.app')
@section('')
@section('contents')
<h1 class="mb-0">Detail Data Karyawan</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $supir->name }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Nomor WhatsApp</label>
        <input type="text" name="nomor whatsapp" class="form-control" placeholder="Nomor WhatsApp" value="{{ $supir->no_wa}}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea class="form-control" name="description" placeholder="Descriptoin" readonly>{{ $supir->description }}</textarea>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Dibuat pada</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $supir->created_at }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Terakhir diubah pada</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $supir->updated_at }}" readonly>
    </div>
</div>
<button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
@endsection