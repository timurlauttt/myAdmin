{{--index untuk menampilkan seluruh data supir di halaman admin  --}}
@extends('layouts.app')
@section('contents')
<div class="container mt-5">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1 class="mb-0">Data Supir</h1>
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID Supir</th>
                <th>Nama</th>
                <th>Nomor WhatsApp</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @if($supirs->count() > 0)
                @foreach($supirs as $supir)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $supir->name }}</td>
                        <td class="align-middle">{{ $supir->wa_number }}</td>
                        <td class="align-middle">{{ $supir->email }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="3">Tidak ada data supir</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
