<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_kamar as kamar;
use App\Models\reservasi;
use App\Models\tipe_kamar;
use App\Models\pembayaran;

class reservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkoutReservation()
    {
        reservasi::where('id', request()->resId)->update([
            'status_res' => 1
        ]);

        kamar::where('id', request()->kamarId)->update([
            'status' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'kamar berhasil diheckout.'
        ]);
        
    }

    public function index()
    {
        $kamar = kamar::where('tipe_id', request()->get('val'))
                        ->where('status', 0)->get();
        return $kamar;
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
        reservasi::create([
            'pengunjung_id' => $request->post('nama'),
            'kamar_id' => $request->post('noKamar'),
            'status_pay' => 0,
            'lama_sewa' => $request->post('durasi'),
        ]);

        $reservasi = reservasi::with('tbl_kamar.tipe_kamar')->latest()->first();
        pembayaran::create([
            'reservasi_id' => $reservasi->id,
            'total_harga' => $reservasi->lama_sewa * $reservasi->tbl_kamar->tipe_kamar->harga,
            'uang_bayar' => 0,
            'kode_bayar' => 'HH'.'-'. $reservasi->id .'-'. date('Y') ,
        ]);

        // return $reservasi;
        return response()->json([
            'success' => true,
            'message' => 'Reservasi Berhasil Dibuat!'
        ]);
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
        // return $id;
        reservasi::destroy($id);

        kamar::where('id', request()->kamarId)->update([
            'status' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi Berhasil Dihapus!'
        ]);
    }
}
