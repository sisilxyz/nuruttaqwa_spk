<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Rekomendasi;

class AlgoritmaController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria','ASC')->get();
        $penilaian = Penilaian::with('crips','alternatif')->get();
        $rekomendasiJurusan = Rekomendasi::get();
        //return response()->json($alternatif);
       if (count($penilaian) == 0) {
        return redirect(route('penilaian.index'));
       }

       $normalisasi = [];
       //mencari min max
       foreach ($kriteria as $key => $value) {
            foreach ($penilaian as $key_1 => $value_1) {
                if( $value->id == $value_1->crips->kriteria_id) {
                    if ($value->attribut == 'benefit'){
                        $minMax[$value->id][] = $value_1->crips->bobot;
                    }elseif($value->attribut == 'cost') {
                        $minMax[$value->id][] = $value_1->crips->bobot;
                    }
                }
            }
        }

        // dd($minMax);
       


       //normalisasi
       foreach ($penilaian as $key_1 => $value_1) {
            foreach ($kriteria as $key => $value) {
                if ($value->id == $value_1->crips->kriteria_id) {
                    if ($value->attribut == 'benefit') {
                    $normalisasi[$value_1->alternatif->nama_alternatif][] = $value_1->crips->bobot / max($minMax[$value->id]);
                    }elseif($value->attribut == 'cost'){
                    $normalisasi[$value_1->alternatif->nama_alternatif][] = min($minMax[$value->id]) / $value_1->crips->bobot;
                   }
                }
            }
        }
        // dd($normalisasi);

        //ranking
        foreach ($normalisasi as $key => $value) {
            foreach ($kriteria as $key_1 => $value_1) {
                // dd($value);
                $rank[$key][] = $value[$key_1] * $value_1->bobot;
            }
        }  

        // dd($rank);
            
        $ranking = $normalisasi;
        foreach($normalisasi as $key => $value) {
            $ranking[$key][] = array_sum($rank[$key]);
        }
        arsort($ranking);

        // dd($tkj);
        foreach ($rekomendasiJurusan as $key => $value) {
            $jurusan[$key] = $value['sarat'];
        }

        // dd($jurusan);

        foreach ($ranking as $key => $value) {
            $sortNilai[$key]= array(
                'bahasa indonesia' => number_format($value[0],2) . ' - bindo',
                'bahasa inggris' => number_format($value[1],2) . ' - bing',
                'ipa' => number_format($value[2],2) . ' - ipa',
                'ips' => number_format($value[3],2) . ' - ips',
                'matematika' => number_format($value[4],2) . ' - mtk',
                'tik' => number_format($value[5],2) . ' - tik',
            );
            arsort($sortNilai[$key]);
            // if($sortNilai[$key] == $jurusan[0]){
            //     $sortNilai[$key]['rekomendasi'] = 'TKJ';
            // }else if($sortNilai[$key] == $jurusan[1]){
            //     $sortNilai[$key]['rekomendasi'] = 'Akutansi';
            // }else if($sortNilai[$key] == $jurusan[2]){
            //     $sortNilai[$key]['rekomendasi'] = 'TKR';
            // }else if($sortNilai[$key] == $jurusan[3]){
            //     $sortNilai[$key]['rekomendasi'] = 'TBSM';
            // }else{
            //     $sortNilai[$key]['rekomendasi'] = 'Tidak ada rekomendasi';
            // }

            if(($sortNilai[$key]['tik'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['tik'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['tik'] >= $sortNilai[$key]['ips']) || 
            ($sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['ips']) ||
            ($sortNilai[$key]['ipa'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['ipa'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['ipa'] >= $sortNilai[$key]['ips'])){
                $sortNilai[$key]['rekomendasi'] = 'TKJ';
            }else if(($sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['ipa']) ||
            ($sortNilai[$key]['ips'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['ipa'])||
            ($sortNilai[$key]['bahasa indonesia'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['bahasa indonesia'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['bahasa indonesia'] >= $sortNilai[$key]['ipa']) ){
                $sortNilai[$key]['rekomendasi'] = 'Akutansi';
            }else if(($sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['ipa'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['tik']) || 
            ($sortNilai[$key]['ips'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['ipa'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['tik']) ||
            ($sortNilai[$key]['bahasa inggris'] >= $sortNilai[$key]['bahasa indonesia'] && $sortNilai[$key]['bahasa inggris'] >= $sortNilai[$key]['ipa'] && $sortNilai[$key]['bahasa inggris'] >= $sortNilai[$key]['tik']) ){
                $sortNilai[$key]['rekomendasi'] = 'TKR';
            }else if(($sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['matematika'] >= $sortNilai[$key]['bahasa indonesia']) ||
            ($sortNilai[$key]['ipa'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['ipa'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['ipa'] >= $sortNilai[$key]['bahasa indonesia']) ||
            ($sortNilai[$key]['ips'] >= $sortNilai[$key]['bahasa inggris'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['tik'] && $sortNilai[$key]['ips'] >= $sortNilai[$key]['bahasa indonesia']) ){
                $sortNilai[$key]['rekomendasi'] = 'TBSM';
            }else{
                $sortNilai[$key]['rekomendasi'] = 'Tidak ada rekomendasi';
            }
        }

        foreach ($sortNilai as $key => $value) {
            $finalSort[$key] = $value;
        }
        // dd(json_encode($tkj), $sortNilai , $finalSort);


//         1. TKJ : TIK, Matematika, IPA, Bahasa Inggris, Bahasa Indonesia, IPS

// 2. Akuntansi : Matematika, IPS, Bahasa Indonesia, Bahasa Inggris, TIK, IPA

// 3. TKR : Matematika, IPA, Bahasa Inggris, Bahasa Indonesia, IPS, TIK

// 4. TBSM : Matematika, IPS, IPA, Bahasa Inggris, TIK, Bahasa Indonesia

        
            
        // dd(($finalSort));


        return view('admin.perhitungan.index', compact('alternatif', 'kriteria', 'normalisasi','ranking', 'sortNilai'));
        //return response()->json($minMax);
    }
}
