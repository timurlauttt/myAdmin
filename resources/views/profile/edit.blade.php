{{--halaman edit profile admin --}}
@extends('layouts.app')
@section('contents')
<h2 class="mb-0">Edit Profil Admin</h2>
<hr />
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Pengaturan Profil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">No.Telp</label>
                        <input type="text" name="phone" class="form-control" placeholder="phone" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Alamat</label>
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="address">
                    </div>
                </div>
                <div class="mt-5">
                    <button class="btn btn-primary profile-button" type="submit">Simpan Profil</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
