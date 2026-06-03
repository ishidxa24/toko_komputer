<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function masuk()
    {
        $barang = Barang::all();
        $transaksi = Transaksi::with('barang')->where('jenis', 'masuk')->latest()->get();
        return view('transaksi.masuk', compact('barang', 'transaksi'));
    }

    public function keluar()
    {
        $barang = Barang::all();
        $transaksi = Transaksi::with('barang')->where('jenis', 'keluar')->latest()->get();
        return view('transaksi.keluar', compact('barang', 'transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jenis === 'keluar' && $barang->stock < $request->jumlah) {
            return back()->with('error', 'Stok tidak cukup. Stok saat ini: ' . $barang->stock);
        }

        Transaksi::create($request->only('barang_id', 'jenis', 'jumlah', 'tanggal'));

        if ($request->jenis === 'masuk') {
            $barang->stock += $request->jumlah;
        } else {
            $barang->stock -= $request->jumlah;
        }
        $barang->save();

        $route = $request->jenis === 'masuk' ? 'transaksi.masuk' : 'transaksi.keluar';
        return redirect()->route($route)->with('success', 'Transaksi dicatat & stok diperbarui.');
    }
}
