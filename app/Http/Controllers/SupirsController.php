<?php

namespace App\Http\Controllers;

use App\Models\supir;
use Illuminate\Http\Request;


/*
------ controller data karyawan ----------------
*/
class SupirsController extends Controller
{

    public function index()
    {
        $supir = supir::orderBy('created_at', 'ASC')->get();
        
        return view('supirs.index', compact('supir'));
    }

    public function create()
    {
        return view('supirs.create');
    }
   
    public function store(Request $request)
    {
        supir::create($request->all());
        return redirect()->route('supirs')->with('success','Data berhasil ditambahkan');
    }

    
    public function show($id)
    {
        $supir = supir::findOrFail($id);
        return view('supirs.show', compact('supir'));
    }

    public function edit($id)
    {
        $supir = supir::findOrFail($id);
        return view('supirs.edit', compact('supir'));
    }

    public function update(Request $request, string $id)
    {
        $supir = supir::findOrFail($id);
  
        $supir->update($request->all());
  
        return redirect()->route('supirs.index')->with('success', 'data berhasil diubah');
    }

    public function destroy(string $id)
    {
        $supir = supir::findOrFail($id);
  
        $supir->delete();
  
        return redirect()->route('supirs')->with('success', 'data berhasil dihapus');
    }
}
/*
------ controller data karyawan ---------------
*/