<?php

namespace App\Http\Controllers;

use App\Models\pemasukan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil filter dari request (pemasukan/pengeluaran)
        $filter = $request->input('filter');

        // Query dasar untuk transaksi
        $query = Transaksi::query();

        // Jika filter pemasukan/pengeluaran ada, tambahkan kondisi filter
        if ($filter == 'pemasukan') {
            $query->where('tipe', 'pemasukan');
        } elseif ($filter == 'pengeluaran') {
            $query->where('tipe', 'pengeluaran');
        }

        // Ambil data transaksi dengan pagination
        $data = $query->paginate(5);

        // Hitung pemasukan dan pengeluaran
        $pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        if ($request->tipe =='pengeluaran' && $saldo < $request->nominal) {
            return back()->with('error', 'Saldo Tidak Mencukupi');
        }

        // Cek jika ada pencarian
        if (!empty(request()->input('cari'))) {
            $data = $query->where('tipe', 'like', '%' . request()->input('cari') . '%')->paginate(10);
        }

        // Pengecekan pengeluaran, menambahkan pesan saja
        if ($pengeluaran > 3000000) {
            session()->flash('danger', 'Kamu boros!');
        }

        // Return view dengan data, pemasukan, pengeluaran, dan saldo yang diformat
        return view('index', [
            'data' => $data,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'filter' => $filter // untuk menandai filter yang sedang aktif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemasukan');
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
        pemasukan::create($data);

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
        //
    }
}
