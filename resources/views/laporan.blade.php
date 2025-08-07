<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #667eea;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .summary {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <h2>Laporan Pembayaran</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Metode Pembayaran</th>
                <th>Bank / E-Wallet</th>
                <th>Waktu Simpan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d['nama'] }}</td>
                    <td>{{ $d['ruangan'] }}</td>
                    <td>{{ $d['tanggal'] }}</td>
                    <td>{{ $d['waktu'] }}</td>
                    <td>{{ $d['jenis_pembayaran'] }}</td>
                    <td>{{ $d['bank'] ?? $d['wallet'] ?? '-' }}</td>
                    <td>{{ $d['waktu_simpan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Ringkasan:</h3>
        <ul>
            <li>Total Booking: {{ $rekap['total'] }}</li>
            <li>Transfer Bank: {{ $rekap['Transfer Bank'] }}</li>
            <li>E-Wallet: {{ $rekap['E-Wallet'] }}</li>
            <li>Cash: {{ $rekap['Cash'] }}</li>
        </ul>
    </div>
</body>
</html>
