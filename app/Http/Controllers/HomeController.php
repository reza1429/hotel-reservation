<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipe_kamar;
use App\Models\reservasi;
use App\Models\pengunjung;

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
        $reservasi = reservasi::with('pengunjung', 'tbl_kamar.tipe_kamar')->get();
        $tipe = tipe_kamar::get();
        // return $reservasi;
        return view('home', compact('tipe', 'reservasi'));
    }

    public function search()
    {
        // return true;
        if(request()->get('val') == null){
            $pengunjung = [];
            // $pengunjung = pengunjung::where('no_ktp', request()->get('val'))->get();
        }else{
            $pengunjung = pengunjung::where('no_ktp','LIKE', '%'.request()->get('val').'%')->get();
        }
        // return $pengunjung;
        $tipes = tipe_kamar::get();
        $html = view('home-customer', compact('pengunjung', 'tipes'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ],200);
    }
}
