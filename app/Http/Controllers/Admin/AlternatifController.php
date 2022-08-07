<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Rekomendasi;
use App\Imports\AlternatifImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Siswa';
        $dataalternatif = Alternatif::get();
        $datarekomendasi = Rekomendasi::get();
        return view('admin.alternatif.index', compact('dataalternatif','pagename', 'datarekomendasi'));
    }

    public function import_excel(Request $request)
    {
        Excel::import(new AlternatifImport, $request->file('file'));
        return redirect()->back();
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
            'nama_alternatif' => 'required|string|max:191'
        ]);

        try {
            $alternatif = new Alternatif();
            $alternatif->nama_alternatif = $request->nama_alternatif;
            $alternatif->save();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pagename = 'Alternatif';
        $alternatif = Alternatif::findOrFail($id);
        return view('admin.alternatif.edit', compact('alternatif','pagename'));
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
        $this->validate($request, [
            'nama_alternatif' => 'required|string|max:191',
            'nisn' => 'required|numeric',
        ]);

        try {
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->nama_alternatif = $request->nama_alternatif;
            $alternatif->nisn = $request->nisn;
            $alternatif->save();
            return back()->with('msg', 'Data berhasil diubah');
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
        //
        try {
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->delete();
            return back()->with('msg', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
    }
}
