<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Crips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Kriteria;
use Carbon\Exceptions\Exception;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $pagename = 'Kriteria';
        $dataKriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        return view('admin.kriteria.index', compact('dataKriteria','pagename'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nama_kriteria' => 'required|string|max:191',
            'attribut' => 'required|string|max:191',
            'bobot' => 'required|numeric'
        ]);

        try {
            $kriteria = new Kriteria();
            $kriteria->nama_kriteria = $request->nama_kriteria;
            $kriteria->attribut = $request->attribut;
            $kriteria->bobot = $request->bobot;
            $kriteria->save();
            return back()->with('msgt', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
         }

    public function edit($id)
    {
        $pagename = 'Kriteria';
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit', compact('kriteria','pagename'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kriteria' => 'required|string|max:191',
            'attribut' => 'required|string|max:191',
            'bobot' => 'required|numeric'
        ]);

        try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'attribut' => $request->attribut,
                'bobot' => $request->bobot
            ]);
            return back()->with('msg', 'Data berhasil diubah');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
            }
        }


    public function destroy($id)
    {
       try {
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            return back()->with('msg', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            die("Gagal melakukan proses");
        }
    }

    public function show($id)
    {
        //
        $crips = Crips::where('kriteria_id', $id)->get();
        $kriteria = Kriteria::findOrFail($id);  
        return view('admin.kriteria.show', compact('crips', 'kriteria'));
    }
}