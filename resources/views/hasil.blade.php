<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: white;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 50px;
        }

        .info {
            flex: 1;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        p {
            font-size: 18px;
            margin: 12px 0;
        }

        strong {
            color: #555;
        }

        .preview {
            flex: 1;
        }

        .preview img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .qr {
            margin-top: 20px;
        }

        .qr img {
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #667eea;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #5a67d8;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 30px;
            }

            .preview img {
                max-height: 200px;
            }

            .qr img {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="info">
            <h2>Detail Booking</h2>

            <p><strong>Nama:</strong> {{ $nama }}</p>
            <p><strong>Ruangan:</strong> {{ $ruangan }}</p>
            <p><strong>Tanggal:</strong> {{ $tanggal }}</p>
            <p><strong>Waktu:</strong> {{ $waktu }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $jenis_pembayaran }}</p>

            @if ($jenis_pembayaran === 'Transfer Bank')
                <p><strong>Bank:</strong> {{ $bank }}</p>
            @elseif ($jenis_pembayaran === 'E-Wallet')
                <p><strong>E-Wallet:</strong> {{ $wallet }}</p>
                <div class="qr">
                    <p><strong>Silakan scan QR {{ $wallet }} berikut:</strong></p>
                    <img src="/qrcode/{{ strtolower($wallet) }}.png" alt="QR {{ $wallet }}">
                </div>
            @endif

            <a href="/home" class="back-btn">Kembali ke Home</a>
        </div>

        <div class="preview">
            <img src="/img/{{ strtolower(str_replace(' ', '-', $ruangan)) }}.jpg" alt="Preview Ruangan">
        </div>
    </div>
</body>
</html>
