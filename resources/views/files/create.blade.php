{{--halaman untuk menambah/upload file baru --}}
@extends('layouts.app')
@section('contents')
<!DOCTYPE html>
<html>
<head>
    <title>Upload New File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah File Baru</h1>
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

        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File:</label>
                <input type="file" name="file" id="file" class="form-control" accept="application/pdf">
            </div>
            <div class="mb-3">
                <label for="customer_id" class="form-label">Pilih Supir:</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>                
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>
@endsection
