<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


/*
------ controller autentikasi customer/supir----------------
*/
class CustomerAuthController extends Controller
{
    public function register()
    {
        return view('auth.customer.register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:customers,username',
            'email' => 'required|email|unique:customers,email',
            'wa_number' => 'required|unique:customers,wa_number',
            'password' => 'required|confirmed',
        ])->validate();

        Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'wa_number' => $request->wa_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.login');
    }

    public function login()
    {
        return view('auth.customer.login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::guard('customer')->attempt([$field => $login, 'password' => $password], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('customers.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login');
    }

    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();
        $files = $customer->files; // Mengambil file berdasarkan relasi

        return view('customers.dashboard', compact('customer', 'files'));
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
