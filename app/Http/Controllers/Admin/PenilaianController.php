<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Penilaian;
use App\Models\Kriteria;
use DB;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria')->get();
       //return response()->json($alternatif);
        return view('admin.penilaian.index', compact('alternatif', 'kriteria'));
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
        //return response()->json($request);
        //$alternatif = count($request->crips_id);
        try {
            DB::select("TRUNCATE penilaian");
            foreach($request->crips_id as $key => $value){
                foreach($value as $key_1 => $value_1){
                    Penilaian::create([
                        'alternatif_id' => $key,
                        'crips_id' => $value_1
                    ]);
                }
            }

          return back()->with('msg', 'Berhasil disimpan');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //s
        
    }
}
