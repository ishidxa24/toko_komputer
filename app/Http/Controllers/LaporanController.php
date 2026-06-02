<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil semua data barang dan diurutkan berdasarkan kategori
        $barang = Barang::with('kategori')->orderBy('kategori_id')->get();
        return view('laporan.index', compact('barang'));
    }
}
