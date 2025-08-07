<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #43cea2, #185a9d);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
        }

        select, input[type="text"], button {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #43cea2;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
        }

        button:hover {
            background-color: #38b38a;
        }

        .conditional {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Metode Pembayaran</h2>

        <!-- ✅ Diperbaiki action-nya -->
        <form action="/booking/selesai" method="POST">
            @csrf

            <!-- Hidden booking data -->
            <input type="hidden" name="nama" value="{{ $nama }}">
            <input type="hidden" name="ruangan" value="{{ $ruangan }}">
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            <input type="hidden" name="waktu" value="{{ $waktu }}">

            <div class="form-group">
                <label for="jenis_pembayaran">Jenis Pembayaran:</label>
                <select name="jenis_pembayaran" id="jenis_pembayaran" required onchange="tampilkanField()">
                    <option value="">-- Pilih Jenis Pembayaran --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <div class="form-group conditional" id="bankField">
                <label for="bank">Pilih Bank:</label>
                <select name="bank">
                    <option value="">-- Pilih Bank --</option>
                    <option value="BCA">BCA</option>
                    <option value="BNI">BNI</option>
                    <option value="BRI">BRI</option>
                    <option value="Mandiri">Mandiri</option>
                </select>
            </div>

            <div class="form-group conditional" id="walletField">
                <label for="wallet">Pilih E-Wallet:</label>
                <select name="wallet">
                    <option value="">-- Pilih E-Wallet --</option>
                    <option value="OVO">OVO</option>
                    <option value="Gopay">Gopay</option>
                    <option value="Dana">Dana</option>
                    <option value="ShopeePay">ShopeePay</option>
                </select>
            </div>

            <button type="submit">Selesaikan Booking</button>
        </form>
    </div>

    <script>
        function tampilkanField() {
            const jenis = document.getElementById('jenis_pembayaran').value;
            document.getElementById('bankField').style.display = (jenis === 'Transfer Bank') ? 'block' : 'none';
            document.getElementById('walletField').style.display = (jenis === 'E-Wallet') ? 'block' : 'none';
        }
    </script>
</body>
</html>
