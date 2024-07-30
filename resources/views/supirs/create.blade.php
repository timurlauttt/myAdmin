@extends('layouts.app')
@section('')
@section('contents')
<h1 class="mb-0">Tambah Data Karyawan Baru</h1>
<hr />
<form action="{{ route('supirs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="name" class="form-control" placeholder="Nama" >
        </div>
        <div class="col">
            <input type="text" name="no_wa" class="form-control" placeholder="Nomor WhatsApp">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <textarea class="form-control" name="description" placeholder="Deskripsi"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>
</form>
@endsection