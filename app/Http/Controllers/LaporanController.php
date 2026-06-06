<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mengambil data barang
        $barang = Barang::with('kategori')->get();

        // 2. Mengambil data transaksi beserta filter tanggal dari request
        $transaksi = Transaksi::with('barang')
            ->when($request->dari, fn($q) => $q->whereDate('tanggal', '>=', $request->dari))
            ->when($request->sampai, fn($q) => $q->whereDate('tanggal', '<=', $request->sampai))
            ->latest('tanggal')
            ->get();

        // 3. Mengirim variabel $barang dan $transaksi ke view laporan.index
        return view('laporan.index', compact('barang', 'transaksi'));
    }

    public function cetak(Request $request)
    {
        // Mengambil data yang sama seperti index, tetapi ditampilkan di halaman cetak terpisah
        $barang = Barang::with('kategori')->get();

        $transaksi = Transaksi::with('barang')
            ->when($request->dari, fn($q) => $q->whereDate('tanggal', '>=', $request->dari))
            ->when($request->sampai, fn($q) => $q->whereDate('tanggal', '<=', $request->sampai))
            ->latest('tanggal')
            ->get();

        return view('laporan.cetak', compact('barang', 'transaksi'));
    }
}
