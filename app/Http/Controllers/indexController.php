<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class indexController extends Controller
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
        $type = $request->input('filter');

        // Ambil data transaksi dengan pagination
        $data = $query->paginate(5);

        // Hitung pemasukan dan pengeluaran
        $pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        if ($request->tipe == 'pengeluaran' && $saldo < $request->nominal) {
            return back()->with('error', 'Saldo Tidak Mencukupi');
        }

        // Cek jika ada pencarian
        if (!empty(request()->input('cari'))) {
            $data = $query->where('keterangan', 'like', '%' . request()->input('cari') . '%')->paginate(10);
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
        // Validasi input
        $request->validate([
            'nominal' => 'required|numeric',
            'keterangan' => 'required',
            'tipe' => 'required',
            'tanggal' => 'required'
        ], [
            'nominal.required' => 'Silahkan Masukkan Nominal',
            'keterangan.required' => 'Silahkan Masukkan Keterangan',
            'tipe.required' => 'Silahkan Masukkan Tipe',
            'tanggal.required' => 'Silahkan Masukkan tanggal'
        ]);

        // Simpan data ke database
        $data = [
            'nominal' => $request->input('nominal'),
            'keterangan' => $request->input('keterangan'),
            'tipe' => $request->input('tipe'),
            'tanggal' => $request->input('tanggal')
        ];

        // Hitung pemasukan dan pengeluaran
        $pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        if ($request->tipe == 'pengeluaran' && $saldo < $request->nominal) {
            return back()->with('error', 'Saldo Tidak Mencukupi');
        }

        Transaksi::create($data);
        return redirect('/dashboard1')->with('success', 'Berhasil Menambahkan Data');
    }


    public function edit(string $id)
    {
        $data = Transaksi::where('id', $id)->first();
        return view('edit')->with('data', $data);
    }


    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nominal' => 'required|numeric',
            'keterangan' => 'required',
            'tipe' => 'required',
            'tanggal' => 'required'
        ], [
            'nominal.required' => 'Silahkan Masukkan Nominal',
            'keterangan.required' => 'Silahkan Masukkan Keterangan',
            'tipe.required' => 'Silahkan Masukkan Tipe',
            'tanggal.required' => 'Silahkan Masukkan Tanggal'
        ]);

        // Update data
        $data = [
            'nominal' => $request->input('nominal'),
            'keterangan' => $request->input('keterangan'),
            'tipe' => $request->input('tipe'),
            'tanggal' => $request->input('tanggal')
        ];

        // Hitung pemasukan dan pengeluaran
        $pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;


        if ($request->tipe == 'pengeluaran' && $saldo < $request->nominal) {
            return back()->withErrors('Saldo Tidak Mencukupi');
        }

        Transaksi::where('id', $id)->update($data);
        return redirect('/dashboard1')->with('warning', 'Berhasil Memperbarui Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaksi::where('id', $id)->delete();
        return redirect('/dashboard1')->with('error', 'Berhasil Menghapus Data');
    }
}
