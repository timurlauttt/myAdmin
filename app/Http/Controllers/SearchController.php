<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Supir;
use App\Models\File;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Validasi input pencarian
        $validatedData = $request->validate([
            'query' => 'required|string|min:1',
        ]);
        
        // Melakukan pencarian di semua model

        // pencarian user/admin
        $users = User::where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->get();

        // pencarian customer/supir
        $customers = Customer::where('name', 'like', "%{$query}%")
                            ->orWhere('username', 'like', "%{$query}%")
                            ->orWhere('wa_number', 'like', "%{$query}%")
                            ->get();

        // pencarian supir/karyawan
        $supirs = Supir::where('name', 'like', "%{$query}%")
                       ->orWhere('no_wa', 'like', "%{$query}%")
                       ->orWhere('description', 'like', "%{$query}%")
                       ->get();

        // pencarian file
        $files = File::where('name', 'like', "%{$query}%")
                    ->orWhere('status', 'like', "%{$query}%")
                    ->get();

        // Mengembalikan hasil pencarian ke tampilan
        return view('search.results', [
            'query' => $query,
            'users' => $users,
            'customers' => $customers,
            'supirs' => $supirs,
            'files' => $files
        ]);
    }
}
