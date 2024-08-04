<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Customer;
use App\Models\Supir;


/*
------ controller untuk dashboard user/admin ----------------
*/
class DashboardUtamaController extends Controller
{
    public function index()
    {
        // Mengambil data file yang sudah di print
        $printedFiles = File::where('status', 'Sudah di Print')->get();

        // Ambil file dengan status 'unprinted'
        $unprintedFiles = File::where('status', 'Belum di Print')->get(); 
        
        // Mengambil semua data customer (supir)
        $customers = Customer::all();
        
        // Mengambil semua data karyawan (supir)
        $supirs = Supir::all();

        // Mengirim data ke view
        return view('dashboard', compact('printedFiles', 'unprintedFiles', 'customers', 'supirs'));
    }
}
