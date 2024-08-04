<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Controllers\CustomerAuthController;
use Illuminate\Support\Facades\Auth;


/*
------ controller untuk dashboard customer/supir ----------------
*/
class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customerId=Auth::customers()->id;
        $files=File::where('customer_id', $customerId)->get();
        return view('customers.dashboard', compact('files', 'customer'));

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
