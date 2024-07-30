<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Controllers\CustomerAuthController;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerId=Auth::customers()->id;
        $files=File::where('customer_id', $customerId)->get();
        return view('customers.dashboard', compact('files', 'customer'));

    }
    
    public function print()
    {
        $files = File::all();
        return print('id');
    }

    public function markAsPrinted($id)
    {   
        $file = File::findOrFail($id);
        $file->status = 'Sudah Diprint';
        $file->save();

    return redirect()->route('customer.dashboard')->with('success', 'File berhasil di print.');
    }

    public function print2($id)
    {
        $file = File::findOrFail($id);
        $file->status = 'Sudah Diprint';
        $file->save();
        $files = File::all();
        return print('id');
    }
}
