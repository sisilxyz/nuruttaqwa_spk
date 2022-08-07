<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Crips;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class CripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama_crips' => 'required|string|max:191',
            'bobot' => 'required|numeric'
        ]);

        try {
            $crips = new Crips();
            $crips->kriteria_id = $request->kriteria_id;
            $crips->nama_crips = $request->nama_crips;
            $crips->bobot = $request->bobot;
            $crips->save();
            return back()->with('msgt', 'Data berhasil ditambahkan');
            
            } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $crips = Crips::findOrFail($id);
        return view('admin.crips.edit', compact('crips'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $crips = Crips::findOrFail($id);
        try {
            $crips->update([
                'nama_crips' => $request->nama_crips,
                'bobot' => $request->bobot
            ]);
            return back()->with('msg', 'Data berhasil diubah');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
        }
    }

    /** m
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $crips = Crips::findOrFail($id);
        try {
            $crips->delete();
            return back()->with('msg', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
        }
    }
}
