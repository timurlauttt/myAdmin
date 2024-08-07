<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerId = Auth::id();
        $files = File::where('customer_id', $customerId)->get();
        return view('customers.dashboard', compact('files', 'customer'));
    }
    
    public function print($id)
    {
        // Ambil file berdasarkan ID
        $file = File::findOrFail($id);
        
        // Tandai file sebagai sudah diprint
        $file->status = 'Sudah di Print';
        $file->save();

        // Simpan notifikasi
        Notification::create([
            'user_id' => Auth::id(),
            'message' => "File {$file->name} telah diprint.",
        ]);

        // Tampilkan view untuk mencetak file
        return view('files.print', compact('file'));
    }

    public function profile()
    {
        // Ambil data supir yang sedang login
        $customerId = Auth::id(); 
        $customer = Customer::findOrFail($customerId);
        return view('customers.profile', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    { 
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('customers.profile')->with('success', 'Profil berhasil diperbarui');
    }


}
