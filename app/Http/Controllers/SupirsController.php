<?php

namespace App\Http\Controllers;

use App\Models\supir;
use Illuminate\Http\Request;


/*
------ controller data customer/supir pake lib.storage----------------
*/
class SupirsController extends Controller
{
    /* nampilin semua file yang udah di upload/ halaman index/utama files.
     */
    public function index()
    {
        $supir = supir::orderBy('created_at', 'ASC')->get();
  
        return view('supirs.index', compact('supir'));
    }

    /* bikin/upload file baru
     */
    public function create()
    {
        return view('supirs.create');
    }

   
   
    public function store(Request $request)
    {
        supir::create($request->all());
        return redirect()->route('supirs')->with('success','Data addedd successfully');
    }

    
    public function show($id)
    {
        $supir = supir::findOrFail($id);
        return view('supirs.show', compact('supir'));
    }

    /*edit file yang ada/yang udah di upload
     */
    public function edit($id)
    {
        $supir = supir::findOrFail($id);
        return view('supirs.edit', compact('supir'));
    }

    /*update/mengganti file yang sudah di upload
     */
    public function update(Request $request, string $id)
    {
        $supir = supir::findOrFail($id);
  
        $supir->update($request->all());
  
        return redirect()->route('supirs')->with('success', 'data updated successfully');
    }

    /**
     * hapus file yang udah di upload
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $supir = supir::findOrFail($id);
  
        $supir->delete();
  
        return redirect()->route('supirs')->with('success', 'data deleted successfully');
    }
}
/*
------ controller data customer/supir pake lib.storage----------------
*/