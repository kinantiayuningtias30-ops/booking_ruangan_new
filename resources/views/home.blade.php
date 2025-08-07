<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Booking Ruangan</title>
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
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px; /* Ubah dari 400px jadi 600px */
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        a {
            padding: 12px 25px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
            max-width: 250px;
        }

        a:hover {
            background-color: #5a67d8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hai Selamat Datang!</h1>
        <h1>ada yang bisa kami bantu?</h1>
        <div class="button-group">
            <a href="/booking">Booking Ruangan</a>
            <a href="/logout">Logout</a>
        </div>
    </div>
</body>
</html>
