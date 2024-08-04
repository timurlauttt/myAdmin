<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;


/*
------ controller untuk nampilin semua data customer/supir di halaman user/admin ----------------
*/
class SupirController extends Controller
{
    public function index()
    {
        $supirs = Customer::all(); // Ambil semua data customer
        return view('customers.index', compact('supirs'));
    }

}
