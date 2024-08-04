{{--halaman untuk melihat detail file --}}
@extends('layouts.app')
@section('contents')
<!DOCTYPE html>
<html>
<head>
    <title>File Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail File</h1>
        <div class="mb-3">
            <label class="form-label"><strong>Nama:</strong></label>
            <input type="text" class="form-control" value="{{ $file->name }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Path:</strong></label>
            <input type="text" class="form-control" value="{{ $file->path }}" readonly>
        </div>

        <div class="mb-3">
            <a href="{{ Storage::url($file->path) }}" class="btn btn-primary" target="_blank">Buka PDF</a>
        </div>
        <div class="mb-3">
            <a href="{{ route('files.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>
@endsection