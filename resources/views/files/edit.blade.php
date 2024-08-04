{{--halaman untuk edit/ganti file yang udah di upload --}}
@extends('layouts.app')
@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Edit File</h1>
    <hr />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="file" class="form-label">Pilih File:</label>
            <input type="file" name="file" id="file" class="form-control" accept="application/pdf">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-warning">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
        </div>
    </form>
</div>
@endsection
