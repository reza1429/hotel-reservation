<?php

namespace App\Http\Controllers;
use App\Models\pembayaran;
use Illuminate\Support\Facades\Session;
use App\Models\history_trans;
use Illuminate\Http\Request;
use App\Models\reservasi;


class pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $hasilCari = "";

        $pembayarans = pembayaran::paginate(5)->withQueryString();
        return view('Pembayaran.pembayaran', ['pembayarans' => $pembayarans, 'hasilCari' => $hasilCari]);

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history = history_trans::find($id);
    //    return  $history->reservasi->tbl_kamar->tipe_kamar->nama_tipe;
        // $res  = reservasi::find(3);
        // return $res->kamar->id;

        return view('Pembayaran.detailTransaksi', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembayaran = pembayaran::find($id);
        
        return view('Pembayaran.editPembayaran', compact('pembayaran'));

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
        $message = [
            'required' => "Uang Bayar Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => 'Uang Bayar Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'kode_bayar'=>'required|min:1',
            'total_harga'=>'required|min:1',
            'uang_bayar'=>'required|min:1|numeric',
        ], $message);
        
        pembayaran::find($id)->update($validateData);
        pembayaran::find($id)->delete();
        Session::flash('status', 'Pembayaran Berhasil');
        return redirect('/pembayaran');
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

    public function cari(Request $request)
    {   
        if(empty($request->kode_bayar)){  
            return redirect('/pembayaran');
        }
        $hasilCari = $request->kode_bayar;
            $pembayarans = pembayaran::where('kode_bayar', 'like', '%'. $hasilCari.'%')->paginate(5)->withQueryString();
            return view('Pembayaran.pembayaran', ['pembayarans' => $pembayarans, 'hasilCari' => $hasilCari]);


    }
    public function history()
    {   
        $histories =  history_trans::paginate(5);
            return view('Pembayaran.history_transaksi',  compact('histories'));


    }
}
