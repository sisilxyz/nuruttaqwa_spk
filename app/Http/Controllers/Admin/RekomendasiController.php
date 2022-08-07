<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekomendasi = Rekomendasi::all();
        dd($rekomendasi);
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
        $this->validate($request, [
            'nama_rekomendasi' => 'required|string|max:191'
        ]);

        try {
            $rekomendasi = new Rekomendasi();
            $rekomendasi->nama_rekomendasi = $request->nama_rekomendasi;
            $rekomendasi->save();
            return back()->with('msgtrekomendasi', 'Data berhasil ditambahkan');
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
        $pagename = 'Rekomendasi';
        $rekomendasi = Rekomendasi::findOrFail($id);
        return view('admin.rekomendasi.edit', compact('rekomendasi','pagename'));
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
        $this->validate($request, [
            'nama_rekomendasi' => 'required|string|max:191',
        ]);

        try {
            $rekomendasi = Rekomendasi::findOrFail($id);
            $rekomendasi->nama_rekomendasi = $request->nama_rekomendasi;
            $rekomendasi->save();
            return back()->with('msgrekomendasi', 'Data berhasil diubah');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $rekomendasi = Rekomendasi::findOrFail($id);
            $rekomendasi->delete();
            return back()->with('msgrekomendasi', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
    }
}
