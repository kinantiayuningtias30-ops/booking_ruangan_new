<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            padding: 40px;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 16px;
        }

        th {
            background-color: #6b5b95;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #e63946;
            font-size: 18px;
            cursor: pointer;
        }

        .delete-btn:hover {
            opacity: 0.7;
        }

        .back-link {
            margin-top: 30px;
            text-align: center;
        }

        a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            background-color: #6b5b95;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #594785;
        }

        .no-data {
            text-align: center;
            color: white;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <h2>Daftar Semua Booking</h2>

    @if (count($bookings) > 0)
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $b)
                    <tr>
                        <td>{{ $b['nama'] }}</td>
                        <td>{{ $b['ruangan'] }}</td>
                        <td>{{ $b['tanggal'] }}</td>
                        <td>{{ $b['waktu'] }}</td>
                        <td>
                            <form action="/booking/{{ $b['id'] }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">Belum ada data booking.</p>
    @endif

    <div class="back-link">
        <a href="/home">Kembali ke Home</a>
    </div>

</body>
</html>
