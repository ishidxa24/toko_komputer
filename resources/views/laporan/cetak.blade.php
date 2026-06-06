<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Laporan - Toko Komputer</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 30px; }
        .header { text-align: center; border-bottom: 2px solid #1f2937; padding-bottom: 12px; margin-bottom: 24px; }
        .header h1 { font-size: 22px; margin: 0; text-transform: uppercase; letter-spacing: 2px; }
        .header p { margin: 4px 0 0; color: #4b5563; font-size: 13px; }
        h3 { font-size: 15px; margin: 28px 0 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #9ca3af; padding: 8px 10px; font-size: 12px; text-align: left; }
        th { background: #f3f4f6; text-transform: uppercase; font-size: 11px; }
        .text-center { text-align: center; }
        .badge-masuk { color: #15803d; font-weight: bold; }
        .badge-keluar { color: #b91c1c; font-weight: bold; }
        .btn-cetak { margin-bottom: 20px; padding: 8px 16px; background: #4f46e5; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; }
        @media print { .btn-cetak { display: none; } body { margin: 0; } }
    </style>
</head>
<body>

    <button class="btn-cetak" onclick="window.print()">🖨 Cetak Sekarang</button>

    <div class="header">
        <h1>Toko Komputer</h1>
        <p>Laporan Persediaan Stok Barang</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i') }}</p>
    </div>

    <h3>Data Stok Terkini</h3>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Kategori</th><th>Nama Barang</th>
                <th class="text-center">Stok</th><th class="text-center">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ $item->stock }}</td>
                    <td class="text-center">{{ $item->satuan }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada data stok barang.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Riwayat Keluar Masuk Barang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Tanggal</th><th>Nama Barang</th>
                <th class="text-center">Jenis</th><th class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $t->barang->nama_barang ?? '-' }}</td>
                    <td class="text-center {{ $t->jenis == 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                        {{ ucfirst($t->jenis) }}
                    </td>
                    <td class="text-center">{{ $t->jumlah }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada riwayat transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
