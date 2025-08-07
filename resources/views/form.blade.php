<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Booking Ruangan</title>
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
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 900px;
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

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #444;
        }

        input,
        select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #667eea;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5a67d8;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        .preview {
            margin-top: 10px;
        }

        .preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            display: none;
        }

        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Booking Ruangan</h2>

        <form action="/booking/submit" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="ruangan">Ruangan:</label>
                    <select id="ruangan" name="ruangan" required onchange="tampilkanGambar()">
                        <option value="">-- Pilih Ruangan --</option>
                        <option value="Lab Komputer">Lab Komputer</option>
                        <option value="Studio Musik">Studio Musik</option>
                        <option value="Ruang Rapat">Ruang Rapat</option>
                        <option value="Ruang Republik Kreatif">Ruang Republik Kreatif</option>
                    </select>

                    <div class="preview">
                        <img id="previewRuangan" src="" alt="Preview Ruangan">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal">Tanggal Booking:</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="waktu">Waktu:</label>
                    <input type="time" id="waktu" name="waktu" required>
                </div>
            </div>

            <button type="submit">Submit Booking</button>
        </form>

        <p><a href="/home">Kembali ke Home</a></p>
    </div>

    <script>
        function tampilkanGambar() {
            const select = document.getElementById('ruangan');
            const img = document.getElementById('previewRuangan');
            const value = select.value.toLowerCase().replace(/\s+/g, '-');
            if (value) {
                img.src = `/img/${value}.jpg`; 
                img.style.display = 'block';
            } else {
                img.style.display = 'none';
            }
        }
    </script>
</body>
</html>
