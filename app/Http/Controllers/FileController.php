<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

/*
------ controller files ----------------
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
            'status' => 'Belum di Print',
        ]);

        return redirect()->route('files.index')->with('success', 'File sukses ditambahkan.');
    }

    public function edit(File $file)
    {
        $customers = Customer::all(); // Ambil semua customer
        return view('files.edit', compact('file', 'customers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = File::findOrFail($id);

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $filename = time() . '_' . $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->storeAs('public/files', $filename);

            // Update file record in the database
            $file->path = $path;
            $file->name = $filename;
            $file->save();

            return redirect()->route('files.index')->with('success', 'File updated successfully.');
        }

        return redirect()->route('files.edit', $file->id)->withErrors(['file' => 'File upload failed.']);
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


    public function print($id)
    {
        // Ambil file berdasarkan ID
        $file = File::findOrFail($id);
        
        // Tandai file sebagai sudah diprint
        $file->status = 'Sudah di Print';
        $file->save();

        // Tampilkan view untuk mencetak file
        return view('files.print', compact('file'));
    }

}
