@extends('layouts.app')

@section('contents')
    <div class="container mt-5">
        <h1 class="mb-4">Hasil pencarian untuk : "{{ $query }}"</h1>

        <!-- user/admin -->
        @if($users->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <h3><a href="{{ route('profile.index') }}">Admin</a></h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- customer/supir -->
        @if($customers->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <h3><a href="{{ route('customers.index') }}">Supir</a></h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->wa_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- supir/karyawan -->
        @if($supirs->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <h3><a href="{{ route('supirs.index') }}">Karyawan</a></h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supirs as $supir)
                                <tr>
                                    <td>{{ $supir->name }}</td>
                                    <td>{{ $supir->no_wa }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- files -->
        @if($files->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <h3><a href="{{ route('files.index') }}">Files</a></h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>ID Supir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->name }}</td>
                                    <td>{{ $file->customer_id }}</td>
                                    <td>{{ $file->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($users->isEmpty() && $customers->isEmpty() && $supirs->isEmpty() && $files->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada hasil untuk "{{ $query }}"
            </div>
        @endif
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
    </div>
@endsection
