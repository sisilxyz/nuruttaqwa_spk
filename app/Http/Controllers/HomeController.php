<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Rekomendasi;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countA = Alternatif::count();
        $countR = Rekomendasi::count();
        $countK = Kriteria::count();
        return view('home', compact('countA', 'countR', 'countK'));
    }

    
}
