<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


/*
------ controller autentikasi user/admin----------------
*/
class AuthController extends Controller
{
    // nampilin register admin
    public function showAdminRegisterForm()
    {
        return view('auth/admin/register');
    }

    // nyimpen data register admin
    public function registerAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed'
        ])->validate();
        
        User::create([
            'name'   =>   $request->name,
            'email'  =>  $request->email,
            'phone'  =>   $request->phone,
            'address'=> $request->address,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('admin.login');
    }

    // nampilin form login admin
    public function showAdminLoginForm()
    {
        return view('auth/admin/login');
    }

    // buat login admin
    public function loginAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard'); // Sesuaikan dengan route dashboard Anda
    }

    // buat logout admin
    public function logoutAdmin(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // nampilin halaman profile
    public function profile()
    {
        return view('profile.index');
    }
    
    public function editProfile()
    {
        return view('profile.edit');
    }   

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        // Simpan perubahan
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui');
    }
}
/*
------ controller autentikasi user/admin----------------
*/