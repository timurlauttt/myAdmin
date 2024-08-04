{{--halaman index profil admin --}}
@extends('layouts.app')
@section('contents')
<h2 class="mb-0 text-2xl font-bold">Profil Admin</h2>
<hr class="my-4"/>
@if (session('success'))
    <div class="alert alert-success mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif
<form method="POST" enctype="multipart/form-data" id="profile_setup_frm">
    @csrf
    <div class="row">
        <div class="col-md-12 border-r border-gray-300">
            <div class="p-3 py-5">
                <div class="d-flex justify-between items-center mb-3">
                    <h4 class="text-lg font-semibold">Pengaturan Profil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" class="form-control bg-gray-200 border border-gray-300 rounded-md p-2 w-full" placeholder="Nama" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" name="email" id="email" class="form-control bg-gray-200 border border-gray-300 rounded-md p-2 w-full" value="{{ auth()->user()->email }}" placeholder="Email" readonly>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">No.Telp</label>
                        <input type="text" name="phone" id="phone" class="form-control bg-gray-200 border border-gray-300 rounded-md p-2 w-full" placeholder="Nomor Telepon" value="{{ auth()->user()->phone }}" readonly>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="address" id="address" class="form-control bg-gray-200 border border-gray-300 rounded-md p-2 w-full" value="{{ auth()->user()->address }}" placeholder="Alamat" readonly>
                    </div>
                </div>
                <!-- Menyelaraskan tombol edit profil ke bawah dengan padding tambahan -->
                <div class="mt-4 flex justify-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary profile-button text-white bg-blue-500 hover:bg-blue-600 rounded-md py-2 px-4">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
