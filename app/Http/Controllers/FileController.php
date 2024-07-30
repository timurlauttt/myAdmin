<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;


/*
------ controller file----------------
*/
class FileController extends Controller
{
    public function index()
    {
        $files = File::orderBy('created_at', 'ASC')->get();
        return view('files.index', compact('files'));
    }

    public function create()
    {
        $customers = Customer::all(); // Ambil semua customer
        return view('files.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'customer_id' => 'required|exists:customers,id', // Validasi bahwa customer_id valid
            ]);
    
        $file = $request->file('file');
        $path = $file->store('pdf', 'public');

        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'customer_id' => $request->input('customer_id'), // Simpan customer_id dari request
            'status'=>'Belum di Print',
        ]);

        return redirect()->route('files.index')->with('success', 'File sukses ditambahkan.');
    }

    public function edit(File $file)
    {
        $customers = Customer::all(); // Ambil semua customer
        return view('files.edit', compact('file', 'customers'));
    }

    public function update(Request $request, File $file)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'id_customers' => 'required|exists:id_customers' // Validasi customer_id
        ]);

        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $fileData = $request->file('file');
        $path = $fileData->store('pdf', 'public');

        $file->update([
            'name' => $fileData->getClientOriginalName(),
            'path' => $path,
            'id_customers' => $request->id_customers, // Update customer_id
        ]);

        return redirect()->route('files.index')->with('success', 'File sukses diperbaharui.');
    }

    public function destroy(File $file)
    {
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'File sukses dihapus.');
    }

    public function show(File $file)
    {
        return view('files.show', compact('file'));
    }

    public function printFile($id)
    {
        $file = File::findOrFail($id);
        return view('files.print', compact('file'));
    }

    public function markAsPrinted($id)
    {
        $file = File::find($id);
        if ($file) {
            $file->status = 'Printed'; // Contoh perubahan status
            $file->save();
            return redirect()->route('files.index')->with('success', 'Berhasil!');
    }
        return redirect()->route('files.index')->with('error');
    }
}