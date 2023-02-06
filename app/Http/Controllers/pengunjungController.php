<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengunjung;
use Illuminate\Support\Facades\Session;


class pengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasilCari = "";
        
       $pengunjungs = pengunjung::paginate(5)->withQueryString();
        return view('Pengunjung.pengunjung', compact('pengunjungs', 'hasilCari'));
        
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
        $message = [
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'nama'=>'required|max:25|min:1',
            'alamat'=>'required|max:25|min:1',
            'no_ktp'=>'required|max:25|min:1',
            'no_telp'=>'required|max:25|min:1',
        ], $message);
        
        pengunjung::create($validateData);
        Session::flash('status', 'Data Berhasil ditambahkan');
        return redirect()->back();
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
        $pengunjung = pengunjung::find($id);
        return view('Pengunjung.editPengunjung', compact('pengunjung'));

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
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'nama'=>'required|max:25|min:1',
            'alamat'=>'required|max:40|min:1',
            'no_ktp'=>'required|max:250|min:1',
            'no_telp'=>'required|max:250|min:1',
        ], $message);
        
        pengunjung::find($id)->update($validateData);
        Session::flash('status', 'Data Berhasil Update');
        return redirect('/pengunjung');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        pengunjung::find($id)->delete();
        Session::flash('status', 'Data Berhasil di Hapus');
        return redirect('/pengunjung');
    }
    public function cari(Request $request)
    {   
        if(empty($request->nama)){  
            return redirect('/pengunjung');
        }
        $hasilCari = $request->nama;
            $pengunjungs = pengunjung::where('nama', 'like', '%'. $request->nama.'%')->paginate(5)->withQueryString();
            if($pengunjungs->isEmpty()){
                $pengunjungs = pengunjung::where('no_ktp', 'like', '%'. $request->nama.'%')->paginate(5);
            } 
        return view('Pengunjung.pengunjung', compact('pengunjungs', 'hasilCari'));

    }
}
