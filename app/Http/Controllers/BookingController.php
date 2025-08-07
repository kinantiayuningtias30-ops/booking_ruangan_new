<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'ruangan' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        $data['id'] = time(); // ID unik

        $file = storage_path('app/booking.json');
        $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        $bookings[] = $data;
        file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

        return view('hasil', $data);
    }

    public function list()
    {
        $file = storage_path('app/booking.json');
        $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        return view('list', ['bookings' => $bookings]);
    }

    public function destroy($id)
    {
        $file = storage_path('app/booking.json');
        $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        $bookings = array_filter($bookings, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        $bookings = array_values($bookings);
        file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

        return redirect('/booking/list');
    }
}
