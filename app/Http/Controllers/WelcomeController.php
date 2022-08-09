<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Crips;
use App\Models\Kriteria;
use App\Models\Rekomendasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index()
    {
        // $test = Alternatif::all();
        // dd($test);
        // die;
        return view('welcome');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Rekomendasi::where('nisn', $request->nisn)
                ->get();
            $data2 = Alternatif::where('nisn', $request->nisn)
            ->get();
            $output = '';

            if (count($data2) != 0 && count($data) > 0) { 
                $output .= 'Siswa telah mendapatkan rekomendasi';
            }
            else if (count($data2) != 0 && count($data) == 0) { 
                $output .= 'Siswa belum mendapatkan rekomendasi';
                session()->put('newdata', $data2);
            }
            else{
                $output .= 'Siswa tidak terdaftar';
            }

            return $output;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $a = $request->nisn;
        $data2 = Alternatif::where('nisn', $request->nisn)
            ->get();
        // dd($data2[0]['nama_alternatif']);

        // $b = session('newdata');
        // dd($b);
        // $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria')->get();
        return view('pertanyaan', compact('a', 'kriteria', 'data2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getData = $request->all();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria')->get();
        // dd($crips);

        $data['siswa'] = array(
            'nisn' => $request->nisn,
            'nama' => $request->nama,
        );
        foreach($request->crips as $key => $value){
            $data['getnilai'][$key] = $value;
        }
        $data['setnilai'][0][] = $data['getnilai'][0];
        $data['setnilai'][1][] = $data['getnilai'][1];
        $data['setnilai'][2][] = $data['getnilai'][2];
        $data['setnilai'][3][] = $data['getnilai'][3];
        $data['setnilai'][4][] = $data['getnilai'][4];
        $data['setnilai'][5][] = $data['getnilai'][5];
        $data['jawaban']['tkj'] = array(
            floatval($request->q1),
            floatval($request->q5),
            floatval($request->q9),
            floatval($request->q13),
            floatval($request->q18),
        );
        $data['jawaban']['akutansi'] = array(
            floatval($request->q2),
            floatval($request->q6),
            floatval($request->q10),
            floatval($request->q14),
            floatval($request->q17),
            floatval($request->q19),
        );
        $data['jawaban']['tbsm'] = array(
            floatval($request->q3),
            floatval($request->q7),
            floatval($request->q11),
            floatval($request->q15),
        );
        $data['jawaban']['tkr'] = array(
            floatval($request->q4),
            floatval($request->q8),
            floatval($request->q12),
            floatval($request->q16),
            floatval($request->q20),
        );

        $data['r'] = array(
            'TKJ' => array_sum($data['jawaban']['tkj']) / 5,
            'Akuntansi' => array_sum($data['jawaban']['akutansi']) / 6,
            'TBSM' => array_sum($data['jawaban']['tbsm']) / 4,
            'TKR' => array_sum($data['jawaban']['tkr']) / 5,
        );

        foreach($data['getnilai'] as $key => $value){
            $crips[$key] = Crips::where('id', $value)->get();
        }
        
        foreach($crips as $key => $value){
            $nilai[$key] = $value[0]['bobot'];
        }

        // dd($nilai);

        $normalisasi = [];
        $b = 0;
       //mencari min max
       foreach ($kriteria as $key => $value) {
            foreach ($crips as $key_1 => $value_1) {
                $a[$key_1] = $value_1[0]; 
                if( $value->id == $a[$key_1]->kriteria_id) {
                    if ($value->attribut == 'benefit'){
                        $minMax[$key]['bobot'] = $a[$key_1]->bobot;
                        $minMax[$key]['kriteria_id'] = $a[$key_1]->kriteria_id;
                    }elseif($value->attribut == 'cost') {
                        $minMax[$key]['bobot'] = $a[$key_1]->bobot;
                        $minMax[$key]['kriteria_id'] = $a[$key_1]->kriteria_id;
                    }   
                }
            }
        }

        // dd($minMax);

        $b = [];
       //normalisasi
       foreach ($minMax as $key_1 => $value_1) {
           foreach ($kriteria as $key => $value) {
                $b[$key] = $value->id;
                $c[$key_1] = $value_1['kriteria_id'];
                if ($value->id == $value_1['kriteria_id']) {
                    if ($value->attribut == 'benefit') {
                        $normalisasi[$value['id']] = $value['bobot'] / $minMax[$key]['bobot'];
                    }elseif($value->attribut == 'cost'){
                        $normalisasi[$value['id']] = min($minMax[$value->id]) / $value_1['bobot'];
                    }
                }
            }
        }

        $data['rekomendasi'] = array(
            'TKJ' => round(($data['r']['TKJ'] + (($normalisasi[8] + $normalisasi[1] + $normalisasi[6]) / 3)) / 2, 2),
            'Akuntansi' => round(($data['r']['Akuntansi'] + (($normalisasi[1] + $normalisasi[4] + $normalisasi[5]) / 3)) / 2, 2),
            'TBSM' => round(($data['r']['TBSM'] + (($normalisasi[1] + $normalisasi[4] + $normalisasi[6]) / 3)) / 2 ,2),
            'TKR' => round(($data['r']['TKR'] + (($normalisasi[8] + $normalisasi[3] + $normalisasi[4]) / 3)) / 2, 2),
        );

        arsort($data['rekomendasi']);
        // dd($data['rekomendasi']);
        $m=0;$n=0;
        foreach($data['rekomendasi'] as $key => $value){
            $data['rekomendasi1'][$m] = $value;
            $data['rekomendasi2'][$n] = $key;
            $m++;$n++;  
        }


        // $data['rekomendasisave'] = array($data['rekoemndasi2'][0], $data['rekomendasi2'][1]);

        // dd($data['rekomendasi1'], $data['rekomendasi2']);
        
        $data['hasil'] = max($data['rekomendasi']);

        if($data['rekomendasi']['TKJ'] == $data['hasil']){
            $data['final'] = 'TKJ';
        }else if($data['rekomendasi']['Akuntansi'] == $data['hasil']){
            $data['final'] = 'Akuntansi';
        }else if($data['rekomendasi']['TBSM'] == $data['hasil']){
            $data['final'] = 'TBSM';
        }else if($data['rekomendasi']['TKR'] == $data['hasil']){
            $data['final'] = 'TKR';
        }

        // $alternatif = new Alternatif();
        // $alternatif->nama_alternatif = $data['siswa']['nama'];
        // $alternatif->nisn = $data['siswa']['nisn'];
        // $alternatif->save();

        $rekomendasi = new Rekomendasi();
        $rekomendasi->nama_siswa = $data['siswa']['nama'];
        $rekomendasi->nisn = $data['siswa']['nisn'];
        $rekomendasi->jurusan = ''.$data["rekomendasi2"][0].', '.$data["rekomendasi2"][1].', '.$data["rekomendasi2"][2].', '.$data["rekomendasi2"][3];
        $rekomendasi->save();

      
        // dd(($data), $minMax, $normalisasi, $nilai);



        return view('hasil', compact('data', 'normalisasi', 'minMax', 'nilai'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data, $normalisasi, $minMax)
    {
        view('hasil', compact('data', 'normalisasi', 'minMax'));
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
        //
    }
}