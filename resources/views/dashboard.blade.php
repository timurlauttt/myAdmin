{{--halaman dashboard utama pada halaman milik admin --}}
@extends('layouts.app')
@section('title', 'Dashboard Utama')
@section('contents')
<div class="container mt-4">
    <div class="row">
        <!-- File yang Sudah Diprint -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('files.index') }}" class="text-white link-hover-underline">
                        <h4 class="mb-0">File yang Sudah di Print</h4>
                    </a>
                    <span class="badge bg-light text-primary">{{ $printedFiles->count() }} Files</span>
                </div>
                <div class="card-body">
                    @if($printedFiles->count() > 0)
                        <ul class="list-group">
                            @foreach($printedFiles as $file)
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <h6 class="mb-0">{{ $file->name }}</h6>
                                            <small class="text-muted">{{ $file->updated_at->format('d M Y, H:i') }}</small>
                                            <small class="text-muted">Supir: {{ $file->customer->name }}</small>
                                        </div>
                                        <i class="fas fa-check-circle text-success ms-3"></i> <!-- Ceklis -->
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada file yang sudah di print.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- File yang Belum Diprint -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('files.index') }}" class="text-white link-hover-underline">
                        <h4 class="mb-0">File yang Belum di Print</h4>
                    </a>
                    <span class="badge bg-light text-danger">{{ $unprintedFiles->count() }} Files</span>
                </div>
                <div class="card-body">
                    @if($unprintedFiles->count() > 0)
                        <ul class="list-group">
                            @foreach($unprintedFiles as $file)
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <h6 class="mb-0">{{ $file->name }}</h6>
                                            <small class="text-muted">{{ $file->created_at->format('d M Y, H:i') }}</small>
                                            <small class="text-muted">Supir: {{ $file->customer->name }}</small>
                                        </div>
                                        <i class="fas fa-times-circle text-danger ms-3"></i> <!-- Silang -->
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada file yang belum di print.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data Customer (Supir) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('customers.index') }}" class="text-white link-hover-underline">
                        <h4 class="mb-0">Data Supir</h4>
                    </a>
                    <span class="badge bg-light text-success">{{ $customers->count() }} Supir</span>
                </div>
                <div class="card-body">
                    @if($customers->count() > 0)
                        <ul class="list-group">
                            @foreach($customers as $customer)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $customer->name }}</h6>
                                        <small class="text-muted">{{ $customer->email }}</small>
                                    </div>
                                    <span class="badge" style="background-color: #ffffff; color: #000000;">{{ $customer->wa_number }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada data supir.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data Karyawan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('supirs.index') }}" class="text-dark link-hover-underline">
                        <h4 class="mb-0 text-white">Data Karyawan</h4> <!-- Menambahkan kelas text-white -->
                    </a>
                    <span class="badge bg-light text-warning">{{ $supirs->count() }} Karyawan</span>
                </div>
                <div class="card-body">
                    @if($supirs->count() > 0)
                        <ul class="list-group">
                            @foreach($supirs as $supir)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $supir->name }}</h6>
                                        <small class="text-muted">{{ $supir->description }}</small>
                                    </div>
                                    <span class="badge" style="background-color: #ffffff; color: #000000;">{{ $supir->no_wa }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada data karyawan.</p>
                    @endif
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection
