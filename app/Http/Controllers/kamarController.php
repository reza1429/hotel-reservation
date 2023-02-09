<?php

namespace App\Http\Controllers;

use App\Models\tbl_kamar;
use App\Models\tipe_kamar;
use Illuminate\Http\Request;

class kamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamars = tbl_kamar::with('tipe_kamar')->paginate(5);
        $tipe_kamars = tipe_kamar::all();
        return view('kamar.index', compact('kamars', 'tipe_kamars'));
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
            'kode_ruangan' => 'required',
            'tipe_id' => 'required',
            'status' => 'required',
        ]); 

        tbl_kamar::create($request->all());
        return redirect()->back()->with('succes', 'Kamar ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return tbl_kamar::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $kamar = tbl_kamar::findOrFail($id);
        
        $this->validate($request, [
            'kode_ruangan' => 'required',
            'tipe_id' => 'required',
            'status' => 'required',
        ]); 

        $kamar->update([
            'kode_ruangan' => $request->kode_ruangan,
            'tipe_id' => $request->tipe_id,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('succes', 'Kamar diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tbl_kamar::findOrFail($id)->delete();
        return redirect()->back()->with('succes', 'Kamar terhapus!');
    }

    /**
     * Function Tipe Kamar
     */
    public function tipe_store(Request $request)
    {
        $this->validate($request, [
            'nama_tipe' => 'required',
            'harga' => 'required'
        ]); 

        tipe_kamar::create($request->all());
        return redirect()->back()->with('success', 'Tipe ditambahkan!');
    }

    public function tipe_update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_tipe' => 'required',
            'harga' => 'required'
        ]); 
    }

    public function tipe_destroy($id)
    {
        tipe_kamar::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Tipe terhapus!');
    }
}
