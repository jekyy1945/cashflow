<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengeluaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nominal' , $request->nominal);
        Session::flash('keterangan' , $request->keterangan);

        $request->validate([
            'keterangan' =>'required',
            'nominal' => 'required',
        ], [
            'keterangan.required' => 'Silahkan Masukkan Keterangan',
            'nominal.required' => 'Silahkan Masukkan Nominal',
        ]);
        $data = [
            'keterangan' => $request->input('keterangan'),
            'nominal' => $request->input('nominal'),
        ];
        Pengeluaran::create($data);

        return redirect('./')->with('success', 'Berhasil Simpan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        pengeluaran::where('id_pengeluaran',$id)->delete();
        return redirect('/pengelauran')->with('success', 'Berhasil hapus data');
    }
}
