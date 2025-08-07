<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//LOGIN 
Route::get('/', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {
    $username = $request->username;
    $password = $request->password;

    // Hardcoded akun
    if ($username === 'Admin' && $password === '123456') {
        session(['logged_in' => true, 'username' => $username, 'role' => 'admin']);
        return redirect('/home');
    } elseif ($username === 'User' && $password === 'user123') {
        session(['logged_in' => true, 'username' => $username, 'role' => 'user']);
        return redirect('/home');
    } else {
        return back()->with('error', 'Username atau Password salah!');
    }
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
});

//DASHBOARD

Route::get('/home', function () {
    if (!session('logged_in')) return redirect('/');
    return view('home', [
        'username' => session('username'),
        'role' => session('role')
    ]);
});

// =================== FORM BOOKING =================== //

Route::get('/booking', function () {
    if (!session('logged_in')) return redirect('/');
    return view('form');
});

Route::post('/booking/submit', function (Request $request) {
    if (!session('logged_in')) return redirect('/');

    $data = $request->validate([
        'nama' => 'required',
        'ruangan' => 'required',
        'tanggal' => 'required|date',
        'waktu' => 'required',
    ]);

    $data['id'] = time();
    $file = storage_path('app/booking.json');
    $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $bookings[] = $data;
    file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

    return redirect('/booking/payment?' . http_build_query($data));
});

// =================== PEMBAYARAN =================== //

Route::get('/booking/payment', function (Request $request) {
    if (!session('logged_in')) return redirect('/');

    return view('payment', [
        'nama' => $request->query('nama'),
        'ruangan' => $request->query('ruangan'),
        'tanggal' => $request->query('tanggal'),
        'waktu' => $request->query('waktu')
    ]);
});

Route::post('/booking/selesai', function (Request $request) {
    if (!session('logged_in')) return redirect('/');

    $data = $request->all();
    $data['waktu_simpan'] = now();

    $file = storage_path('app/pembayaran.json');
    $pembayaranList = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $pembayaranList[] = $data;
    file_put_contents($file, json_encode($pembayaranList, JSON_PRETTY_PRINT));

    return view('hasil', $data);
});

// =================== ADMIN ONLY: LIST & DELETE =================== //

Route::get('/booking/list', function () {
    if (!session('logged_in') || session('role') !== 'admin') return redirect('/');

    $file = storage_path('app/booking.json');
    $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    return view('list', ['bookings' => $bookings]);
});

Route::delete('/booking/{id}', function ($id) {
    if (!session('logged_in') || session('role') !== 'admin') return redirect('/');

    $file = storage_path('app/booking.json');
    $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $bookings = array_values(array_filter($bookings, fn($b) => $b['id'] != $id));
    file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

    return redirect('/booking/list');
});

// =================== ADMIN ONLY: LAPORAN =================== //

Route::get('/laporan', function () {
    if (!session('logged_in') || session('role') !== 'admin') return redirect('/');

    $file = storage_path('app/pembayaran.json');
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $rekap = [
        'Transfer Bank' => 0,
        'E-Wallet' => 0,
        'Cash' => 0,
        'total' => 0
    ];

    foreach ($data as $item) {
        $metode = $item['jenis_pembayaran'] ?? 'lainnya';
        if (isset($rekap[$metode])) $rekap[$metode]++;
        $rekap['total']++;
    }

    return view('laporan', compact('data', 'rekap'));
});